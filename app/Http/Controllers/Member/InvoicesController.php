<?php

/**
 * This file is used to manage the 'invoice' resource.
 * Here are managed all the operations which are made on an invoice.
 * */

namespace App\Http\Controllers\Member;

use App\Address;
use App\Coupon;
use App\Invoice;
use App\PaymentGateways\PnP;
use App\StorePayment;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Fenos\Notifynder\Builder\NotifynderBuilder;
use Fenos\Notifynder\Exceptions\EntityNotIterableException;
use Fenos\Notifynder\Exceptions\IterableIsEmptyException;
use Fenos\Notifynder\Facades\Notifynder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Log;
use Mail;
use App\User;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function invoices()
    {

    }

    public function invoiceDetail()
    {

    }

    /** Return the view for paying an invoice. */
    public function showPayInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        $user = Auth::user();
        return view('member.invoices.pay_invoice')->with(compact('invoice', 'user'));
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

        $this->validate($request, [
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
        ]);

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
                    return redirect('member/invoices/' . $invoice->id . '/pay')->withErrors(['error' => $e->getMessage()]);
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
                    return redirect('member/invoices/' . $invoice->id . '/pay')->withErrors(['error' => 'Something went wrong!']);
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
                    return redirect('member/invoices')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
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

            return redirect('member/invoices')->with('success', 'Paid Successful!');
        }

        return redirect('member/invoices')->withErrors('error', 'Invoice already paid');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::whereHas('products.shipment.user', function ($query) {
            $query->where('id', '=', Auth::user()->id);
        })->get();
        return view('member.invoices.invoices')->with(compact(
            'invoices'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * @param MenuRequest $request
     * @return mixed
     */
    public function store(MenuRequest $request)
    {
        Log::info($request->all());
        return response()->json([], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('member.invoices.invoice_detail')->with(compact('invoice'));
    }

    /**
     * @param Menu $menu
     * @return mixed
     */
    public function edit(Menu $menu)
    {

    }

    /**
     * @param MenuRequest $request
     * @param Menu $menu
     */
    public function update(MenuRequest $request, Menu $menu)
    {

    }

    /**
     * @param Menu $menu
     */
    public function destroy(Request $request, Menu $menu)
    {

    }

}
