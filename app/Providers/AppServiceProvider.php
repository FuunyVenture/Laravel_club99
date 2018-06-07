<?php

namespace App\Providers;

use App\Page;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $shipmentStatusMap = [
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

        view()->composer('layouts.frontend.includes.header', function ($view) {
            $view->with('pages', Page::published()->page()->get());
        });
        view()->composer('layouts.member.includes.header', function ($view) {
            $view->with('headerNotifications', \Auth::user()->getNotifications(3));
            $view->with('unreadNotificationsCount', \Auth::user()->countNotificationsNotRead());
        });
        view()->composer('layouts.admin.includes.header', function ($view) {
            $view->with('headerNotifications', \Auth::user()->getNotifications(3));
            $view->with('unreadNotificationsCount', \Auth::user()->countNotificationsNotRead());
        });

        view()->composer('member.shipments.*', function ($view) use($shipmentStatusMap) {
            $view->with('shipmentStatusMap',$shipmentStatusMap);
        });

        view()->composer('admin.shipments.*', function ($view) use ($shipmentStatusMap){
            $view->with('shipmentStatusMap',$shipmentStatusMap);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
