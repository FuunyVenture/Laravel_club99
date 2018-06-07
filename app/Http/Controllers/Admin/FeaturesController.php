<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\FeatureRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Log;
use Mockery\CountValidator\Exception;

class FeaturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the features.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.features.index');
    }

    /**
     * Show the form for creating a new feature.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.features.create_edit');
    }

    /**
     * Store a newly created feature in storage.
     *
     *  * Request must contain:
     *  * name - name of feature
     *  * shipment_quantity - quantity of a shipment (only if feature is a shipment feature)
     *
     * @param FeatureRequest $request
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect back with success message 'New Feature Added Successfully'
     *
     * On Error: redirect back with error message 'Something went wrong!'
     */
    public function store(FeatureRequest $request)
    {

        try {

            $feature = new Feature();

            $feature->name = $request->input('name');

            if($request->has('shipment_quantity')) {
                $feature->type = "shipment";
                $feature->qty = $request->input('shipment_quantity');
            }

            $feature->save();

        } catch (Exception $e) {
            return redirect()->back()->withErrors('error', 'Something went wrong!');
        }

        return redirect('admin/features')->with('success', 'New Feature Added Successfully');
    }

    /**
     * Display the specified feature.
     *
     * @param Feature $feature
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Feature $feature)
    {
        return $feature;
    }

    /**
     * Show the form for editing the specified feature.
     *
     * @param Feature $feature
     * @return mixed
     */
    public function edit(Feature $feature)
    {
        return view('admin.features.create_edit')->with(compact('feature'));
    }

    /**
     * Update the specified feature in storage.
     *
     *  * Request must contain:
     *  * name - name of feature
     *  * shipment_quantity - quantity of a shipment (only if feature is a shipment feature)
     *
     * @param FeatureRequest $request
     * @param Feature $feature
     * @return mixed
     *
     * On Success: redirect back with success message 'Feature updated Successfully'
     *
     * On Error: redirect back with error message 'Something went wrong!'
     */
    public function update(FeatureRequest $request, Feature $feature)
    {
        Log::info($request->all());
        try {

            $feature->name = $request->input('name');

            if($request->has('shipment_quantity')) {
                $feature->type = "shipment";
                $feature->qty = $request->input('shipment_quantity');
            }

            $feature->save();

        } catch (Exception $e) {
            return redirect()->back()->withErrors('error', 'Something went wrong!');
        }

        return redirect('admin/features')->with('success', 'Feature updated Successfully');
    }

    /**
     * Remove the specified feature from storage.
     *
     * @param Request $request
     * @param Feature $feature
     * @return string
     *
     * On Success: return success message 'Feature has been deleted successfully'
     *
     * On Error: return error message 'You can\'t proceed in delete operation'
     *
     */
    public function destroy(Request $request, Feature $feature)
    {
        if ($request->ajax()) {
            $feature->delete();
            Session::put('featureDeleteMessage', 'Feature has been deleted successfully');
            return response()->json(['success' => 'Feature has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }
}
