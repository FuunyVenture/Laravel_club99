<?php

namespace App\Http\Controllers\Admin;

use App\Fee;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class ProductsController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.products.products');
    }

    /**
     * Show the form for creating a new product.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.products.create_product');
    }

    /**
     * Store a newly created product in storage.
     *
     *  * Request must contain:
     *  * name - name of product (required|min:3)
     *  * cost - price of product (required|regex:/^\d+(?:\.\d{1,2})?$/)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect 'admin/products' with success message 'Fee [product name] [product cost] was successfully added'
     *
     * On Error: if product already exists redirect to 'admin/classification'  with error message 'Product [product name] already exists!'
     * else redirect 'admin/products' with error message 'Something went wrong! Please try again later.'
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'cost' => 'required|regex:/^\d+(?:\.\d{1,2})?$/'
        ]);

        $fee = null;
        $archived = 0;

        $fees = Fee::where('name', '=', $request->input('name'))->get();
        if (!$fees->isEmpty()) {
            $fee = $fees->first();

            if ($fee->archived == 0) {
                $bag = new MessageBag();
                $bag->add('duplicate', 'Product ' . $request->input('name') . ' already exists!');
                return redirect('admin/products')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
            } else
                $archived = 1;
        }

        try {
            DB::transaction(function () use ($request, $fee, $archived) {
                if(!$archived) $fee = new Fee();

                $fee->name = $request->input('name');
                $fee->cost = $request->input('cost');
                $fee->taxable = $request->input('taxable');
                if($archived) $fee->archived = 0;
                $fee->save();

                if(!$archived) {
                    $product = new Product();
                    $product->fee()->associate($fee);
                    $product->type = 'fee';
                    $product->taxable = $request->input('taxable');
                    $product->save();
                }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified fee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        return view('admin.products.edit_product')->with(compact('fee'));
    }

    /**
     * Update the specified fee in storage.
     *
     *  * Request must contain:
     *  * name - name of product (required|min:3)
     *  * cost - price of product (required|regex:/^\d+(?:\.\d{1,2})?$/)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect 'admin/products' with success message 'Fee [product name] [product cost] was successfully updated'
     *
     * On Error: if product already exists redirect to 'admin/classification'  with error message 'Fee [product name] already exists!'
     * else redirect 'admin/products' with error message 'Something went wrong! Please try again later.'
     *
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'cost' => 'required|regex:/^\d+(?:\.\d{1,2})?$/'
        ]);

        $fee = Fee::findOrFail($id);

        if($fee->name != $request->input('name')) {
            $fees = Fee::where('name', '=', $request->input('name'))->get();
            if(! $fees->isEmpty()) {
                if($fee->id != $fees->first()->id) {
                    $bag = new MessageBag();
                    $bag->add('duplicate', 'Fee ' . $request->input('name') . ' already exists!');
                    return redirect('admin/products')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
                }
            }
        }

        try {
            DB::transaction(function() use($fee, $request) {
                $fee->name = $request->input('name');
                $fee->cost = $request->input('cost');
                $fee->taxable = $request->input('taxable');
                $fee->save();

                $fee->product->taxable = $request->input('taxable');
                $fee->product->save();
            });

            $message = 'Product ' . $request->input('name') . ' was successfully updated.';
            return redirect('admin/products')->with('success', $message);
        } catch(\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/products')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    /**
     * Remove the specified fee from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect to 'admin/products' with success message 'Product [fee name] was successfully deleted'
     *
     * On Error: redirect to 'admin/products' with error message 'Something went wrong! Please try again later.'
     */
    public function destroy($id)
    {
        $fee = Fee::findOrFail($id);

        try {
            DB::transaction(function() use($fee) {
                $fee->archived = 1;
                $fee->save();
            });

            $message = 'Product ' . $fee->description . ' was successfully delete.';
            return redirect('admin/products')->with('success', $message);
        } catch(\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/products')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }

        $message = 'Product ' . $fee->name . ' was successfully deleted';
        return redirect('admin/products')->with('success', $message);
    }
}
