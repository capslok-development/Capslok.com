
@extends('layouts.app')

@section('nav')
    @include('partials.nav')
@endsection

@section('content')

    <div class="container">
        <div class="col-lg-12" style="border: 1px solid lightgrey;padding: 15px;background-color: white;margin-top: 40px;border-radius:10px;">
            <p><h3 style="color:black;float: left;">Voters</h3></p>
            <br />
            <h5 style="color:grey;">
                For Voters, Constituents,
                and Electors
            </h5>
            <p style="margin-top: 40px;line-height: 25px;">
                CAPSLOK is currently focusing on the City of Winnipeg 2018
                Election and is in beta testing.<br /><br />
                CAPSLOK is designed to provide users with information on
                actual and potential representatives in a manner that is efficient
                and allows for comparisons.<br /><br />
                Please enter your residential address at the top of this page to
                see this function or find your relevant candidates through the
                Ward Map. You will also find voting information and instructions
                on how to vote alongside the candidates’ profiles.<br /><br />
                Please know that if you are (i) a Canadian Citizen, (ii) 18 years of
                age or older by Election Day (October 24 th , 2018), and (iii) are a
                resident or property owner in the City of Winnipeg for a period
                of at least 6 months, you can vote in this election.<br /><br />
                CAPSLOK does not provide the voting service – yet. While at this
                stage CAPSLOK serves only an informational function, as it
                develops it will be incorporating revolutionary communication
                mechanisms. This is a part of CAPSLOK’s Purpose to become a
                platform used for any form of election, to improve
                communication, and to improve representation.<br /><br />
                Please consider <b><u><a href="{{ route('register') }}" style="color:black;">REGISTERING</a></u></b>
                so we can notify you when CAPSLOK
                adds these features.
            </p>
        </div>
    </div>

@endsection