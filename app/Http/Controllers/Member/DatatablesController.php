<?php

/**
 * This file is used for getting tables for the views.
 * I.e. shipments table, invoices table etc.
 * */

namespace App\Http\Controllers\Member;

use App\Invoice;
use App\Retailer;
use App\Shipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Log;

class DatatablesController extends Controller
{
    private $shipmentStatusMap;

    public function __construct()
    {
        $this->middleware('auth');
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

    /** Called from JS to get the table of shipments */
    public function getShipments()
    {
        $shipments = Shipment::where('user_id', '=', Auth::user()->id);

        return Datatables::of($shipments)
            ->editColumn('id', function($shipment) {
                return '<a href="' . url('member/shipments/' . $shipment->id) . '">' . $shipment->id . '</a>';
            })
            ->addColumn('shipment_invoice', function ($shipment) {
                return '<a class="link" href="' . url($shipment->uploaded_file) . '?download=1"><i class="download-ico"></i>Invoice</a>';
            })
            ->editColumn('retailer_id', function($shipment) {
                return $shipment->retailer->name;
            })
            ->addColumn('total_value', function($shipment) {
                $total = 0;

                foreach($shipment->items as $item) {
                    $total += $item->qty * $item->cost;
                }

                $total += $shipment->retailer_shipping_cost;
                $total += $shipment->retailer_tax;

                return '$' . number_format($total, 2, '.', ',');
            })
            ->addColumn('total_duty', function($shipment) {
                $total = 0;

                foreach($shipment->items as $item) {
                    $total += ($item->qty * $item->cost) * $item->tax->duty / 100;
                }

                return '$' . number_format($total, 2, '.', ',');
            })
            ->addColumn('total_vat', function($shipment) {
                $total = 0;

                foreach($shipment->items as $item) {
                    $total += $item->qty * $item->cost;
                }

                $total += $shipment->retailer_shipping_cost;
                $total += $shipment->retailer_tax;

                $totalVat = $total * getSetting('VAT_TAX') / 100;

                return '$' . number_format($totalVat, 2, '.', ',');
            })
            ->editColumn('pickup_date', function($shipment) {
                if($shipment->pickup_date) {
                    return Carbon::parse($shipment->pickup_date)->diffForHumans();
                }

                return '-';
            })
            ->editColumn('collected_date', function($shipment) {
                if($shipment->collected_date)
                    return Carbon::parse($shipment->collected_date)->format('d-M-Y');

                return '-';
            })
            ->editColumn('status', function($shipment) {
                return '<div class="btn btn-'. $shipment->status .'">' .
                $this->shipmentStatusMap[$shipment->status] .
                '</div>';
            })->editColumn('_status', function($shipment) {
                return $shipment->status;
            })
            ->make(true);
    }

    /** Called from JS to get the table of invoices */
    public function getInvoices()
    {
        $invoices = Invoice::whereHas('user', function ($query) {
            $query->where('id', '=', Auth::user()->id);
            $query->where('status', '!=', 'draft');
        });

        return Datatables::of($invoices)
            ->editColumn('id', function($invoice) {
                return '<a href="' . url('member/invoices/' . $invoice->id) . '">' . $invoice->id . '</a>';
            })
            ->editColumn('created_at', function ($invoice) {
                return Carbon::parse($invoice->created_at)->format('d-M-Y');
            })
            ->addColumn('due_date', function ($invoice) {
                if ($invoice->status == 'paid') {
                    return 'Paid';
                }

                $formattedDueDate = Carbon::parse(explode(' ', $invoice->due_date)[0]);
                $formattedNowDate = Carbon::parse(explode(' ', Carbon::now())[0]);

                if ($formattedDueDate->eq($formattedNowDate))
                    return 'Today';
                else if ($formattedDueDate->lt($formattedNowDate))
                    return Carbon::parse($invoice->due_date)->diffForHumans();

                return Carbon::parse($invoice->due_date)->format('d-M-Y');
            })
            ->editColumn('total', function ($invoice) {
                return '$' . number_format($invoice->total, 2, '.', ',');
            })->addColumn('store_code', function($invoice) {
                return isset($invoice->store_payment->code) ? $invoice->store_payment->code : '-';
            })
            ->editColumn('status', function ($invoice) {
                if ($invoice->status == 'paid') {
                    return '<div class="invoice-stat-col" style="color:#c12036;">' .
                    '<i class="check-icon" aria-hidden="true"></i>' .
                    '<span>Paid</span>' .
                    '</div>';
                } else if($invoice->status == 'pending') {
                    return '<div class="invoice-stat-col" style="color:#d98800;">' .
                    '<i class="fa fa-clock-o" aria-hidden="true"></i>' .
                    '<span>Pending approval</span>' .
                    '</div>';
                }

                return '<div class="invoice-stat-col">' .
                '<i class="x-icon" aria-hidden="true"></i>' .
                '<span>Unpaid</span>' .
                '</div>';
            })
            ->addColumn('action', function ($invoice) {
                if ($invoice->status == 'unpaid') {
                    return '<a class="btn btn-outline" href="' . url('member/invoices/' . $invoice->id . '/pay') . '">' .
                    'Pay invoice</a>';
                }

                return '';
            })
            ->make(true);
    }

    /** Called from JS to get the table of senders added by the member */
    public function getRetailers()
    {
        $retailers = Retailer::whereHas('user', function($query) {
            $query->where('id', '=', Auth::user()->id);
        });

        return Datatables::of($retailers)
            ->editColumn('id', function($retailer) {
                return '<a href="' . url('member/senders/' . $retailer->id . '/edit') . '">' . $retailer->id . '</a>';
            })
            ->editColumn('archived', function($retailer) {
                return $retailer->archived == 1 ? '<span class="txt-archived">Archived</span>' : '<span style="color: green;">Active</span>';
            })
            ->editColumn('website', function($retailer) {
                return $retailer->website ? $retailer->website : '-';
            })
            ->make(true);
    }
}
