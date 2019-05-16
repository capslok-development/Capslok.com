
@extends('layouts.app')

@section('nav')
@include('partials.nav')
@endsection

@section('content')

    <div class="container">
        <div class="col-lg-12" style="border: 1px solid lightgrey;padding: 15px;background-color: white;margin-top: 40px;border-radius:10px;">
            <p><h3 style="color:black;float: left;">Representatives</h3></p>
            <br />
            <h5 style="color:grey;">
                For Representatives,
                Politicians, and Elected
                Officials
            </h5>
            <p style="margin-top: 40px;line-height: 25px;">
                CAPSLOK is a platform purposed to bring
                representatives of all levels and types into a
                closer dialogue with their constituents.<br /><br />
                Current communication methods increasingly
                inhibits quality representation. Town halls,
                phone calls, emails, and even comments and
                tweets do not accommodate genuine
                conversation with all generations of voters.<br /><br />
                CAPSLOK will create a platform that allows
                representatives to be discovered by their
                voters, communicate with them efficiently and
                frequently, and take action – or not – with this
                support.<br /><br />
                Please <b><u><a href="{{ route('user.register') }}" style="color:black;">REGISTER</a></u></b> to be a part of this movement
                towards effective representation and be
                notified when CAPSLOK is updated with
                functions to be utilized by you.
            </p>
        </div>
    </div>

@endsection