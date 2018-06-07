<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\MenuRequest;
use App\Http\Controllers\Controller;
use App\Menu;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menus.create_edit');
    }

    /**
     * @param MenuRequest $request
     * @return mixed
     */
    public function store(MenuRequest $request)
    {
        $menu = Menu::create($request->except('_token'));

        $menu->save();

        return redirect('admin/menus')->with('success', 'New Menu Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->index();
    }

    /**
     * @param Menu $menu
     * @return mixed
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.create_edit')->with(compact('menu'));
    }

    /**
     * @param MenuRequest $request
     * @param Menu $menu
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->title = $request->input('title');
        $menu->location = $request->input('location');
        $menu->url = $request->input('url');
        $menu->item_order = $request->input('item_order');
        $menu->status = $request->input('status');

        $menu->save();

        return redirect('admin/menus')->with('success', $menu->title . ' Menu Updated Successfully');
    }

    /**
     * @param Menu $menu
     */
    public function destroy(Request $request, Menu $menu)
    {
        if ($request->ajax()) {
            $menu->delete();
            return response()->json(['success' => 'Menu has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }
}
