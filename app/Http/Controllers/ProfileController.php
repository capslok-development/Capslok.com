<?php

namespace App\Http\Controllers;

use allejo\Socrata\Exceptions\FileNotFoundException;
use App\ContactInfo;
use App\NotifyCandidate;
use App\PoliticiansInfo;
use App\PoliticiansParty;
use App\Stance;
use App\User;
use App\Mail\NotifyEmail;
use App\Wards;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public $map_url;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $temp = DB::table('maps_url')->orderBy('created_at', 'desc')->first();
        $this->map_url = $temp ? $temp->url : '';
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->description = $request->description;
        $user->save();
        
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $tab = null)
    {
        if (!isset($tab)) {
            $tab = 'stances';
        }

        $user = User::find($id);
        $data['map_url'] = $this->map_url;

        return view("politician-profiles.$tab")
                ->with('user', $user)->with('data', $data);
    
    }

    public function updateAboutme(Request $request) {
        $politicianinfo = PoliticiansInfo::where('user_id', $request->user_id)->get()->first();
        $politicianinfo->aboutme = $request->aboutme;
        $politicianinfo->save();

        $user = User::find($request->user_id);

        return view("politician-profiles.about")
            ->with('user', $user);
    }

    public function updateTitle(Request $request) {
        $stance = Stance::find($request->stance_id);
        $stance->title = $request->title;
        $stance->save();

        return view("politician-profiles.stances")
            ->with('user', Auth::user());
    }

    public function updateContent(Request $request) {
        $stance = Stance::find($request->stance_id);
        $stance->content = $request->contenttext;
        $stance->save();

        return redirect()->route('home');
    }

    public function addStance(Request $request) {
        $user_id = Auth::user()->id;

        $stance = new Stance;
        $stance->user_id    = $user_id;
        $stance->title      = $request->title;
        $stance->content    = $request->content;
        $stance->save();
        
        return redirect()->route('home');
    }

    public function deleteStance(Request $request) {
        $stance = Stance::find($request->stance_id);
        $stance->delete();
        return redirect()->route('home');
    }

    public function freezeprofile(Request $request) {
        $user = User::find($request->user_id);
        $user->frozen = !boolval($request->freeze);
        $user->save();

        return redirect()->back();
    }

    public function editUserProfile(Request $request) {
        // validate the info, create rules for the inputs
        $rules = array(
            'firstname'    => 'required|alpha|min:2',
            'lastname' => 'required|alphaNum|min:2',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'other' => 'nullable|url',
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->fails()) {
            return Redirect::back()
                ->withInput(Input::all())
                ->withErrors($validator);
        } else {
            $user = Auth::user();
            $user->first_name = $request->firstname;
            $user->last_name = $request->lastname;
            $user->home_address = $request->address;
            $user->ward_id = $request->your_ward;

            if ($user->user_type !== 4 && $user->user_type !== 5) {
                $user->user_name = $request->username;
            }

            if($user->user_type == 4) {
                $contactInfo = $user->contactInfo()->first();
                if ($contactInfo == null) {
                    $contactInfo = new ContactInfo();
                    $contactInfo->is_politician = 1;
                    $contactInfo->user_id = $user->id;
                }
                $contactInfo->fb_link = $request->facebook;
                $contactInfo->twitter_link= $request->twitter;
                $contactInfo->other_link= $request->other;
                $contactInfo->save();

                $politiciansInfo = $user->politiciansInfo()->first();
                $politiciansInfo->party_id = $request->party;
                $politiciansInfo->is_incumbent = $request->is_incumbent ? 1 : 0;
                $politiciansInfo->save();
            }
            $user->save();

            return Redirect::back()->with('saved', 'Successfully updated profile!');
        }
    }

    public function getEditUserProfile() {
        $parties = PoliticiansParty::all();
        $wards = Wards::all();
        return view("edit.user-profile")->with('parties', $parties)->with('wards', $wards);
    }

    public function notifyRegister(Request $request) {
        $id = $request->request->get('candidate_id');
        $user = User::where([['id', $id], ['user_type', 4]])->first();

        if(empty($user) || !$user->email) {
            return Redirect::back()->with('success', 'The candidate has been notified to join CAPSLOK!');
        }

        if ($user->num_registration_requests % 25 == 0) {

            NotifyCandidate::create([
                'user_id' => $user->id
            ]);

            Mail::to($user->email)->send(new NotifyEmail($user));
        }

        $user->num_registration_requests += 1;
        $user->save();

        return Redirect::back()->with('success', 'The candidate has been notified to join CAPSLOK!');
    }

    public function editPoliticianProfile(Request $request) {
        $rules = array(
            'stance'    => 'required',
            'stance_title'    => 'required',
            'experience'    => 'required',
            'experience_title'    => 'required',
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->fails()) {
            return Redirect::back()
                ->withInput(Input::all())
                ->withErrors($validator);
        } else {
            $stance = Stance::where('user_id', $request->user_id)->first();
            $stance->content = $request->stance;
            $stance->title = $request->stance_title;
            $stance->save();

            $politicianinfo = PoliticiansInfo::where('user_id', $request->user_id)->get()->first();
            $politicianinfo->aboutme = $request->experience;
            $politicianinfo->aboutme_title = $request->experience_title;
            $politicianinfo->save();

            return Redirect::back()->with('saved', 'Successfully updated profile!');
        }
    }

    public function updateProfilePicture(Request $request) {
        $user = Auth::user();

        if($user->profile_pic_path != 'images/profile_pictures/'.$user->id.$request->file->getClientOriginalName()) {
            $image_path = $user->profile_pic_path;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $user->profile_pic_path = 'images/profile_pictures/'.$user->id.$request->file->getClientOriginalName();
        $user->save();
        return "success";
    }

    public function updateBackgroundPicture(Request $request) {
        $user = Auth::user();

        if($user->background_pic_path != 'images/background_pictures/'.$user->id.$request->file->getClientOriginalName()) {
            $image_path = $user->background_pic_path;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $user->background_pic_path = 'images/background_pictures/'.$user->id.$request->file->getClientOriginalName();
        $user->save();
        return "success";
    }
}
