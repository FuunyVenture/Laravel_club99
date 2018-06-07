<?php

/**
 * This file is used to display a member's dashboard page.
 * */

namespace App\Http\Controllers\Member;

use App\Invoice;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $invoices = Invoice::whereHas('user', function($query) {
            $query->where('id', '=', Auth::user()->id);
        })->where('status', '=', 'unpaid');

        return view('member.dashboard')->with(compact('invoices'));
    }
}
