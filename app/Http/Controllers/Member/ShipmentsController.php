<?php

/**
 * This file is used to manage the 'shipment' resource.
 * Here are managed all the operations which are made on a shipment.
 * */

namespace App\Http\Controllers\Member;

use App\Item;
use App\Product;
use App\Retailer;
use App\Shipment;
use App\ShipmentDeliveryDetail;
use App\Tax;
use App\User;
use Carbon\Carbon;
use Dompdf\Exception;
use Fenos\Notifynder\Builder\NotifynderBuilder;
use Fenos\Notifynder\Exceptions\EntityNotIterableException;
use Fenos\Notifynder\Exceptions\IterableIsEmptyException;
use Fenos\Notifynder\Facades\Notifynder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Log;
use Validator;
use Mail;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShipmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $shipments = Shipment::whereHas('user', function ($query) {
            $query->where('id', '=', Auth::user()->id);
        })->get();

        return view('member.shipments.shipments')->with(compact(
            'retailers',
            'taxes',
            'shipments'
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
     * Store a new shipment in storage with all it's items.
     * * Request must contains:
     * * retailer_select - sender's name or 'add_new' if user wants to create a new sender
     * * retailer_name - sender's name
     * * retailer_website - sender's website
     * * invoice - shipment's invoice
     * * shipping_amount - user's paid shipping cost
     * * tax_amount - user's paid shipping tax
     * * weight - shipment's weight
     * * height - shipment's height
     * * length - shipment's length
     * * tracking_number - shipment's tracking number
     * * order_number - shipment's order number
     * * items - list of shipment's items
     *
     * On Success: return json with new shipment's id.
     *
     * On Error: return json with errors.
     */
    public function store(Request $request)
    {
        Log::info($request->all());

        try {
            $shipmentId = DB::transaction(function () use ($request) {
                /*Get retailer or create a new one*/
                if ($request->input('retailer_select') == 'add_new') {
                    $retailers = Retailer::where('name', '=', $request->input('retailer_name'))
                        ->where('status', '=', 'affiliate')
                        ->orWhere('name', '=', $request->input('retailer_name'))
                        ->whereHas('user', function ($query) {
                            $query->where('id', '=', Auth::user()->id);
                        })
                        ->get();
                    if ($retailers->isEmpty()) {
                        if ($request->has('url')) {
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
                            if ($request->has('url')) {
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
                    $retailer = Retailer::findOrFail($request->input('retailer_select'));
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
                $shipment->user()->associate(Auth::user());
                $shipment->retailer()->associate($retailer);
                $shipment->uploaded_file = '/uploads/invoices/' . $invoicePDF;
                $shipment->save();

                /*Store delivery details*/
                $deliverDetails = new ShipmentDeliveryDetail();
                $deliverDetails->firstname = Auth::user()->firstname;
                $deliverDetails->lastname = Auth::user()->lastname;
                $deliverDetails->address1 = Auth::user()->home_address->address1;
                $deliverDetails->address2 = Auth::user()->home_address->address2;
                $deliverDetails->city = Auth::user()->home_address->city;
                $deliverDetails->state = Auth::user()->home_address->state;
                $deliverDetails->country = Auth::user()->home_address->country;
                $deliverDetails->zip_code = Auth::user()->home_address->zip_code;
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

                $admins = User::whereHas('role', function ($query) {
                    $query->where('name', '=', 'admin');
                })->get();


                try {
                    Notifynder::loop($admins, function (NotifynderBuilder $builder, $user) use ($shipment) {
                        $builder->category('notifications')
                            ->from(Auth::user()->id)
                            ->to($user->id)
                            ->url(url('admin/shipments/' . $shipment->id))
                            ->extra(['message' => 'Shipment order ' . $shipment->id . ' has been created']);

                    })->send();
                } catch (EntityNotIterableException $e) {
                } catch (IterableIsEmptyException $e) {
                }

                /*Send mail to admins*/
                $emails = User::whereHas('role', function ($query) {
                    $query->where('name', '=', 'admin');
                })->lists('email')->toArray();

                Mail::send('emails.new_shipment', [], function ($message) use ($emails) {
                    $message->to($emails);
                    $message->subject('New shipment');
                });

                return $shipment->id;
            });

            return response()->json([
                'shipment_id' => $shipmentId
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
     * Update an uploaded invoice for a shipment.
     * * Request must contains:
     * * shipment_id - shipment's id
     * * shipment_invoice - shipment's invoice
     *
     * On Success: return message 'Shipment Invoice replaced successfully!'
     *
     * On Error: error message 'Something went wrong!'
     */
    public function uploadShipmentInvoice(Request $request)
    {
        try {
            $shipment = Shipment::findOrFail($request->input('shipment_id'));

            $destinationPath = public_path() . '/uploads/invoices';
            $invoicePDF = hash('sha256', mt_rand()) . '.' . $request->file('shipment_invoice')->getClientOriginalExtension();
            $request->file('shipment_invoice')->move($destinationPath, $invoicePDF);

            $shipment->uploaded_file = '/uploads/invoices/' . $invoicePDF;

            $shipment->save();
        } catch (Exception $e) {
            return redirect('member/shipments')->withErrors('error', 'Something went wrong!');
        }

        return redirect('member/shipments')->with('success', 'Shipment Invoice replaced successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipment = Shipment::findOrFail($id);
        return view('member.shipments.shipment_detail')->with(compact('shipment'));
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

        if ($shipment->status == 'pending_approval') {
            $retailers = Retailer::where('status', '=', 'affiliate')
                ->orWhere('user_id', '=', Auth::user()->id)
                ->where('archived', '=', 0)->get();

            if (!$retailers->contains($shipment->retailer->id)) {
                $retailers->push($shipment->retailer);
                $retailers = $retailers->sortBy('id')->values();
            }

            $taxes = Tax::all()->sortBy('description');

            return view('member.shipments.edit_shipment')->with(compact(
                'shipment',
                'retailers',
                'taxes'
            ));
        }

        $bag = new MessageBag();
        $bag->add('alreadyApproved', $shipment->name . ' was already approved by an admin.');
        return redirect('member/shipments')->with(compact('shipment'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
    }

    public function cancel($id)
    {
        $shipment = Shipment::findOrFail($id);

        if ($shipment->status == 'pending_approval') {
            DB::transaction(function() use($shipment) {
                $shipment->delete();
                $shipment->product->delete();
            });

            $admins = User::whereHas('role', function ($query) {
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

            /*Send mail to admins*/
            $emails = User::whereHas('role', function ($query) {
                $query->where('name', '=', 'admin');
            })->lists('email')->toArray();

            Mail::send('emails.cancel_shipment', [], function ($message) use ($emails, $shipment) {
                $message->to($emails);
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

        if ($shipment->status == 'pending_approval') {
            try {
                DB::transaction(function () use ($request, $shipment) {
                    /*Update shipment*/
                    $shipment->retailer()->associate(Retailer::findOrFail($request->input('retailer')));
                    $shipment->weight = $request->input('weight');
                    $shipment->height = $request->input('height');
                    $shipment->width = $request->input('width');
                    $shipment->length = $request->input('length');
                    $shipment->tracking_number = $request->input('tracking_number');
                    $shipment->order_number = $request->input('order_number');
                    $shipment->retailer_shipping_cost = $request->input('retailer_shipping_cost');
                    $shipment->retailer_tax = $request->input('retailer_tax');
                    $shipment->save();

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

                $admins = User::whereHas('role', function ($query) {
                    $query->where('name', '=', 'admin');
                })->get();


                try {
                    Notifynder::loop($admins, function (NotifynderBuilder $builder, $user) use ($shipment) {
                        $builder->category('notifications')
                            ->from(Auth::user()->id)
                            ->to($user->id)
                            ->url(url('admin/shipments/' . $shipment->id))
                            ->extra(['message' => 'Shipment order ' . $shipment->id . ' has been edited.']);

                    })->send();
                } catch (EntityNotIterableException $e) {
                } catch (IterableIsEmptyException $e) {
                }

                /*Send mail to admins*/
                $emails = User::whereHas('role', function ($query) {
                    $query->where('name', '=', 'admin');
                })->lists('email')->toArray();

                Mail::send('emails.edit_shipment', [], function ($message) use ($emails, $shipment) {
                    $message->to($emails);
                    $message->subject('Shipment ' . $shipment->id . ' was edited.');
                });

                $message = $shipment->name . ' has been successfully edited.';

                return redirect('member/shipments/' . $shipment->id)->with('success', $message);
            } catch (\Exception $e) {
                Log::info($e);

                $bag = new MessageBag();
                $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
                return redirect('member/shipments/' . $shipment->id)->with(compact('shipment'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
            }
        }

        $bag = new MessageBag();
        $bag->add('alreadyApproved', $shipment->name . ' was already approved by an admin.');
        return redirect('member/shipments')->with(compact('shipment'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
    }

    /**
     * @param Menu $menu
     */
    public function destroy(Request $request, Menu $menu)
    {

    }
}
