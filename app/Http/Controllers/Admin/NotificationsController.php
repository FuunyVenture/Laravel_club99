<?php

namespace App\Http\Controllers\Admin;

use Fenos\Notifynder\Models\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the notifications.
     *
     * @return View
     */
    public function index()
    {
        $notifications = \Auth::user()->getNotifications();
        return view('admin.notifications.notifications')->with(compact('notifications'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified notification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * Redirect to notified resource
     */
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->read = 1;
        $notification->save();

        return redirect($notification->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
