<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Fenos\Notifynder\Builder\NotifynderBuilder;
use Fenos\Notifynder\Exceptions\EntityNotIterableException;
use Fenos\Notifynder\Exceptions\IterableIsEmptyException;
use Fenos\Notifynder\Facades\Notifynder;
use Fenos\Notifynder\Models\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\Retailer;
use App\Tax;
use App\ShipmentDeliveryDetail;
use App\Item;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Log;
use Illuminate\Support\Facades\Auth;
use Mail;

class ShipmentsController extends Controller
{

    /**
     * Map statues of shipment
     * @var array
     */
    private $shipmentStatusMap;

    public function __construct()
    {
        $this->shipmentStatusMap = [
            'ordered' => 'Ordered',
            'pending_approval' => 'Pending Approval',
            'received_in_us' => 'Received in US,',
            'in_transit' => 'In Transit',
            'invoice_needed' => 'Invoice Needed',
            'pending_payment' => 'Pending Payment',
            'ready_for_pickup' => 'Ready for Pickup',
            'in_storage' => 'In Storage',
            'not_available' => 'Not Available',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered',
            'collected' => 'Collected',
        ];
    }

    /**
     * Display a listing of the shipments.
     *
     * @return View
     */
    public function index()
    {
        $retailers = Retailer::where('status', '=', 'affiliate')
            ->where('archived', '=', 0)
            ->orWhereHas('user', function ($query) {
                $query->where('id', '=', Auth::user()->id);
            })
            ->where('archived', '=', 0)
            ->get();
        $taxes = Tax::all()->sortBy('description')->values();
        $shipments = Shipment::all();
        $users = User::where('role_id', '=', 2)
            ->has('bill_address')
            ->with('bill_address')
            ->get();

        return view('admin.shipments.shipments')->with(compact(
            'retailers',
            'taxes',
            'shipments',
            'users'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created shipment in storage.
     *
     *  * Request must contain:
     *  * retailer_id - id of retailer
     *  * retailer_name - name of retailer
     *  * invoice - pdf file invoice
     *  * shipping_amount
     *  * tax_amount
     *  * weight
     *  * height
     *  * length
     *  * d
     *  * tracking_number
     *  * order_number
     *  * user
     *  * delivery_firstname
     *  * delivery_lastname
     *  * delivery_address
     *  * delivery_city
     *  * delivery_state
     *  * delivery_zip_code
     *  * delivery_zip_country
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * On Success: return success message. User will be notified via notification and via email.
     *
     * On Error: return error message 'Something went wrong! Please try again later.'
     */
    public function store(Request $request)
    {

        try {
            $shipment = DB::transaction(function () use ($request) {
                /*Get retailer or create a new one*/
                if ($request->input('retailer_id') == 'add_new') {
                    $retailers = Retailer::where('name', '=', $request->input('retailer_name'))
                        ->where('status', '=', 'affiliate')
                        ->orWhere('name', '=', $request->input('retailer_name'))
                        ->whereHas('user', function ($query) {
                            $query->where('id', '=', Auth::user()->id);
                        })
                        ->get();
                    if ($retailers->isEmpty()) {
                        if($request->has('url')) {
                            $retailers = Retailer::where('website', '=', $request->input('retailer_website'))
                                ->where('status', '=', 'affiliate')
                                ->orWhere('name', '=', $request->input('retailer_name'))
                                ->whereHas('user', function ($query) {
                                    $query->where('id', '=', Auth::user()->id);
                                })
                                ->get();
                        }
                        if ($retailers->isEmpty()) {
                            $retailer = new Retailer();
                            $retailer->user()->associate(Auth::user());
                            $retailer->name = $request->input('retailer_name');
                            if($request->has('url')) {
                                $retailer->website = (strpos($request->input('retailer_website'), 'http://') === 0 || strpos($request->input('retailer_website'), 'https://') === 0) ? $request->input('retailer_website') : 'http://' . $request->input('retailer_website');
                            }
                            $retailer->save();
                        } else {
                            $retailer = $retailers->first();
                        }
                    } else {
                        $retailer = $retailers->first();
                    }
                } else {
                    $retailer = Retailer::findOrFail($request->input('retailer_id'));
                }

                /*Upload invoice pdf*/
                $destinationPath = public_path() . '/uploads/invoices';
                $invoicePDF = hash('sha256', mt_rand()) . '.' . $request->file('invoice')->getClientOriginalExtension();
                $request->file('invoice')->move($destinationPath, $invoicePDF);

                /*Create shipment*/
                $shipment = new Shipment();
                $shipment->retailer_shipping_cost = $request->input('shipping_amount');
                $shipment->retailer_tax = $request->input('tax_amount');
                $shipment->status = 'pending_approval';
                $shipment->weight = $request->input('weight');
                $shipment->height = $request->input('height');
                $shipment->length = $request->input('length');
                $shipment->width = $request->input('d');
                $shipment->tracking_number = $request->input('tracking_number');
                $shipment->order_number = $request->input('order_number');
                $shipment->user()->associate(User::findOrFail($request->input('user')));
                $shipment->retailer()->associate($retailer);
                $shipment->uploaded_file = '/uploads/invoices/' . $invoicePDF;
                $shipment->save();

                /*Store delivery details*/
                $deliverDetails = new ShipmentDeliveryDetail();
                $deliverDetails->firstname = $request->input('delivery_firstname');
                $deliverDetails->lastname = $request->input('delivery_lastname');
                $deliverDetails->address1 = $request->input('delivery_address');
                $deliverDetails->address2 = '';
                $deliverDetails->city = $request->input('delivery_city');
                $deliverDetails->state = $request->input('delivery_state');
                $deliverDetails->country = $request->input('delivery_country');
                $deliverDetails->zip_code = $request->input('delivery_zip_code');
                $deliverDetails->shipment()->associate($shipment);
                $deliverDetails->save();

                /*Create items*/
                $dutyCost = 0;
                $itemsCost = 0;
                foreach ($request->input('items') as $item) {
                    $item = json_decode($item);

                    $dbItem = new Item();
                    $dbItem->name = $item->description;
                    $dbItem->qty = $item->quantity;
                    $dbItem->cost = $item->cost;
                    $dbItem->shipment()->associate($shipment);
                    $dbItem->classification = $item->tax;
                    $dbItem->tax()->associate(Tax::findOrFail($item->tax));
                    $dbItem->retailer()->associate($retailer);
                    $dbItem->save();

                    /*Compute duty cost per shipment*/
                    $_duty = $dbItem->tax->duty;
                    /*$_cost = Tax::where('description', '=', $item->tax)->first()->cost();*/

                    $dutyCost += /*$_cost **/
                        $item->quantity * $item->cost * ($_duty / 100);
                    $itemsCost += $item->quantity * $item->cost;
                }

                $shipment->name = 'Shipment ' . $shipment->id;
                $shipment->duty_cost = $dutyCost;
                $shipment->duty_tax = ($itemsCost + $request->input('shipping_amount') + $request->input('tax_amount')) * getSetting('VAT_TAX') / 100;
                $shipment->cost = $itemsCost + $request->input('shipping_amount') + $request->input('tax_amount');
                $shipment->save();

                /*Create product*/
                $product = new Product();
                $product->shipment()->associate($shipment);
                $product->type = 'shipment';
                $product->save();

                /*Send mail to admins*/
                /*$emails = User::whereHas('role', function($query) {
                    $query->where('name', '=', 'admin');
                })->lists('email')->toArray();
                Log::info($emails);

                Mail::send('emails.new_shipment', [], function ($message) use($emails) {
                    $message->to($emails);
                    $message->subject('New shipment');
                });*/

                return $shipment;
            });

            $user = $shipment->user;

            Notifynder::category('notifications')
                ->from(Auth::user()->id)
                ->to($user->id)
                ->url(url('member/shipments/' . $shipment->id))
                ->extra(['message' => 'Your shipment order' . $shipment->id . ' has been approved, an invoice will be issued to you shortly.'])
                ->send();

            Mail::send('emails.admin_new_shipment', [
                'user' => $user,
                'notificationMessage' => 'Your shipment order' . $shipment->id . ' has been approved, an invoice will be issued to you shortly.'
            ], function ($m) use ($user) {
                $m->to($user->email, $user->firstname . ' ' . $user->lastname)
                    ->subject('New Shipment');
            });


            return response()->json([
                'shipment_id' => $shipment->id,
                'shipment' => $shipment
            ], 200);
        } catch (\Exception $e) {
            Log::info($e);
            return response()->json(array(
                'errors' => array(
                    'transactionFailed' => 'Something went wrong! Please try again later.'
                )
            ), 400);
        }
    }

    /**
     * Upload shipment pdf invoice.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect to 'admin/invoices' with success message 'Shipment Invoice replaced succesfuly!'
     *
     * On Error: redirect to 'admin/invoices' with error message 'Something went wrong!'
     */
    public function uploadShipmentInvoice(Request $request) {

        try {
            $shipment = Shipment::findOrFail($request->input('shipment_id'));

            $destinationPath = public_path() . '/uploads/invoices';
            $invoicePDF = hash('sha256', mt_rand()) . '.' . $request->file('shipment_invoice')->getClientOriginalExtension();
            $request->file('shipment_invoice')->move($destinationPath, $invoicePDF);

            $shipment->uploaded_file = '/uploads/invoices/' . $invoicePDF;

            $shipment->save();
        } catch (Exception $e) {
            return redirect('admin/shipments')->withErrors('error', 'Something went wrong!');
        }

        return redirect('admin/shipments')->with('success', 'Shipment Invoice replaced succesfuly!');
    }

    /**
     * Display the specified shipment.
     *
     * @param  int $id
     * @return View
     */
    public function show($id)
    {
        $shipment = Shipment::findOrFail($id);
        return view('admin.shipments.shipment_detail')->with(compact('shipment'));
    }

    /**
     * Show the form for editing the specified shipment.
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        $shipment = Shipment::findOrFail($id);
        $users = User::where('role_id', '=', 2)->get();
        $retailers = Retailer::all();
        $taxes = Tax::all()->sortBy('description');

        return view('admin.shipments.edit_shipment')->with(compact(
            'shipment',
            'users',
            'retailers',
            'taxes'
        ));
    }

    public function cancel($id)
    {
        $shipment = Shipment::findOrFail($id);

        if ($shipment->status == 'pending_approval') {
            DB::transaction(function() use($shipment) {
                $shipment->delete();
                $shipment->product->delete();
            });

            $admins = User::where('id', '<>', Auth::user()->id)->whereHas('role', function ($query) {
                $query->where('name', '=', 'admin');
            })->get();

            try {
                Notifynder::loop($admins, function (NotifynderBuilder $builder, $user) use ($shipment) {
                    $builder->category('notifications')
                        ->from(Auth::user()->id)
                        ->to($user->id)
                        ->url(url('admin/shipments'))
                        ->extra(['message' => 'Shipment order ' . $shipment->id . ' has been canceled.']);

                })->send();
            } catch (EntityNotIterableException $e) {
            } catch (IterableIsEmptyException $e) {
            }

            Notifynder::category('notifications')
                ->from(Auth::user()->id)
                ->to($shipment->user->id)
                ->url(url('member/shipments'))
                ->extra(['message' => 'Shipment order ' . $shipment->id . ' has been canceled.'])->send();

            Mail::send('emails.cancel_shipment', [], function ($message) use ($shipment) {
                $message->to($shipment->user->email);
                $message->subject('Shipment ' . $shipment->id . ' was canceled.');
            });

            return redirect('member/shipments')->with('success', $shipment->name . ' was successfully canceled.');
        }

        $bag = new MessageBag();
        $bag->add('alreadyApproved', $shipment->name . ' was already approved by an admin.');
        return redirect('member/shipments')->with(compact('shipment'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
    }

    /**
     * Update the specified shipment in storage.
     *
     *  * Request must contain:
     *  * retailer_id - id of retailer
     *  * retailer_name - name of retailer
     *  * invoice - pdf file invoice
     *  * status - shipment status
     *  * shipping_amount
     *  * tax_amount
     *  * weight
     *  * height
     *  * length
     *  * d
     *  * tracking_number
     *  * order_number
     *  * user
     *  * delivery_firstname
     *  * delivery_lastname
     *  * delivery_address
     *  * delivery_city
     *  * delivery_state
     *  * delivery_zip_code
     *  * delivery_zip_country
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * On Success: return success message '[Shipment name] has been successfully edited.'. User will be notified via notification and via email.
     *
     * On Error: return error message 'Something went wrong! Please try again later.'
     *
     */
    public function update(Request $request, $id)
    {
        $shipment = Shipment::findOrFail($id);
        $oldStatus = $shipment->status;

        try {
            DB::transaction(function () use ($request, $shipment) {
                /*Update shipment*/
                $shipment->user()->associate(User::findOrFail($request->input('user')));
                $shipment->retailer()->associate(Retailer::findOrFail($request->input('retailer')));
                $shipment->weight = $request->input('weight');
                $shipment->height = $request->input('height');
                $shipment->status = $request->input('status');
                if ($request->input('status') == 'collected') {
                    $shipment->collected_date = Carbon::now();
                }
                if ($request->input('status') == 'ready_for_pickup') {
                    $shipment->pickup_date = Carbon::now();
                }
                $shipment->width = $request->input('width');
                $shipment->length = $request->input('length');
                $shipment->tracking_number = $request->input('tracking_number');
                $shipment->order_number = $request->input('order_number');
                $shipment->retailer_shipping_cost = $request->input('retailer_shipping_cost');
                $shipment->retailer_tax = $request->input('retailer_tax');
                $shipment->save();

                /*Update devlivery details*/
                $shipment->delivery_details->firstname = $request->input('firstname');
                $shipment->delivery_details->lastname = $request->input('lastname');
                $shipment->delivery_details->address1 = $request->input('address1');
                $shipment->delivery_details->address2 = $request->input('address2');
                $shipment->delivery_details->city = $request->input('city');
                $shipment->delivery_details->state = $request->input('state');
                $shipment->delivery_details->country = $request->input('country');
                $shipment->delivery_details->save();

                /*Update items*/
                $dutyCost = 0;
                $itemsCost = 0;
                foreach ($shipment->items as $index => $item) {
                    /* Update item detail. */
                    $item->name = $request->input('name')[$index];
                    $item->qty = $request->input('quantity')[$index];
                    $item->cost = number_format(($request->input('cost')[$index]), 2, '.', ',');
                    $item->tax()->associate(Tax::findOrFail($request->input('classification')[$index]));
                    $item->save();

                    $dutyCost += $item->qty * $item->cost * ($item->tax->duty / 100);
                    $itemsCost += $item->qty * $item->cost;
                }

                $shipment->duty_cost = $dutyCost;
                $shipment->cost = $itemsCost + $request->input('retailer_shipping_cost') + $request->input('retailer_tax');
                $shipment->duty_tax = getSetting('VAT_TAX') / 100 * ($itemsCost + $shipment->retailer_shipping_cost + $shipment->retailer_tax);
                $shipment->save();
            });

            if ($shipment->status != $oldStatus) {
                Notifynder::category('notifications')
                    ->from(Auth::user()->id)
                    ->to($shipment->user->id)
                    ->url(url('member/shipments/' . $shipment->id))
                    ->extra(['message' => 'Your shipment order ' . $shipment->id . '\'s status has been changed from "' .
                        $this->shipmentStatusMap[$oldStatus] . '" to "' . $this->shipmentStatusMap[$shipment->status] . '"'])
                    ->send();

                Mail::send('emails.admin_new_shipment', [
                    'user' => $shipment->user,
                    'notificationMessage' => 'Your shipment order ' . $shipment->id . '\'s status has been changed from "' .
                        $this->shipmentStatusMap[$oldStatus] . '" to "' . $this->shipmentStatusMap[$shipment->status] . '"'
                ], function ($m) use ($shipment) {
                    $m->to($shipment->user->email, $shipment->user->firstname . ' ' . $shipment->user->lastname)
                        ->subject('Shipment Approved');
                });
            }

            $message = $shipment->name . ' has been successfully edited.';

            return redirect('admin/shipments/' . $shipment->id)->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/shipments/' . $shipment->id)->with(compact('shipment'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO
    }

    /**
     * Get shipment's user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * On Success: return Json with shipment, products and user objects
     */
    public function getByUser(Request $request)
    {

        /*Store invoice's user on session*/
        Session::put('invoice_user_id', $request->input('user_id'));

        $user = User::findOrFail($request->input('user_id'));

        /*Get shipments without invoice.*/
        $shipments = Shipment::whereHas('user', function($query) use($request) {
            $query->where('id', '=', $request->input('user_id'));
        })->whereDoesntHave('product.invoices')->with('product')->get();

        return response()->json([
            'shipments' => $shipments,
            'user' => $user->load('home_address', 'bill_address')
        ], 200);
    }

    /**
     * Approve specified shipment
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * On Success: redirect to 'admin/shipments' with success message 'Shipment Approved'. User  will be notified via notification and email.
     *
     * On Error: redirect to 'admin/shipments' with error message 'Something went wrong! Please try again later.'
     *
     */
    public function approve($id)
    {
        $shipment = Shipment::findOrFail($id);

        try {
            DB::transaction(function () use ($shipment) {
                $shipment->status = 'ordered';
                $shipment->save();
            });

            $message = $shipment->name . ' has been successfully approved.';

            $user = $shipment->user;

            Notifynder::category('notifications')
                ->from(Auth::user()->id)
                ->to($user->id)
                ->url(url('member/shipments/' . $shipment->id))
                ->extra(['message' => 'Your shipment order' . $shipment->id . ' has been approved, an invoice will be issued to you shortly.'])
                ->send();

            Mail::send('emails.admin_new_shipment', [
                'user' => $user,
                'notificationMessage' => 'Your shipment order' . $shipment->id . ' has been approved, an invoice will be issued to you shortly.'
            ], function ($m) use ($user) {
                $m->to($user->email, $user->firstname . ' ' . $user->lastname)
                    ->subject('Shipment Approved');
            });

            return redirect('admin/shipments')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/shipments')->with(compact('shipment'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    /**
     * Mark a shipment as collected
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * On Success: redirect to 'admin/shipments' with success message  'Shipment Collected'. User will be notified via notification and email
     *
     * On Error: redirect to 'admin/shipments' with error message 'Something went wrong! Please try again later.'
     */
    public function collect($id)
    {
        $shipment = Shipment::findOrFail($id);

        try {
            DB::transaction(function () use ($shipment) {
                $shipment->status = 'collected';
                $shipment->collected_date = Carbon::now();
                $shipment->save();
            });

            $message = $shipment->name . ' has been successfully collected.';

            $user = $shipment->user;

            Notifynder::category('notifications')
                ->from(Auth::user()->id)
                ->to($user->id)
                ->url(url('member/shipments/' . $shipment->id))
                ->extra(['message' => 'Your shipment order' . $shipment->id . ' has been collect.'])
                ->send();

            Mail::send('emails.admin_new_shipment', [
                'user' => $user,
                'notificationMessage' => 'Your shipment order' . $shipment->id . ' has been collect.'
            ], function ($m) use ($user) {
                $m->to($user->email, $user->firstname . ' ' . $user->lastname)
                    ->subject('Shipment Collected');
            });

            return redirect('admin/shipments')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/shipments')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }
}
