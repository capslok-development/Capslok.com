@extends('layouts.app')

@section('nav')
    @include('partials.nav')
@endsection

@section('content')

    <div class="container">
        <div class="col-lg-12" style="border: 1px solid lightgrey;padding: 15px;background-color: white;margin-top: 40px;border-radius:10px;">
            <p><h3 style="color:black;float: left;">Registration submitted</h3></p>
            <br />
            <h5 style="color:grey;">
                Thank you for registering with CAPSLOK!
            </h5>
            <p style="margin-top: 40px;line-height: 25px;">
                We are reviewing and validating your account and position and will let you know once its approved, at which point you may log in and set up your profile.
            </p>
            <a class="btn btn-primary" href="/home" type="margin-top:20px;">Continue to CAPSLOK</a>
        </div>
    </div>

@endsection