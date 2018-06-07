<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Request;
use App\User;
use Fenos\Notifynder\Builder\NotifynderBuilder;
use Fenos\Notifynder\Exceptions\EntityNotIterableException;
use Fenos\Notifynder\Exceptions\IterableIsEmptyException;
use Fenos\Notifynder\Facades\Notifynder;
use Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

    use AuthenticatesAndRegistersUsers,
        ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'member/subscription';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'signup_firstname' => 'required|max:255',
            'signup_lastname' => 'required|max:255',
            'signup_email' => 'required|email|max:255|unique:users,email',
            'signup_password' => 'required|min:6',
            'terms' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'firstname' => $data['signup_firstname'],
            'lastname' => $data['signup_lastname'],
            'email' => $data['signup_email'],
            'role_id' => 2,
            'avatar' => 'profile.svg',
            'password' => bcrypt($data['signup_password']),
        ]);

        $admins = User::whereHas('role', function ($query) {
            $query->where('name', '=', 'admin');
        })->get();


        try {
            Notifynder::loop($admins, function (NotifynderBuilder $builder, $u) use ($user) {
                $builder->category('notifications')
                    ->from($user->id)
                    ->to($u->id)
                    ->url(url('admin/users/' . $user->id))
                    ->extra(['message' => 'User ' . $user->firstname . ' ' . $user->lastname . ' has been registered.']);
            })->send();

            Mail::send('emails.admin_new_member', [
                'user' => $user,
                'notificationMessage' => 'User ' . $user->firstname . ' ' . $user->lastname . ' has been registered.'
            ], function ($m) use ($user) {
                $m->to($user->email, $user->firstname . ' ' . $user->lastname)
                    ->subject('New User Created');
            });

        } catch (EntityNotIterableException $e) {
        } catch (IterableIsEmptyException $e) {
        }

        Mail::send('emails.new_member', ['user' => $user, 'password' => $data['signup_password']], function ($m) use ($user) {
            $m->to($user->email, $user->firstname . ' ' . $user->lastname)
                ->subject('Your New Member Account');
        });

        return $user;
    }

    public function getLogin()
    {
        return view('auth.login_register');
    }

    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {
        return redirect('guest#login')
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

}
