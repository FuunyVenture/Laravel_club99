<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RolesRequest;
use App\Http\Controllers\Controller;
use Redirect;
use Carbon;
use Route;
use App\Role;

class RolesController extends Controller {

    /**
     * RolesController constructor.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $routes = getNamedRoutes();

        return view('admin.roles.create_edit')->with(compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request) {
        $name = $request->input('name');
        $routes = $request->input('routes');

        $role = new Role();

        $role->name = $name;
        $role->routes = json_encode($routes);

        $role->save();

        return Redirect::route('admin.roles.index')->with('success', $role->name . ' has been added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role) {
        $routes = getNamedRoutes();

        return view('admin.roles.create_edit')->with(compact('routes', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, Role $role) {
        $name = $request->input('name');
        $routes = $request->input('routes');

        $role->name = $name;
        $role->routes = json_encode($routes);

        $role->save();

        return Redirect::route('admin.roles.index')->with('success', $role->name . ' has been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role) {
        if ($request->ajax()) {
            $role->delete();

            return response()->json(['success' => 'Role has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }

}
