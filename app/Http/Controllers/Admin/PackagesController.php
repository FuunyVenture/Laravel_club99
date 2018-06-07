<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\Package;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PackageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Log;

class PackagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the packages.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.packages.index');
    }

    /**
     * Show the form for creating a new package.
     *
     * @return View
     */
    public function create()
    {
        $features = Feature::all();

        return view('admin.packages.create_edit')->with(compact('features'));
    }

    /**
     * Store a newly created package in storage.
     *
     *  * Request must contain:
     *  * name - name of package (required|max:60|unique:packages,name)
     *  * cost - cost of package (required)
     *  * cost_per - per year, month, etc. (required)
     *  * features - associated features for this package (optional)
     *
     * @param PackageRequest $request
     * @return mixed
     *
     * On Success: redirect to 'admin/packages' with success message '[Package name] Package Added Successfully'
     */
    public function store(PackageRequest $request)
    {

        $package = new Package();

        $package->name = $request->input('name');

        $package->cost = $request->input('cost');

        $package->cost_per = $request->input('cost_per');

        $package->status = 1;

        $package->featured = 1;

        $features = $request->input('features');

        if (!$features) {
            $features = [];
        }

        $package->save();

        foreach ($features as $feature) {
            $package->features()->attach($feature, ['spec' => '']);
        }
        //$package->features()->sync($features);

        $package->save();

        $product = new Product();
        $product->package()->associate($package);
        $product->type = 'package';
        $product->save();

        return redirect('admin/packages')->with('success', $package->name . ' Package Added Successfully');
    }

    /**
     * Display the specified package.
     *
     * @param Package $package
     * @return View
     * @internal param int $id
     */
    public function show(Package $package)
    {
        return view('admin.packages.show')->with(compact('package'));
    }

    /**
     * Show the form for editing the specified package.
     *
     * @param Package $package
     * @return View
     */
    public function edit(Package $package)
    {
        $features = Feature::all();

        return view('admin.packages.create_edit')->with(compact('package', 'features'));
    }

    /**
     * Update the specified package in storage.
     *
     *  * Request must contain:
     *  * name - name of package (required|max:60|unique:packages,name)
     *  * cost - cost of package (required)
     *  * cost_per - per year, month, etc. (required)
     *  * features - associated features for this package (optional)
     *
     * @param PackageRequest $request
     * @param Package $package
     * @return mixed
     *
     * On Success: redirect to admin packages with success message '[Package name] Package updated Successfully'
     */
    public function update(Request $request, Package $package)
    {
        $package->name = $request->input('name');
        $package->cost = $request->input('cost');
        $package->cost_per = $request->input('cost_per');

        $features = $request->input('features');

        if (!$features) {
            $features = [];
        }

        $package->features()->detach();

        foreach ($features as $feature) {
            $package->features()->attach($feature, ['spec' => '']);
        }


        $package->save();

        return redirect('admin/packages')->with('success', $package->name . ' Package updated Successfully');
    }

    /**
     * Remove the specified package from storage.
     *
     * @param Request $request
     * @param Package $package
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     *
     * On Success: return success message 'Package has been deleted successfully'
     *
     * On Error: return error message 'You can\'t proceed in delete operation'
     */
    public function destroy(Request $request, Package $package)
    {
        if ($request->ajax()) {

            $package->features()->detach();

            $package->delete();

            Session::put('packageDeleteMessage', 'Package has been deleted successfully');
            return response()->json(['success' => 'Package has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }
}
