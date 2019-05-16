<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUS;

class ContactController extends Controller {

    public function create()
    {
    }

    public function contactUSPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contactus = new ContactUS();
        $contactus->name = $request['name'];
        $contactus->email = $request['email'];
        $contactus->message = $request['message'];
        $contactus->save();

        return back()->with('success', 'Thanks for contacting us!');
    }

}