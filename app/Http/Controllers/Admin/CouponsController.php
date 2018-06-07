<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Product;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Log;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CouponsController extends Controller
{
    /**
     * Display a listing of the coupons.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.coupons.coupons');
    }

    /**
     * Show the form for creating a new coupon.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.coupons.create_coupons');
    }

    /**
     * Store a newly created coupon in storage.
     *
     *  * Request must contain:
     *  * coupon_code - code of the coupon (required)
     *  * amount - value of coupon (required, numeric value between 0 and 100)
     *  * start_date - start date of coupon (required)
     *  * end_date - end date of coupon (required)
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect to 'admin/coupons' with success message 'Coupon added successfully'
     */
    public function store(Request $request)
    {
        Log::info($request);

        $this->validate($request, [
            'coupon_code' => 'required',
            'amount' => 'required|numeric|between:0,100',
            'start_date' => 'required|date_format:d/m/Y|before:end_date',
            'end_date' => 'required|date_format:d/m/Y|after:start_date'
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->input('coupon_code');
        $coupon->value = $request->input('amount');
        $coupon->type = $request->input('type');
        $coupon->status = 'available';
        $coupon->start_date = Carbon::parse(Carbon::createFromFormat('d/m/Y', $request->input('start_date')));
        $coupon->end_date = Carbon::parse(Carbon::createFromFormat('d/m/Y', $request->input('end_date')));
        $coupon->save();

        $product = new Product();
        $product->coupon()->associate($coupon);
        $product->type = 'coupon';
        $product->save();

        return redirect('admin/coupons')->with('success', 'Coupon added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified coupon.
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin/coupons/edit_coupons')->with(compact('coupon'));
    }

    /**
     * Update the specified coupon in storage.
     *
     *  * Request must contain:
     *  * coupon_code - code of the coupon (required)
     *  * amount - value of coupon (required, numeric value between 0 and 100)
     *  * start_date - start date of coupon (required)
     *  * end_date - end date of coupon (required)
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect 'admin/coupons' with success message 'Coupon [coupon code] has successfully updated'
     *
     * On Error: redirect to 'admin/coupons' with error message 'Something went wrong! Please try again later.'
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'coupon_code' => 'required',
            'amount' => 'required|numeric|between:0,100',
            'start_date' => 'required|date_format:d/m/Y|before:end_date',
            'end_date' => 'required|date_format:d/m/Y|after:start_date'
        ]);

        $coupon = Coupon::findOrFail($id);

        try {
            DB::transaction(function() use($coupon, $request) {
                $coupon->code = $request->input('coupon_code');
                $coupon->value = $request->input('amount');
                $coupon->type = $request->input('type');
                $coupon->start_date = Carbon::parse(Carbon::createFromFormat('d/m/Y', $request->input('start_date')));
                $coupon->end_date = Carbon::parse(Carbon::createFromFormat('d/m/Y', $request->input('end_date')));
                $coupon->save();
            });

            return redirect('admin/coupons')->with('success', 'Coupon ' . $coupon->code . ' has successfully updated.');
        } catch (\Exception $e) {
            //log the error
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/coupons')->with(compact('shipment'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    /**
     * Remove the specified coupon from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect 'admin/coupons' with success message 'Coupon [coupon code] has successfully deleted'
     *
     * On Error: redirect to 'admin/coupons' with error message 'Something went wrong! Please try again later.'
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        //coupon is marked as archived
        try {
            DB::transaction(function() use($coupon) {
                $coupon->archived = 1;
                $coupon->save();
            });

            $message = 'Coupon ' . $coupon->code . ' was successfully deleted.';
            return redirect('admin/coupons')->with('success', $message);
        } catch(\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/coupons')->with(compact('shipment'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }
}
