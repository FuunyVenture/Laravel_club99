<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class AdminsController extends Controller
{
    /**
     * AdminsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.team.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create_edit');
    }

    /**
     * Store a newly created user in storage.
     *
     *  * Request must contain:
     *  * firstname - firstname of user (required|max:255)
     *  * lastname - lastname of user (required|max:255)
     *  * email - email of user (required|email|max:255|unique:users)
     *  * account_password - password of user (required|confirmed)
     *  * account_password_confirmation - password confirmation
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * On Success: redirect to 'admin/team' with success message 'Admin [admin_firstname] [admin_lastname] has been added Successfully.'
     * User will be notified via email about new account
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'account_password' => 'required|confirmed'
        ]);

        $user = DB::transaction(function () use ($request) {
            $user = new User();
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('account_password'));
            $user->avatar = 'profile.svg';
            $user->role()->associate(Role::where('name', '=', 'Sub Admin')->first());
            $user->save();

            return $user;
        });

        $password = $request->input('account_password');

        Mail::send('emails.new_member', ['user' => $user, 'password' => $password], function ($m) use ($user) {
            $m->to($user->email, $user->firstname . ' ' . $user->lastname)
                ->subject('Your New Admin Account');
        });

        $status_message = 'Admin ' . $user->firstname . ' ' . $user->lastname . ' has been added Successfully.';

        return redirect('admin/team')->with('success', $status_message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.team.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.team.create_edit')->with(compact('user'));
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = DB::transaction(function () use ($request, $user) {
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->save();

            return $user;

        });

        $status_message = 'Admin ' . $user->firstname . ' ' . $user->lastname . ' has been updated successfully.';

        return redirect('admin/team')->with('success', $status_message);
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

    public function activate(User $user)
    {
        try {
            $user = DB::transaction(function() use($user) {
                $user->archived = 0;
                $user->save();

                return $user;
            });

            $status_message = 'Admin ' . $user->firstname . ' ' . $user->lastname . ' has been activated successfully.';
            return redirect('admin/team')->with('success', $status_message);
        } catch(\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/team')->with(compact('user'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    public function deactivate(User $user)
    {
        try {
            $user = DB::transaction(function() use($user) {
                $user->archived = 1;
                $user->save();

                return $user;
            });

            $status_message = 'Admin ' . $user->firstname . ' ' . $user->lastname . ' has been deactivated successfully.';
            return redirect('admin/team')->with('success', $status_message);
        } catch(\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/team')->with(compact('user'))->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }
}
