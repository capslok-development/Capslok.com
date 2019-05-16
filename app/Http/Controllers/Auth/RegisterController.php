<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyEmail;
use App\Stance;
use App\VerifyUser;
use \DB;
use App\User;
use App\City;
use App\UserContactInfo;
use App\PoliticiansInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'first_name' => 'required|string|max:255|alpha',
            'last_name' => 'required|string|max:255|alpha',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'date_of_birth' => 'required|date',
            'is_politician' => 'nullable',
            'profile_type_id' => 'nullable',
            'party_id' => 'nullable',
            'province' => 'nullable',
            'city' => 'nullable',
            'ward' => 'nullable',
        ]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return \App\User
     */
    protected function create(Request $request)
    {

        // run the validation rules on the inputs from the form
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return Redirect::to('register')
                ->withErrors($validator);
        }

        $user_info = [
            'user_name' => '',
            'first_name' => strtolower($request['first_name']),
            'last_name' => strtolower($request['last_name']),
            'email' => strtolower($request['email']),
            'password' => bcrypt($request['password']),
            'date_of_birth' => $request['date_of_birth'],
            'your_ward' => $request['your_ward'],
            'home_address' => $request['home_address'],
        ];


        // Pending politician
        if ($request['is_politician']) {
            $user_info += [ 'user_type' => 5 ];
        }

        if ($request['is_politician']) {
            if($request['profile_type_id'] == null) {
                return Redirect::back()->with('selectprofiletype', 'Please complete all options.');
            } else {
                if ($request['profile_type_id'] == 1 && $request['ward'] == null) {
                    return Redirect::back()->with('selectprofiletype', 'Please complete all options if you are a candidate.');
                } else if($request['profile_type_id'] == 2 && $request['city'] == null) {
                    return Redirect::back()->with('selectprofiletype', 'Please complete all options if you are a candidate.');
                }
            }

            $user = User::create($user_info);

            PoliticiansInfo::create([
                'user_id' => $user->id,
                'profile_type_id' => $request['profile_type_id'],
                'party_id' => $request['party_id'],
                'province' => $request['province'],
                'city' => $request['city'] ?? "Winnipeg",
                'ward_id' => $request['ward'],
                'aboutme' => '',
                'is_incumbent' => $request['is_incumbent'] ? $request['is_incumbent'] : 0,
            ]);

            UserContactInfo::create([
                'user_id' => $user->id,
                'primary_email' => strtolower($request['email']),
                'city_id' => 1,
                'is_politician' => 1
            ]);

            Stance::create([
                'title' => 'Add title or slogan',
                'content' => 'What are your stances?',
                'user_id' => $user->id
            ]);
            return view('pending');
        } else {
            $user = User::create($user_info);
        }

        VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new VerifyEmail($user));
            
        return view('auth.login')->with('email', $user->email)->with('verifySent', 'A verification email has been sent. You may log in, but please verify the email soon.');
    }

    /**
     * need this to pass parameters to the register views
     */
    public function showRegistrationForm() {
        $profiles = DB::table('profile_types')->get();
        $parties = DB::table('politicians_party')->get();
        $wards = DB::table('wards')->get();

        return view('auth.register')
                ->with('parties', $parties)
                ->with('profiles', $profiles)
                ->with('wards', $wards);
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login again.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }
}
