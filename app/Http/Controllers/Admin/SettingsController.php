<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SettingsRequest;
use App\Http\Controllers\Controller;
use App\Setting;
use Redirect;
use Carbon;

class SettingsController extends Controller {

    /**
     * SettingsController constructor.
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
        return view('admin.settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.settings.select_type');
    }

    public function createForm($type) {
        return view('admin.settings.create_edit')->with(compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingsRequest $request) {
	
        $setting = new Setting($request->except('_token', 'setting_id', 'value'));

        if ($request->hasFile('value')) {
			
			$validator = \Validator::make($request->all(), [
				'value' => 'mimes:jpg,jpeg,png,txt,csv,zip,pdf',
			]);
			
			if ($validator->fails()) {
				return back()->withErrors($validator)
							->withInput();
			}
			
            $destinationPath = public_path() . '/uploads/settings';

            $value = $setting->key_cd . '.' . $request->file('value')->getClientOriginalExtension();

            $request->file('value')->move($destinationPath, $value);

            $setting->value = $value;
        } elseif ($setting->type == 'SELECT') {
            $setting->value = json_encode($request->value);
        } else {
            $setting->value = $request->value;
        }

        $setting->save();

        return Redirect::route('admin.settings.index')->with('success', $setting->display_value . ' has been added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting) {
        $type = null;
        return view('admin.settings.create_edit')->with(compact('setting', 'type'));
    }

//edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsRequest $request, Setting $setting) {
        $setting->key_cd = $request->key_cd;

        $setting->type = $request->type;

        $setting->display_value = $request->display_value;

        if ($request->hasFile('value')) {
			
			$validator = \Validator::make($request->all(), [
				'value' => 'mimes:jpg,jpeg,png,txt,csv,zip,pdf',
			]);
			
			if ($validator->fails()) {
				return back()->withErrors($validator)
							->withInput();
			}
            @unlink($setting->value);

            $destinationPath = public_path() . '/uploads/settings';

            $value = $setting->key_cd . '.' . $request->file('value')->getClientOriginalExtension();

            $request->file('value')->move($destinationPath, $value);

            $setting->value = $value;
        } elseif ($setting->type == 'SELECT') {
            $setting->value = json_encode($request->value);
        } else {
            $setting->value = $request->value;
        }

        $setting->updated_at = Carbon::now();

        $setting->save();

        return Redirect::route('admin.settings.index')->with('success', $setting->display_value . ' has been Updated Successfully');
    }

//update

    /**
     * Remove the specified resource from storage.
     *
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Setting $setting) {
        return '';
    }

    public function fileDownload(Setting $setting) {
        return response()->download($setting->value);
    }

}
