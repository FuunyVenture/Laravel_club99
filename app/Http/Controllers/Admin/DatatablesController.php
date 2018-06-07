<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Feature;
use App\Fee;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Product;
use App\Shipment;
use App\Menu;
use App\Package;
use App\Page;
use App\Retailer;
use App\Tax;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\User;
use App\Setting;
use App\Role;

use Log;


class DatatablesController extends Controller
{

    /**
     * Contains mapped statuses of a shipment
     * @var array
     */

    private $shipmentStatusMap;

    //
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

    /**
     * Populate users admin frontend table via AJAX
     * @return mixed
     */
    public function getUsers()
    {
        $users = User::where('role_id', '!=', 1);

        return Datatables::of($users)
            ->editColumn('id', function ($user) {
                return '<a style="margin-right: 0.1em;" href="' . url('admin/users/' . $user->id) . '"  title="Edit">' . $user->id . '</a>';
            })
            ->editColumn('subscription_id', function ($user) {
                if (isset($user->subscription->package) && !is_null($user->subscription->package)) {
                    return $user->subscription->package->name;
                } else {
                    return '-';
                }
            })
            ->addColumn('subscription_end', function ($user) {
                if (isset($user->subscription) && count($user->subscription) > 0) {
                    return $user->subscription->first()->ends_at;
                } else {
                    return '-';
                }
            })
            ->addColumn('status', function ($user) {
                if (isset($user->subscription) && $user->subscription->status == 'active') {
                    return Carbon::parse($user->subscription->first()->ends_at)->gt(Carbon::now()) ? '<div class="active-status">Active</div>' : '<div class="expired-status">Expired</div>';
                } else if (isset($user->subscription) && $user->subscription->status == 'pending') {
                    return '<a class="btn btn-primary" href="' . url('admin/users/' . $user->id . '/activate') . '">Activate</a>';
                } else {
                    return '-';
                }
            })->addColumn('actions', function ($user) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/users/' . $user->id . '/edit/') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/users/' . $user->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Permanent Delete"><i class="fa fa-2 fa-remove"></i></i></a>';
                return '' . $editBtn . $deleteBtn;
            })->make(true);
    }

    /**
     * Populate Settings admin frontend table via AJAX
     * @return mixed
     */
    public function getSettings()
    {
        $settings = Setting::all();

        return Datatables::of($settings)
            ->editColumn('value', function ($setting) {
                return htmlentities(strlen($setting->getOriginal('value')) > 50 ? substr($setting->getOriginal('value'), 0, 50) : $setting->getOriginal('value'));
            })
            ->addColumn('actions', function ($setting) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/settings/' . $setting->id . '/edit/') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';

                return $editBtn;
            })->make(true);
    }

    /**
     * Populate Roles admin frontend table via AJAX
     * @return mixed
     */
    public function getRoles()
    {
        $roles = Role::all();

        return Datatables::of($roles)
            ->editColumn('routes', function ($role) {
                return htmlentities(strlen($role->getOriginal('routes')) > 50 ? substr($role->getOriginal('routes'), 0, 50) : $role->getOriginal('routes'));
            })
            ->addColumn('actions', function ($role) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/roles/' . $role->id . '/edit/') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '';
                if ($role->name != 'Admin') {
                    $deleteBtn = '&nbsp;<a href="' . url('admin/roles/' . $role->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Permanent Delete"><i class="fa fa-2 fa-remove"></i></i></a>';
                }
                return $editBtn . $deleteBtn;
            })->make(true);
    }

    /**
     * Populate menus admin frontend table via AJAX
     * @return mixed
     */
    public function getMenus()
    {
        $menus = Menu::all();

        return Datatables::of($menus)
            ->addColumn('actions', function ($menu) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/menus/' . $menu->id . '/edit/') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/menus/' . $menu->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Permanent Delete"><i class="fa fa-2 fa-remove"></i></i></a>';
                return $editBtn . $deleteBtn;
            })->make(true);
    }

    /**
     * Populate Packages admin frontend tables
     * @return mixed
     */
    public function getPackages()
    {
        $packages = Package::all()->sortBy('cost');

        return Datatables::of($packages)
            ->editColumn('name', '<a href="{{ url(\'admin/packages/\'.$id) }}"><b>{{ $name }}</b></a>')
            ->editColumn('cost', function ($package) {
                return $package->cost . '/' . $package->cost_per;
            })
            ->addColumn('actions', function ($package) {
                $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/packages/' . $package->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/packages/' . $package->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';

                $buttons = '' . $editBtn . $deleteBtn;
                return $buttons;
            })->make(true);
    }

    /**
     * Populate Features admin frontend table via AJAX
     * @return mixed
     */
    public function getFeatures()
    {
        $features = Feature::all();

        return Datatables::of($features)
            //->editColumn('name', '<a href="{{ url(\'admin/features/\'.$id) }}"><b>{{ $name }}</b></a>')
            ->addColumn('actions', function ($feature) {
                $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/features/' . $feature->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/features/' . $feature->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';

                $buttons = '' . $editBtn . $deleteBtn;
                return $buttons;
            })->make(true);
    }

    /**
     * Populate Pages admin frontend table via AJAX
     * @return mixed
     */
    public function getPages()
    {
        $pages = Page::all();

        return Datatables::of($pages)
            ->editColumn('title', '<a href="{{ url(\'admin/pages/\'.$id) }}" target="_blank"><b>{{ $title }}</b></a>')
            ->addColumn('actions', function ($page) {
                $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/pages/' . $page->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';

                $deleteBtn = '&nbsp;<a href="' . url('admin/pages/' . $page->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></i></a>';

                $viewBtn = '<a style="margin-right: 0.2em;" href="' . url($page->slug) . '"  title="View" target="blank"><i class="fa fa-2 fa-eye"></i></a>';

                $buttons = '' . $editBtn . $viewBtn . $deleteBtn;
                return $buttons;
            })->make(true);
    }

    /**
     * Populate Shipments admin frontend table via AJAX
     * @return mixed
     */
    public function getShipments()
    {
        $users = User::where('role_id', '=', 2)->lists('id')->toArray();
        $shipments = Shipment::whereIn('user_id', $users);

        return Datatables::of($shipments)
            ->editColumn('id', function ($shipment) {
                return '<a href="' . url('admin/shipments/' . $shipment->id) . '">' . $shipment->id . '</a>';
            })
            ->addColumn('member_id', function ($shipment) {
                return $shipment->user->id;
            })
            ->addColumn('member_name', function ($shipment) {
                return $shipment->user->firstname . ' ' . $shipment->user->lastname;
            })
            ->addColumn('shipment_invoice', function ($shipment) {
                return '<a href="' . url($shipment->uploaded_file) . '?download=1"><i class="download-ico"></i>Invoice</a>';
            })
            ->editColumn('retailer_id', function ($shipment) {
                return $shipment->retailer->name;
            })
            ->addColumn('total_value', function ($shipment) {
                $total = 0;

                foreach ($shipment->items as $item) {
                    $total += $item->qty * $item->cost;
                }

                $total += $shipment->retailer_shipping_cost;
                $total += $shipment->retailer_tax;

                return '$' . number_format($total, 2, '.', ',');
            })
            ->addColumn('total_duty', function ($shipment) {
                $total = 0;

                foreach ($shipment->items as $item) {
                    $total += ($item->qty * $item->cost) * $item->tax->duty / 100;
                }

                return '$' . number_format($total, 2, '.', ',');
            })
            ->addColumn('total_vat', function ($shipment) {
                $total = 0;

                foreach ($shipment->items as $item) {
                    $total += $item->qty * $item->cost;
                }

                $total += $shipment->retailer_shipping_cost;
                $total += $shipment->retailer_tax;

                $totalVat = $total * getSetting('VAT_TAX') / 100;

                return '$' . number_format($totalVat, 2, '.', ',');
            })
            ->editColumn('pickup_date', function ($shipment) {
                if ($shipment->pickup_date) {
                    return Carbon::parse($shipment->pickup_date)->diffForHumans();
                }

                return '-';
            })
            ->editColumn('collected_date', function ($shipment) {
                if ($shipment->collected_date)
                    return Carbon::parse($shipment->collected_date)->format('d-M-Y');

                return '-';
            })
            ->editColumn('status', function ($shipment) {
                return '<div class="btn btn-' . $shipment->status . '">' .
                $this->shipmentStatusMap[$shipment->status] .
                '</div>';
            })->editColumn('_status', function ($shipment) {
                return $shipment->status;
            })
            ->make(true);
    }

    /**
     * Populate Invoices admin frontend table via AJAX
     * @return mixed
     */
    public function getInvoices()
    {
        $users = User::where('role_id', '=', 2)->lists('id')->toArray();
        $invoices = Invoice::whereIn('user_id', $users);

        return Datatables::of($invoices)
            ->editColumn('id', function ($invoice) {
                return '<a href="' . url('admin/invoices/' . $invoice->id) . '">' . $invoice->id . '</a>';
            })
            ->addColumn('member_id', function ($invoice) {
                return $invoice->user->id;
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
                return '$' . number_format($invoice->total, 2);
            })->addColumn('store_code', function ($invoice) {
                return isset($invoice->store_payment->code) ? $invoice->store_payment->code : '-';
            })
            ->editColumn('status', function ($invoice) {
                if ($invoice->status == 'paid') {
                    return '<div class="invoice-stat-col" style="color:#c12036;">' .
                    '<i class="check-icon" aria-hidden="true"></i>' .
                    '<span>Paid</span>' .
                    '</div>';
                } else if ($invoice->status == 'pending') {
                    return '<div class="invoice-stat-col" style="color:#d98800;">' .
                    '<i class="fa fa-clock-o" aria-hidden="true"></i>' .
                    '<span>Pending approval</span>' .
                    '</div>';
                } else if ($invoice->status == 'draft') {
                    return '<div class="invoice-stat-col" style="color:#0081d9;">' .
                    '<i class="fa fa-clipboard" aria-hidden="true"></i>' .
                    '<span>Draft</span>' .
                    '</div>';
                }

                return '<div class="invoice-stat-col">' .
                '<i class="x-icon" aria-hidden="true"></i>' .
                '<span>Unpaid</span>' .
                '</div>';
            })
            ->addColumn('action', function ($invoice) {
                if ($invoice->status == 'draft')
                    return '<a class="btn btn-primary" href="' .
                    url('admin/invoices/' . $invoice->id . '/send-invoice') .
                    '">Send Invoice</a>';

                if ($invoice->status == 'pending') {
                    $btns = '<a class="btn btn-outline" href="' .
                        url('admin/invoices/' . $invoice->id . '/mark-as-payed') .
                        '">Mark as paid</a>';
                    return $btns;
                }


                return '';
            })
            ->make(true);
    }


    /**
     * Populate Fees admin frontend table via AJAX
     * @return mixed
     */
    public function getFees()
    {
        $fees = Fee::where('archived', '=', 0);
        return Datatables::of($fees)
            ->editColumn('name', function ($fee) {
                return '<a href="' . url('admin/products/' . $fee->id . '/edit') . '">' . $fee->name . '</a>';
            })
            ->editColumn('cost', function ($fee) {
                return "$" . number_format($fee->cost, 2);
            })
            ->make(true);
    }

    /**
     * Populate Coupons admin frontend table via AJAX
     * @return mixed
     */
    public function getCoupons()
    {
        $coupons = Coupon::where('archived', '=', 0);
        return Datatables::of($coupons)
            ->editColumn('code', function ($coupon) {
                return '<a href="' . url('admin/coupons/' . $coupon->id . '/edit') . '">' . $coupon->code . '</a>';
            })
            ->editColumn('value', function ($coupon) {
                return $coupon->type == 'percentage' ? $coupon->value . '%' : '$' . $coupon->value;
            })
            ->make(true);
    }

    /**
     * Populate Retailers admin frontend table via AJAX
     * @return mixed
     */
    public function getRetailers()
    {
        $admins = User::where('role_id', '=', 1)->lists('id');
        $retailers = Retailer::where('status', '<>', 'affiliate')->whereIn('user_id', $admins);

        return Datatables::of($retailers)
            ->editColumn('name', function ($retailer) {
                return '<a href="' . url('admin/senders/' . $retailer->id . '/edit') . '">' . $retailer->name . '</a>';
            })
            ->editColumn('member', function ($retailer) {
                return $retailer->user->firstname . ' ' . $retailer->user->lastname;
            })
            ->editColumn('date', function ($retailer) {
                return Carbon::parse($retailer->created_at)->format('d F Y');
            })
            ->editColumn('archived', function ($retailer) {
                return $retailer->archived == 1 ? '<span class="txt-archived">Archived</span>' : '<span style="color: green;">Active</span>';
            })
            ->editColumn('website', function ($retailer) {
                return $retailer->website ? $retailer->website : '-';
            })
            ->make(true);
    }

    /**
     * Populate Members Senders admin frontend table via AJAX
     * @return mixed
     */
    public function getMemberSenders()
    {
        $users = User::where('role_id', '=', 2)->lists('id');
        $retailers = Retailer::where('status', '<>', 'affiliate')->whereIn('user_id', $users);

        return Datatables::of($retailers)
            ->editColumn('name', function ($retailer) {
                return '<a href="' . url('admin/senders/' . $retailer->id . '/edit') . '">' . $retailer->name . '</a>';
            })
            ->editColumn('member', function ($retailer) {
                return $retailer->user->firstname . ' ' . $retailer->user->lastname;
            })
            ->editColumn('date', function ($retailer) {
                return Carbon::parse($retailer->created_at)->format('d F Y');
            })
            ->editColumn('archived', function ($retailer) {
                return $retailer->archived == 1 ? '<span class="txt-archived">Archived</span>' : '<span style="color: green;">Active</span>';
            })
            ->editColumn('website', function ($retailer) {
                return $retailer->website ? $retailer->website : '-';
            })
            ->make(true);
    }


    /**
     * Populate Classification admin frontend table via AJAX
     * @return mixed
     */
    public function getClassifications()
    {
        $taxes = Tax::where('archived', '=', 0);

        return Datatables::of($taxes)
            ->editColumn('id', function ($tax) {
                return '<a href="' . url('admin/classification/' . $tax->id . '/edit') . '">' . $tax->id . '</a>';
            })
            ->editColumn('duty', function ($tax) {
                return number_format($tax->duty, 2) . '%';
            })
            ->editColumn('enabled', function ($tax) {
                return $tax->enabled ? '<span style="color: green;">Enabled</span>' : '<span class="txt-archived">Disabled</span>';
            })
            ->make(true);
    }

    /**
     * Populate Team admin frontend table via AJAX
     * @return mixed
     */
    public function getTeam()
    {
        $admins = User::whereHas('role', function($query) {
            $query->where('name', '=', 'Sub Admin');
        });

        return Datatables::of($admins)
            ->editColumn('id', function($admin) {
                return '<a href="' . url('admin/team/' . $admin->id . '/edit') . '">' . $admin->id . '</a>';
            })
            ->addColumn('status', function($admin) {
                return $admin->archived ? '<span style="color: red;">Inactive</span>' : '<span style="color: green;">Active</span>';
            })
            ->addColumn('action', function($admin) {
                return $admin->archived ? '<a href="' . url('admin/team/' . $admin->id . '/activate') . '"><i class="fa fa-check" aria-hidden="true" style="color: green;"></i></a>' :
                    '<a href="' . url('admin/team/' . $admin->id . '/deactivate') . '"><i class="fa fa-times" aria-hidden="true" style="color: red;"></i></a>';
            })
            ->make(true);
    }
}
