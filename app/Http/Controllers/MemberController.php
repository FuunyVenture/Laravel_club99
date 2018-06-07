<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\Request;
use App\Package;
use App\Feature;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Log;

class MemberController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        /*if(!\Auth::guest())
        {
            if (\Auth::user()->package_id != getSetting('DEFAULT_PACKAGE_ID') && \Auth::user()->package_id != 0 && !\Auth::user()->subscribed('MEMBERSHIP')) {
                Session::put('warning', 'Your Subscription not valid!');
            }else
            {
                Session::forget('warning');
            }
        }*/
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->role->name == 'Admin' || \Auth::user()->role->name == 'Sub Admin') {
            return redirect('admin/dashboard');
        }

        $packages = Package::where('status', '=', 1)->get()->sortBy('cost');

        $features = Feature::where('status', '=', 1)->get();

        if (isset(\Auth::user()->subscription) &&
            (!Carbon::today()->lt(Carbon::parse(\Auth::user()->subscription->ends_at)))
        ) {
            return view('member.subscription')->with(compact('packages', 'features'))
                ->withErrors(['error' => 'Your subscription has expired']);
        }
        return view('member.subscription')->with(compact('packages', 'features'));
    }

    public function pricing()
    {
        $packages = Package::active()->get();

        $features = Feature::active()->get();

        return view('member.pricing')->with(compact('packages', 'features'));
    }

    public function help()
    {
        return view('member.help');
    }

    public function pendingSubscription()
    {
        return view('member.pending_subscription');
    }
}
