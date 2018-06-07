<?php

namespace App\Http\Controllers\Admin;

use App\Fee;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Log;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created fee in storage.
     *
     *  * Request must contain:
     *  * name - name o fee
     *  * cost - cost of fee
     *  * taxable - is taxable or not
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect 'admin/products' with success message 'Fee [fee name] [fee cost] was successfully added'
     *
     * On Error: redirect 'admin/products' with error message 'Something went wrong! Please try again later.'
     */
    public function store(Request $request)
    {
        Log::info($request->all());

        try {
            DB::transaction(function () use ($request) {
                $fee = new Fee();
                $fee->name = $request->input('name');
                $fee->cost = $request->input('cost');
                $fee->taxable = $request->input('taxable');
                $fee->save();

                $product = new Product();
                $product->fee()->associate($fee);
                $product->type = 'fee';
                $product->taxable = 'none';
                $product->save();

            });

            $message = 'Fee ' . $request->input('name') . ' ($' . $request->input('cost') . ') was successfully added';

            return redirect('admin/products')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/products')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
