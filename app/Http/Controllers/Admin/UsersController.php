<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Invoice;
use App\Package;
use Carbon\Carbon;
use Fenos\Notifynder\Facades\Notifynder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Log;
use Mail;

class UsersController extends Controller
{

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the users.
     *
     * @return View
     */
    public function index()
    {
        $packages = Package::all();
        return view('admin.users.index')->with(compact('packages'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.users.create_edit');
    }

    /**
     * Store a newly created user in storage.
     *
     *  * Request must contain:
     *  * firstname - firstname of user (required|max:255)
     *  * lastname - lastname of user (required|max:255)
     *  * email - email of user (required|email|max:255|unique:users)
     *  * home_number - home phone number (max:255)
     *  * mobile_number - mobile phone number (max:255)
     *  * address_line1 - address (required|max:255)
     *  * city (required|max:255)
     *  * state (required|max:255)
     *  * country (required|max:255)
     *  * zipcode (max:255)
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * On Success: redirect to 'admin/users' with success message 'User [user firstname] [user lastname] has been added Successfully.'
     * User will be notified via email about new account
     */
    public function store(Request $request)
    {
        /*
                $account = [];

                $avatar = 'avatar.png';

                if ($request->hasFile('avatar')) {
                    $destinationPath = public_path() . '/uploads/avatars';

                    $avatar = hash('sha256', mt_rand()) . '.' . $request->file('avatar')->getClientOriginalExtension();

                    $request->file('avatar')->move($destinationPath, $avatar);

                    \Image::make(asset('uploads/avatars/' . $avatar))->fit(300, null, null, 'top-left')->save('uploads/avatars/' . $avatar);
                }

                $account['avatar'] = $avatar;

                $account['name'] = $request->input('name');
                $valid_package = true;
                if ($request->input('package_id')) {
                    if ($request->input('package_id') == getSetting('DEFAULT_PACKAGE_ID')) {
                        $account['package_id'] = getSetting('DEFAULT_PACKAGE_ID');
                    } else {
                        $valid_package = false;
                    }
                }
                $account['email'] = $request->input('email');
                $account['mobile'] = $request->input('mobile');
                $account['job_title'] = $request->input('job_title');
                $account['address'] = $request->input('address');
                $account['role_id'] = $request->input('role');

                $user = new User($account);

                $user->password = bcrypt($request->input('password'));

                $user->save();

                $package_message = $valid_package ? '' : ' Please Note you can\'t add package without Stripe Subscription';*/

        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'home_number' => 'max:255',
            'mobile_number' => 'max:255',
            'address_line1' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
            'zipcode' => 'max:255',
        ]);

        $user = DB::transaction(function () use ($request) {
            $user = new User();

            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role_id = 2;
            $user->avatar = 'profile.svg';
            $user->birthday = Carbon::create(
                $request->input('birthday_birth')['year'],
                $request->input('birthday_birth')['month'],
                $request->input('birthday_birth')['day'],
                0,
                0,
                0,
                'Europe/London'
            );
            $user->save();


            $homeAddress = new Address();
            $homeAddress->type = "home";
            $homeAddress->home_number = $request->input('home_number');
            $homeAddress->mobile_number = $request->input('mobile_number');
            $homeAddress->address1 = $request->input('address_line1');
            $homeAddress->address2 = $request->input('address_line2');
            $homeAddress->city = $request->input('city');
            $homeAddress->state = $request->input('state');
            $homeAddress->country = $request->input('country');
            $homeAddress->zip_code = $request->input('zipcode');

            $homeAddress->user_id = $user->id;

            $homeAddress->save();

            return $user;

        });

        $password = $request->input('password');

        Mail::send('emails.new_member', ['user' => $user, 'password' => $password], function ($m) use ($user) {
            $m->to($user->email, $user->firstname . ' ' . $user->lastname)
                ->subject('Your New Member Account');
        });

        $status_message = 'User ' . $user->firstname . ' ' . $user->lastname . ' has been added Successfully.';

        return redirect('admin/users')->with('success', $status_message);
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user)
    {
        return view('admin.users.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user)
    {
        $packages = Package::all();
        return view('admin.users.create_edit')->with(compact(
            'user',
            'packages'
        ));
    }

    /**
     * Update specified user
     *
     * * Request must contain:
     *  * firstname - firstname of user (required|max:255)
     *  * lastname - lastname of user (required|max:255)
     *  * email - email of user (required|email|max:255|unique:users)
     *  * home_number - home phone number (max:255)
     *  * mobile_number - mobile phone number (max:255)
     *  * address_line1 - address (required|max:255)
     *  * city (required|max:255)
     *  * state (required|max:255)
     *  * country (required|max:255)
     *  * zipcode (max:255)
     *  * birthday_birth - user's birthday
     *  * package_id - user's package
     *  * receipt_code - code from store
     *  *
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     *
     * On Success: redirect to 'admin/users' with success message 'User [user firstname] [user lastname] has been updated successfully.'
     * User will be notified via email about new account
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'home_number' => 'max:255',
            'mobile_number' => 'max:255',
            'address_line1' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
            'zipcode' => 'max:255',
        ]);

        if(isset($user->subscription) && $user->subscription->status == 'pending') {
            $this->validate($request, [
                'receipt_code' => 'required'
            ]);
        }

        Log::info($request->all());

        $user1 = DB::transaction(function () use ($request, $user) {
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->role_id = getSetting('DEFAUTL_USER_ROLE');
            $user->avatar = 'profile.svg';
            $user->birthday = Carbon::create(
                $request->input('birthday_birth')['year'],
                $request->input('birthday_birth')['month'],
                $request->input('birthday_birth')['day'],
                0,
                0,
                0,
                'Europe/London'
            );
            $user->save();

            if(isset($user->subscription) && $user->subscription->status == 'pending') {
                $user->subscription->package()->associate(Package::findOrFail($request->input('package_id')));
                $user->subscription->save();
                $user->subscription->store_payment->code = $request->input('receipt_code');
                $user->subscription->store_payment->save();
            }

            if($user->home_address) {
                $user->home_address->home_number = $request->input('home_number');
                $user->home_address->mobile_number = $request->input('mobile_number');
                $user->home_address->address1 = $request->input('address_line1');
                $user->home_address->address2 = $request->input('address_line2');
                $user->home_address->city = $request->input('city');
                $user->home_address->state = $request->input('state');
                $user->home_address->country = $request->input('country');
                $user->home_address->zip_code = $request->input('zipcode');
                $user->home_address->save();
            } else {
                $homeAddress = new Address();
                $homeAddress->type = "home";
                $homeAddress->home_number = $request->input('home_number');
                $homeAddress->mobile_number = $request->input('mobile_number');
                $homeAddress->address1 = $request->input('address_line1');
                $homeAddress->address2 = $request->input('address_line2');
                $homeAddress->city = $request->input('city');
                $homeAddress->state = $request->input('state');
                $homeAddress->country = $request->input('country');
                $homeAddress->zip_code = $request->input('zipcode');
                $homeAddress->user_id = $user->id;
                $homeAddress->save();
            }

            return $user;

        });

        $status_message = $user->firstname . ' ' . $user->lastname . ' has been updated Successfully.';

        return redirect('admin/users')->with('success', $status_message);
    }

    /**
     * Delete specified user
     *
     * @param Request $request
     * @param User $user
     * @return string
     * @throws \Exception
     *
     * On Success: return success message 'User has been deleted successfully'
     *
     * On Error: return error message 'You can\'t proceed in delete operation'
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->ajax()) {
            $user->delete();
            return response()->json(['success' => 'User has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }

    /**
     * Activate user if payment option was 'Cash In Store'.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * On Success: redirect to 'admin/users' with success message 'User [user firstname] [user lastname] was successfully activated.'
     * User will be notified via notification and via email.
     *
     * On Error: redirect to 'admin/users' with err
     */
    public function activate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        try {
            DB::transaction(function () use ($user) {
                $user->subscription->status = 'active';
                $user->subscription->created_at = Carbon::now();
                $user->subscription->ends_at = Carbon::now()->addYear();
                $user->subscription->save();

                $invoice = new Invoice();
                $invoice->user()->associate($user);
                $invoice->total = $user->subscription->package->product;
                $invoice->status = 'paid';
                $invoice->save();

                $invoice->name = 'Invoice INV-' . $invoice->id;
                $invoice->save();

                $invoice->products()->attach($user->subscription->package->product);
            });

            Notifynder::category('notifications')
                ->from(Auth::user()->id)
                ->to($user->id)
                ->url(url('member/dashboard'))
                ->extra(['message' => 'Your account has been activated!'])
                ->send();

            Mail::send('emails.activation_email', [
                'user' => $user,
            ], function ($m) use ($user) {

                $m->to($user->email, $user->firstname . ' ' . $user->lastname)
                    ->subject('Account activated');
            });

            $message = 'User ' . $user->firstname . ' ' . $user->lastname . ' was successfully activated.';
            return redirect('admin/users')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);
            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/users')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }
}
