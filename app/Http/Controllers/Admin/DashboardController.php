<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Invoice;
use App\Package;
use App\Page;
use App\Shipment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;

class DashboardController extends Controller
{

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index()
    {
        $weekStartsOn = Carbon::now()->subDays(Carbon::now()->dayOfWeek);
        $weekEndsOn = Carbon::now()->addDays(6 - Carbon::now()->dayOfWeek);

        $newMembers = User::where('role_id', '=', 2)
            ->whereBetween('created_at', array($weekStartsOn, $weekEndsOn))
            ->count();
        $approvedShipments = Shipment::where('status', '<>', 'pending_approval')->count();
        $pendingShipments = Shipment::whereStatus('pending_approval')->count();
        $pickupReadyShipments = Shipment::whereStatus('ready_for_pickup')->count();
        $unpaidInvoices = Invoice::whereStatus('unpaid')->count();
        $paidInvoices = Invoice::whereStatus('paid')->whereBetween('updated_at', array($weekStartsOn, $weekEndsOn))->count();

        $packages = Package::all()->count();
        $features = Feature::all()->count();
        $pages = Page::page()->count();
        $posts = Page::post()->count();
        $subscriptions = \DB::table('subscriptions')->count();

        return view('admin.dashboard')->with(compact(
            'newMembers',
            'approvedShipments',
            'pendingShipments',
            'pickupReadyShipments',
            'unpaidInvoices',
            'paidInvoices',
            'packages',
            'features',
            'subscriptions',
            'pages',
            'posts'
        ));
    }

}
