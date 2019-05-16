<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\PoliticiansParty;
use App\VerifyUser;
use App\Wards;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function doLogin()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );

            $user = User::where('email', Input::get('email'))->get();

            if(count($user) == 0) {
                // validation not successful, send back to form
                return Redirect::back()
                    ->withInput(Input::all())
                    ->withErrors([
                        'email' => 'No account found for this email!'
                    ]);
            }

            $user = $user[0];

            if(!$user->verified) {
                if($user->num_logins > 5) {
                    return Redirect::back()
                        ->withInput(Input::all())
                        ->withErrors([
                            'emailVerification' => 'Your account needs verification. Please check your email and verify your account, or resend the verification email.'
                        ]);
                }
            }

            if($user->user_type == 5) {
                return Redirect::back()
                    ->withInput(Input::all())
                    ->withErrors([
                        'email' => 'Your politician account has not been approved yet!'
                    ]);
            }

            $isLocked = $user->account_locked;

            // attempt to do the login
            if (!$isLocked && Auth::attempt($userdata)) {
                if (Auth::user()->user_type == 4) {
                    $parties = PoliticiansParty::all();
                    $wards = Wards::all();

                    $user->num_logins += 1;
                    $user->candidate_has_joined = 1;
                    $user->save();
                    return view("edit.user-profile")->with('parties', $parties)->with('wards', $wards);
                } else {
                    return Redirect::back();
                }

            } else {
                if ($isLocked) {
                    return Redirect::back()
                        ->withInput(Input::all())
                        ->withErrors([
                            'email' => 'Your account has been blocked!'
                        ]);
                } else {
                    // validation not successful, send back to form
                    return Redirect::back()
                        ->withInput(Input::all())
                        ->withErrors([
                            'email' => 'Email or password incorrect!'
                        ]);
                }

            }

        }
    }

    public function resendVerification(Request $request) {
        $email = $request->request->get('email');

        $user = User::where('email', $email)->first();
        if(empty($user)) {
            return back()->with('verifySent', 'A verification email has been sent. Please check your email, verify your account, and log in to CAPSLOK.');
        }

        VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new VerifyEmail($user));
        return back()->with('verifySent', $user->email)->with('verifySent', 'A verification email has been sent. Please check your email, verify your account, and log in to CAPSLOK.');
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('home');
    }
}
