<?php

namespace App\Http\Controllers;

use App\Mail\InvitationEmail;
use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
        //
    }

    public function viewUser(Request $request) {
        if (Auth::guest() || Auth::user()->user_type != 3) {
            return redirect('home');
        }

        $user = User::find($request->id);
        $user_types = UserType::all();

        return view('admin.single-user')->with(compact('user', 'user_types'));
    }

    public function approvePendingPolitician(Request $request) {
        $user = User::find($request->id);
        $user->user_type = 4;
        $user->approved = 1;
        $user->verified = 1;
        $user->frozen = 1;
        $user->save();

        return redirect()->back();
    }

    public function declinePendingPolitician(Request $request) {
        User::destroy($request->id);

        return redirect()->route('admin.userlisting')->with($this->getUsersAndUseTypes());
    }

    public function updateUserType(Request $request) {
        $user = User::find($request->user_id);
        $user->user_type = $request->user_type;
        $user->save();

        return redirect()->back();
    }

    public function lockAccount(Request $request) {
        $user = User::find($request->user_id);
        $user->account_locked = true;
        $user->save();

        return redirect()->back();
    }

    public function unlockAccount(Request $request) {
        $user = User::find($request->user_id);
        $user->account_locked = false;
        $user->save();

        return redirect()->back();
    }

    public function deleteAccount(Request $request) {
        User::destroy($request->user_id);

        return redirect()->route('admin.userlisting')->with($this->getUsersAndUseTypes());
    }

    public function addCandidateEmail(Request $request) {
        $user = User::where('id', $request->request->get('id'))->first();
        $user->email = $request->request->get('email');
        $user->save();

        return redirect()->back()->with('savedEmail', 'Email saved successfully');
    }

    public function inviteCandidate(Request $request) {
        $user = User::where('id', $request->request->get('id'))->first();

        Mail::to($user->email)->send(new InvitationEmail($user));

        return redirect()->back()->with('invitationSent', 'An invitation email has been sent to this candidate');
    }

    private function getUsersAndUseTypes() {
        $users = User::paginate(10);
        $user_types = UserType::all();
        return (compact('users', 'user_types'));
    }

    public function hideAccount(Request $request) {
        $user = User::where('id', $request->request->get('user_id'))->first();
        $user->frozen = true;
        $user->save();
        return redirect()->back();
    }

    public function showAccount(Request $request) {
        $user = User::where('id', $request->request->get('user_id'))->first();
        $user->frozen = false;
        $user->save();
        return redirect()->back();
    }
}
