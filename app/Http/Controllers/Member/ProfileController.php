<?php

/**
 * This file is used for managing a user's profile.
 * */

namespace App\Http\Controllers\Member;

use App\Address;
use App\Http\Requests\ProfileRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Log;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Return the profile view. */
    public function profile()
    {
        $user = \Auth::user();
        return view('member.profile.profile')->with(compact('user'));
    }

    /** Return the view for editing the profile. */
    public function editProfile()
    {
        $user = \Auth::user();

        $job_titles = getSetting('JOB_TITLES');

        return view('member.profile.edit_profile')->with(compact('user', 'job_titles'));
    }

    /**
     * Update the profile in storage.
     * * Request must contains:
     * * firstname - user's firstname (required, max. 255 characters)
     * * lastname - user's lastname (required, max. 255 characters)
     * * email - user's email address (required, e-mail format, max. 255 characters)
     * * birthday_birthDay - user's birthday
     * * home_number - user's home number (max. 255 characters)
     * * mobile_number - user's mobile number (max. 255 characters)
     * * address_line1 - user's address (required, max. 255 characters)
     * * city - user's address city (required, max. 255 characters)
     * * country - user's address country (required, max. 255 characters)
     * * zipcode - user's address zip code (max. 255 characters)
     *
     * On Success: return message 'Your Profile Updated Successfully'
     */
    public function updateProfile(Request $request)
    {
        $user = \Auth::user();

        Log::info($request->all());
        /*$user->name = $request->input('name');
        $user->mobile = $request->input('mobile');
        $user->address = $request->input('address');
        $user->job_title = $request->input('job_title');

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('avatar')) {

            $destinationPath = public_path() . '/uploads/avatars';

            if ($user->avatar != "uploads/avatars/avatar.png") {
                @unlink($user->avatar);
            }

            $avatar = hash('sha256', mt_rand()) . '.' . $request->file('avatar')->getClientOriginalExtension();

            $request->file('avatar')->move($destinationPath, $avatar);

            \Image::make(asset('uploads/avatars/' . $avatar))->fit(300, null, null, 'top-left')->save('uploads/avatars/' . $avatar);

            $user->avatar = $avatar;
        }*/

        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'home_number' => 'required|numeric',
            'mobile_number' => 'required|numeric',
            'address_line1' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
            'zipcode' => 'max:255',
        ]);

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');

        if ($request->input('birthday_birthDay') != 'NaN-NaN-NaN') {
            $user->birthday = Carbon::parse($request->input('birthday_birthDay'));
        }

        $user->save();

        if ($user->home_address) {
            $homeAddress = $user->home_address;
        } else {
            $homeAddress = new Address();
            $homeAddress->type = 'home';
        }

        $homeAddress->home_number = $request->input('home_number');
        $homeAddress->mobile_number = $request->input('mobile_number');
        $homeAddress->address1 = $request->input('address_line1');
        $homeAddress->address2 = $request->input('address_line2');
        $homeAddress->city = $request->input('city');
        $homeAddress->state = $request->input('state');
        $homeAddress->country = $request->input('country');
        $homeAddress->zip_code = $request->input('zipcode');

        $homeAddress->save();

        Session::forget('profile_completed');

        return redirect('member/profile')->with('success', 'Your Profile Updated Successfully');
    }

    /**
     * Update user's avatar.
     * Request must contains:
     * * avatar - user's avatar
     * */
    public function updateAvatar(Request $request)
    {

        $this->validate($request, [
            'avatar' => 'mimes:jpeg,bmp,png|max:2048'
        ]);

        $user = Auth::user();

        $destinationPath = public_path() . '/uploads/avatars';

        if ($user->avatar != "uploads/avatars/profile.svg") {
            @unlink($user->avatar);
        }

        $avatar = hash('sha256', mt_rand()) . '.' . $request->file('avatar')->getClientOriginalExtension();

        $request->file('avatar')->move($destinationPath, $avatar);

        \Image::make(asset('uploads/avatars/' . $avatar))->fit(300, null, null, 'top-left')->save('uploads/avatars/' . $avatar);

        $user->avatar = $avatar;

        $user->save();

        return redirect('member/profile')->with('success', 'Your Avatar Updated Successfully');
    }

}
