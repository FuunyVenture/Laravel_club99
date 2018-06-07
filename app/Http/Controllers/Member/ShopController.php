<?php

/**
 * This file is used for display the shop view.
 */

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Retailer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function shop() {
       $retailers = Retailer::where('status', '=', 'affiliate')
            ->where('archived', '=', 0)
            ->get();
        return view('member.shop.shop')->with(compact('retailers'));
    }
}
