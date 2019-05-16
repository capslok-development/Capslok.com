
@extends('layouts.app')

@section('nav')
    @include('partials.nav')
@endsection

@section('content')

    <div class="container">
        <div class="col-lg-12" style="border: 1px solid lightgrey;padding: 15px;background-color: white;margin-top: 40px;border-radius:10px;">
            <p><h3 style="color:black;float: left;">Elections</h3></p>
            <br />
            <h5 style="color:grey;">
                For Elections
            </h5>
            <p style="margin-top: 40px;line-height: 25px;">
                CAPSLOK has a purpose to allow elections to be
                orchestrated efficiently and accessibly. Whether
                a municipal poll, student body nomination, or a
                city-wide election, this platform will strive to
                host representatives and inform voters as a
                neutral third party.<br /><br />
                Starting with an informational function,
                CAPSLOK will eventually incorporate
                communication functions to take over from the
                dated methods currently utilized within
                elections. As CAPSLOK progresses, it will move
                to add functions beyond information and
                communication, such as voter registration and
                casting of votes.<br /><br />
                Please <b><u><a href="{{ route('register') }}" style="color:black;">REGISTER</a></u></b>
                to be a part of this movement
                towards effective representation and be
                notified when CAPSLOK is updated with
                functions to be utilized by you.
            </p>
        </div>
    </div>

@endsection