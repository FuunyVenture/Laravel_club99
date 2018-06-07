<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Club99;
use App\Coupon;
use App\Fee;
use App\Package;
use App\PaymentGateways\PnP;
use App\Product;
use App\Shipment;
use App\StorePayment;
use App\User;
use Auth;
use Carbon\Carbon;
use Exception;
use Fenos\Notifynder\Builder\NotifynderBuilder;
use Fenos\Notifynder\Exceptions\EntityNotIterableException;
use Fenos\Notifynder\Exceptions\IterableIsEmptyException;
use Fenos\Notifynder\Facades\Notifynder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Log;
use Mail;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the invoices.
     *
     * @return View
     */
    public function index()
    {

        return view('admin.invoices.invoices');
    }


    /**
     * Redirects to create invoice form for certain shipment and user
     *
     * @param Request $request
     * @param $userId
     * @param $shipmentId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createSpecific(Request $request, $userId, $shipmentId)
    {
        $shipment = Shipment::findOrFail($shipmentId);

        if ($shipment->status == 'pending_approval') {
            return redirect()->back();
        }

        $request->session()->flash('userId', $userId);
        $request->session()->flash('shipmentId', $shipmentId);
        $request->session()->flash('userShipments', Shipment::whereHas('user', function ($query) use ($userId) {
            $query->where('id', '=', $userId);
        })->get());

        return redirect('admin/invoices/create');
    }

    /**
     * Show the form for creating a new invoice.
     *
     * @return View
     */
    public function create()
    {
        $users = User::where('role_id', '=', 2)->get();
        $products = Product::where('type', '=', 'fee')->where('type', '=', 'shipment')->get()->sortBy('type');
        $fees = Fee::all();
        $shipments = Shipment::all();

        Log::info('create');

        return view('admin.invoices.create_invoice')->with(compact(
            'invoice',
            'users',
            'products',
            'fees',
            'shipments'
        ));
    }

    /**
     * Store a newly created invoice in storage.
     *
     *  * Request must contain:
     *  * user - user for which invoice is created
     *  * products - list of products from invoice
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * On Success: return success message Invoice [invoice name] was successfully created.'
     *
     * On Error: return error message
     */
    public function store(Request $request)
    {

        try {
            $inv = DB::transaction(function () use ($request) {
                $invoice = new Invoice();
                $invoice->user()->associate($request->input('user'));
                $invoice->club99_details()->associate(Club99::all()->first());
                $invoice->status = 'draft';
                $invoice->due_date = Carbon::now()->addMonth(1);
                $invoice->save();

                $total = 0;
                foreach ($request->input('products') as $productId) {
                    $product = Product::findOrFail($productId);
                    $invoice->products()->attach($product);

                    if ($product->type == 'fee') {
                        $total += $product->fee->cost;

                        if ($product->fee->taxable == 'taxable') {
                            $total += $product->fee->cost * getSetting('VAT_TAX') / 100;
                        }
                    } else {
                        if($product->type == 'shipment') {
                            $total += $product->shipment->duty_cost + $product->shipment->duty_tax;

                            if($product->shipment->status == 'pending_approval') {
                                $product->shipment->status = 'ordered';
                                $product->shipment->save();
                            }
                        }
                    }
                }

                $invoice->name = 'INV-' . $invoice->id;
                $invoice->total = number_format($total, 2);
                $invoice->save();

                return $invoice;
            });

            $message = 'Invoice ' . $inv->name . ' was successfully created.';
            $request->session()->flash('success', $message);
            return response()->json([], 200);
        } catch (\Exception $e) {
            Log::info($e);
            return response()->json([], 400);
        }
    }

    /**
     * Display the specified invoice.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoices.invoice_detail')->with(compact('invoice'));
    }

    /**
     * Show the form for editing the specified invoice.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*Load all needed data*/
        $invoice = Invoice::findOrFail($id);
        $users = User::where('role_id', '=', 2)->get();
        $products = Product::all()->sortBy('type');
        $fees = Fee::where('archived', '=', 0)->get();
        $shipments = Shipment::all();
        $packages = Package::all();
        $coupons = Coupon::all();

        return view('admin.invoices.edit_invoice_detail')->with(compact(
            'invoice',
            'users',
            'products',
            'fees',
            'shipments',
            'packages',
            'coupons'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     *  * Request must contain:
     *  * user - user for which invoice is created
     *  * products - list of products from invoice
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * On Success: return success message Invoice [invoice name] has been successfully edited.'
     *
     * On Error: if invoice was already paid return error message 'This invoice cannot be edited.' else return 400 error status
     */
    public function update(Request $request, $id)
    {

        $invoice = Invoice::findOrFail($id);

        if ($invoice->status != 'paid') {
            try {
                DB::transaction(function () use ($invoice, $request) {
                    if ($invoice->user->id != $request->input('user')) {
                        $invoice->user()->associate(User::findOrFail($request->input('user')));
                    }

                    /*Refresh invoice's products*/
                    /*$invoice->products()->sync($request->input('products'));*/
                    $invoice->products()->detach();

                    $total = 0;
                    foreach ($request->input('products') as $productId) {
                        $product = Product::findOrFail($productId);
                        $invoice->products()->attach($product);

                        if ($product->type == 'fee') {
                            $total += $product->fee->cost;

                            if ($product->fee->taxable == 'taxable')
                                $total += $product->fee->cost * getSetting('VAT_TAX') / 100;
                        } else if($product->type=="shipment"){
                            $total += $product->shipment->duty_cost + $product->shipment->duty_tax;
                        } else {
                            $total += $product->package->cost;
                        }
                    }

                    $invoice->created_at = Carbon::parse(Carbon::createFromFormat('d/m/Y', $request->input('created_at')));
                    $invoice->due_date = Carbon::parse(Carbon::createFromFormat('d/m/Y', $request->input('due_date')));
                    $invoice->total = $total;
                    $invoice->save();
                });

                $message = 'Invoice ' . $invoice->name . ' has been successfully edited.';

                $request->session()->flash('success', $message);
                return response()->json([], 200);
            } catch (\Exception $e) {
                Log::info($e);
                return response()->json([], 400);
            }
        } else {
            return redirect('admin/invoices')->withErrors('error', 'This invoice cannot be edited.');
        }
    }

    /**
     * Invalidate an invoice if payment was not confirmed by admin and resend it to user. User is notified via notification.
     * and via email
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     *
     * On Success: redirect to 'admin/invoices' with success message 'Invoice was sent to customer.'
     *
     * On Error: redirect to 'admin/invoices' with error message 'Ops! Something went wrong.'
     */
    public function invalidateInvoicePayment($id)
    {
        $invoice = Invoice::findOrFail($id);
        try {

            $invoice->status = 'unpaid';
            $invoice->save();

            $user = $invoice->user;
            Notifynder::category('notifications')
                ->from(Auth::user()->id)
                ->to($user->id)
                ->url(url('member/invoices/' . $invoice->id))
                ->extra(['message' => 'Your receipt code for invoice - ID: ' . $invoice->id . ' was evaluated by our 
                administrators and it look like it\'s an invalid one.'])
                ->send();

            Mail::send('emails.new_invoice', [
                'user' => $user,
                'notificationMessage' => 'Your receipt code for invoice - ID: ' . $invoice->id . ' was evaluated by our 
                administrators and it look like it\'s an invalid one.'
            ], function ($m) use ($user) {
                $m->to($user->email, $user->firstname . ' ' . $user->lastname)
                    ->subject('Payment Confirmation');
            });

        } catch (Exception $e) {
            return redirect('admin/invoices')->withErrors('error', 'Ops! Something went wrong.');
        }

        return redirect('admin/invoices')->with('success', 'Invoice was sent to customer.');

    }

    /**
     * Remove the specified invoice from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Mark a specified invoice as paid. User is notified via notification and via email
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * On Success: redirect to 'admin/invoices' with success message 'Invoice [invoice name] was successfully marked as paid.'
     *
     * On Error: redirect to 'admin/invoices' with error message 'Something went wrong! Please try again later.'
     */
    public function markAsPaid($id)
    {
        $invoice = Invoice::findOrFail($id);

        try {
            $inv = DB::transaction(function () use ($invoice) {
                $invoice->status = 'paid';
                $invoice->save();
                return $invoice;
            });

            $user = $inv->user;
            Notifynder::category('notifications')
                ->from(Auth::user()->id)
                ->to($user->id)
                ->url(url('member/invoices/' . $inv->id))
                ->extra(['message' => 'Payment Confirmation for invoice - ID: ' . $inv->id])
                ->send();

            Mail::send('emails.new_invoice', [
                'user' => $user,
                'notificationMessage' => 'Payment Confirmation for invoice - ID: ' . $inv->id
            ], function ($m) use ($user) {
                $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject('Payment Confirmation');
            });

            return redirect('admin/invoices')->with(
                'success',
                'Invoice ' . $invoice->name . ' was successfully marked as paid.'
            );
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/invoices')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    public function markAsUnpaid($id)
    {
        $invoice = Invoice::findOrFail($id);

        try {
            $inv = DB::transaction(function () use ($invoice) {
                $invoice->status = 'unpaid';
                $invoice->save();
                return $invoice;
            });

            $user = $inv->user;
            Notifynder::category('notifications')
                ->from(Auth::user()->id)
                ->to($user->id)
                ->url(url('member/invoices/' . $inv->id))
                ->extra(['message' => 'New Invoice - ID: ' . $inv->id . ' has been received.'])
                ->send();

            Mail::send('emails.new_invoice', [
                'user' => $user,
                'notificationMessage' => 'New Invoice - ID: ' . $inv->id . ' has been received.'
            ], function ($m) use ($user) {
                $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject('Payment Confirmation');
            });

            return redirect('admin/invoices')->with(
                'success',
                'Invoice ' . $invoice->name . ' was successfully marked as paid.'
            );
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/invoices')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    /**
     * Send invoice to user. User is notified via notification and via email.
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     *
     * On Success: redirect to 'admin/invoices' with success message 'Invoice sent'
     *
     * On Error: redirect to 'admin/invoices' with error message 'Something went wrong! '
     *
     */
    public function sendInvoice($id)
    {
        Log::info('send invoice');

        try {
            $inv = Invoice::findOrFail($id);
            $inv->status = 'unpaid';
            $user = $inv->user;

            //generate notification
            Notifynder::category('notifications')
                ->from(Auth::user()->id)
                ->to($user->id)
                ->url(url('member/invoices/' . $inv->id))
                ->extra(['message' => 'New Invoice - ID: ' . $inv->id . ' has been received.'])
                ->send();

            //send email
            Mail::send('emails.new_invoice', [
                'user' => $user,
                'notificationMessage' => 'New Invoice - ID: ' . $inv->id . ' has been received.'
            ], function ($m) use ($user) {
                $m->to($user->email, $user->firstname . ' ' . $user->lastname)->subject('New Invoice Received');
            });

            //save invoice
            $inv->save();

        } catch (Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('error', 'Something went wrong! Please try again later.');
            return redirect('admin/invoices')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }

        Log::info('aaa');
        return redirect('admin/invoices')->with('success', 'Invoice sent!');
    }

    /** Return the view for paying an invoice. */
    public function showPayInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        $user = $invoice->user;
        return view('admin.invoices.pay_invoice')->with(compact('invoice', 'user'));
    }

    /**
     * Pay an invoice.
     *
     * * Request must contains:
     * * address1 - user's address
     * * city - user's address city
     * * zipcode - user's address zip code
     * * state - user's address state
     * * payment_method - user's payment method
     *
     * * If selected payment method is with credit card the request must contains:
     * * card_name - user's card name (required, max. 20 characters)
     * * card_number - user's card number (required, max. 19 characters)
     * * expire_date - user's card expirate date (required)
     * * cvc - user's card CVC (required, max. 3 characters)
     * * coupon_code - user's coupon code (optional)
     *
     * * If selected payment method is with cash in store the request must contains:
     * * receipt_code - user's receipt code
     *
     * * If selected payment method is with cash in store the request must contains:
     * * coupon_number - user's coupon number (required)
     * * coupon_code - user's coupon code (optional)
     *
     * On Success: return message 'Paid Successful!'.
     *
     * On Error: error message 'Invoice already paid'.
     */
    public function payInvoice(Request $request)
    {
        Log::info($request->all());

        $request->session()->flash('payment_method', $request->input('payment_method'));

        $this->validate($request, [
            'address1' => 'required',
            /*'address2' => 'required',*/
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
        ]);

        Log::info($request->all());

        $invoice = Invoice::findOrFail($request->input('invoice_id'));

        DB::transaction(function () use ($request) {
            if (isset(Auth::user()->bill_address)) {
                Auth::user()->bill_address->delete();
            }
            $billAddress = new Address();
            $billAddress->type = "bill";
            $billAddress->address1 = $request->input('address1');
            $billAddress->address2 = $request->input('address2');
            $billAddress->city = $request->input('city');
            $billAddress->zip_code = $request->input('zipcode');
            $billAddress->state = $request->input('state');
            $billAddress->user_id = Auth::user()->id;
            $billAddress->save();

        });

        if ($invoice->status == 'unpaid') {

            if ($request->input('payment_method') == 'credit_card') {
                $this->validate($request, [
                    'card_name' => 'required|max:20',
                    'card_number' => 'required|max:19',
                    'expire_date' => 'required',
                    'cvc' => 'required|max:3',
                ]);

                try {
                    DB::transaction(function () use ($request, $invoice) {

                        /**
                         * Credit Card expire date validation
                         */
                        $exp_date = preg_replace('/\s+/', '', $request->input('expire_date'));
                        $card_date = Carbon::createFromFormat('m/y', $exp_date);
                        if (!$card_date->gt(Carbon::today())) {
                            throw new Exception('Your Credit Card has expired!');
                        }

                        $couponValue = 0;

                        /**
                         * Store in database
                         */

                        if ($request->has('coupon_code')) {
                            $coupon = Coupon::whereCode($request->input('coupon_code'))
                                ->whereStatus('available')
                                ->where('start_date', '<=', Carbon::now())
                                ->where('end_date', '>=', Carbon::now())
                                ->first();

                            if (isset($coupon)) {
                                if ($coupon->type == 'percentage') {
                                    $couponValue = ($coupon->value / 100 * $invoice->total);
                                } else {
                                    $couponValue = $coupon->value;
                                }

                                $coupon->status = 'used';
                                $coupon->save();
                            }
                        }

                        $amountToPay = $invoice->total - $couponValue;
                        if ($amountToPay < 0) $amountToPay = 0;

                        /**
                         * Make Credit Card Payment
                         */
                        $bAddress = Auth::user()->bill_address;
                        $p = new PnP();
                        $result = $p->auth(
                            array(
                                'card-number' => preg_replace('/\s+/', '', $request->input('card_number')),
                                'card-name' => $request->input('card_name'),
                                'card-amount' => $amountToPay,
                                'card-exp' => $exp_date,
                                'ship-name' => $request->input('card_name'),
                                'card-cvv' => $request->input('cvc'),
                                'card-address1' => $bAddress->address1,
                                'card-address2' => $bAddress->address2,
                                'card-city' => $bAddress->city,
                                'card-state' => $bAddress->state,
                                'card-zip' => $bAddress->zip_code,
                                'card-country' => $bAddress->country,
                                'email' => Auth::user()->email
                            )
                        );

                        /*Log::info((array)$result);*/
                        /**
                         * Throw error if Credit Card Payment response not success.
                         */
                        if ($result->FinalStatus != 'success') {
                            throw new Exception('Credit Card payment failed!');
                        }

                        $invoice->status = 'paid';

                    });
                } catch (Exception $e) {
                    return redirect('admin/invoices/' . $invoice->id . '/pay')->withErrors(['error' => $e->getMessage()]);
                }

            } else if ($request->input('payment_method') == 'cash_in_store') {
                $this->validate($request, [
                    'receipt_code' => 'required',
                ]);
                try {
                    DB::transaction(function () use ($request, $invoice) {
                        $storePayment = new StorePayment();
                        $storePayment->code = $request->input('receipt_code');
                        $storePayment->save();

                        $invoice->status = 'pending';
                        $invoice->store_payment_id = $storePayment->id;
                        $invoice->save();

                    });
                } catch (Exception $e) {
                    return redirect('admin/invoices/' . $invoice->id . '/pay')->withErrors(['error' => 'Something went wrong!']);
                }
            } else if ($request->input('payment_method') == 'gift_card') {
                $this->validate($request, [
                    'coupon_number' => 'required',
                ]);

                try {
                    DB::transaction(function () use ($request, $invoice) {
                        $giftCard = Auth::user()->gift_cards->where('code', $request->input('coupon_number'))->first();
                        if (!isset($giftCard)) {
                            throw new Exception('Invalid Gift Card');
                        }
                        $couponValue = 0;

                        /**
                         * Store in database
                         */

                        if ($request->has('coupon_code')) {
                            $coupon = Coupon::whereCode($request->input('coupon_code'))
                                ->whereStatus('available')
                                ->where('start_date', '<=', Carbon::now())
                                ->where('end_date', '>=', Carbon::now())
                                ->first();

                            if (isset($coupon)) {
                                if ($coupon->type == 'percentage') {
                                    $couponValue = ($coupon->value / 100 * $invoice->total);
                                } else {
                                    $couponValue = $coupon->value;
                                }

                                $coupon->status = 'used';
                                $coupon->save();
                            }
                        }

                        $amountToPay = $invoice->total - $couponValue;
                        if ($amountToPay < 0) $amountToPay = 0;


                        if ($giftCard->value < $amountToPay) {
                            throw new Exception('Not enough funds!');
                        }
                        $invoice->status = 'paid';
                    });
                } catch (Exception $e) {
                    $bag = new MessageBag();
                    $bag->add('failed_payment', $e->getMessage());
                    return redirect('admin/invoices')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
                }

            }

            $invoice->save();

            $admins = User::whereHas('role', function ($query) {
                $query->where('name', '=', 'admin');
            })->get();
            $u = Auth::user();
            try {
                Notifynder::loop($admins, function (NotifynderBuilder $builder, $user) use ($u, $invoice) {
                    $builder->category('notifications')
                        ->from(Auth::user()->id)
                        ->to($user->id)
                        ->url(url('admin/invoices/' . $invoice->id))
                        ->extra(['message' => 'Invoice ' . $invoice->id . ' has been paid by ' . $u->firstname . ' ' . $u->lastname]);

                })->send();
                Mail::send('emails.admin_new_invoice', ['user' => $u], function ($m) use ($u) {
                    $m->to($u->email, $u->firstname . ' ' . $u->lastname)
                        ->subject('New Invoice Payment');
                });
            } catch (EntityNotIterableException $e) {
            } catch (IterableIsEmptyException $e) {
            }

            return redirect('admin/invoices')->with('success', 'Paid Successful!');
        }

        return redirect('admin/invoices')->withErrors('error', 'Invoice already paid');
    }
}
