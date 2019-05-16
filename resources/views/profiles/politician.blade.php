@extends('layouts.app')

@include('partials.nav')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<div class="container hidden-xs hidden-sm">
    <center>
        <div style="display:grid;margin:10px;background-color:white;border:1px solid #bdb9b9;padding: 20px;border-radius: 10px;">
            <div class="col-md-12" style="margin-bottom:0px;margin-top:0px;">
                <form method="GET" action="{{ route('searchby.homeaddress') }}" class="col-lg-4 col-lg-offset-2 col-md-5 col-md-offset-1 first_search" style="float:left;">
                    <label for="address">Search for candidates by address:</label>
                    <div class="form-inline" style="margin:10px;">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Home address">
                        <button class="btn btn-primary btn_home">
                            Search
                        </button>
                        @if (session()->has('notfoundaddress'))
                            <div class="alert alert-danger" style="margin-top:10px;">
                                {{session('notfoundaddress')}}
                            </div>
                        @endif
                    </div>
                </form>
                <div class="col-md-4 col-xs-12 second_search">
                    <label>Find your representatives from the Ward Map:</label><br />
                    <button class="btn btn-primary btn-lg btn_home1" onclick="removeClass('closed')">
                        Wardmap
                    </button>
                    @if (isset($data['notfoundward']))
                        <div class="alert alert-danger" style="margin-top:10px;">
                            {{$data['notfoundward']}}
                        </div>
                    @endif
                </div>
            </div>
            @if (isset($data['hideViewAllButton']))
                <a style="padding:4px;" class="btn btn-primary col-md-2" href="{{ route('home.allPoliticiansInfoView') }}">
                    See all politicians
                </a>
            @endif
        </div>
    </center>
</div>

<div class="pop-up closed" id="wardmap">
    <div class="pop-up-content">
        <div class="close-button" onclick="addClassTo('pop-up', 'closed');">
            <i class="fas fa-times"></i>
        </div>
        <div class="title" style="padding:15px;">Choose Your Ward:</div>
        <div class="content" style="height:100%">
            <iframe src="https://www.google.com/maps/d/embed?mid={{$data['map_url']}}" style="width:100%;height:100%;"></iframe>
        </div>
    </div>
</div>


<div class="col-lg-offset-2 col-lg-8 col-md-12 col-sm-12" style="padding-left: 0px;padding-right: 0px;">
    <div class="card2 hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src="{{ url('/').'/'.$user->background_pic_path }}">
        </div>
        <div class="useravatar">
            <img alt="" src="{{ url('/').'/'.$user->profile_pic_path }}" style="width:150px;">
        </div>
        <div class="card-info">
            <span class="card-title">
                {{ $user['first_name'] }} {{ $user->last_name }} <br />
                <i>{{ $user->politiciansInfo->is_incumbent ? 'Incumbent' : 'Candidate' }}</i> {{ $user->politiciansInfo->getType()->type ?? '' }} <br />
                {{ $user->politiciansInfo->getWard()->name ?? '' }} Ward <br />
                {{ $user->politiciansInfo->city }}, {{ $user->politiciansInfo->province }}, Canada <br /><br />

                @if ($user->politiciansInfo->getContactInfo())
                    @if ($user->politiciansInfo->getContactInfo()->fb_link)
                        <a href="{{$user->politiciansInfo->getContactInfo()->fb_link}}" target="_blank" rel="noopener noreferrer" style="margin-left:20px;margin-right:20px;font-size:10px;color:#fff;"><i class="fab fa-facebook-f fa-3x"></i></a>
                    @endif
                    @if ($user->politiciansInfo->getContactInfo()->twitter_link)
                        <a href="{{$user->politiciansInfo->getContactInfo()->twitter_link}}" target="_blank" rel="noopener noreferrer" style="margin-left:20px;margin-right:20px;font-size:10px;color:#fff;"><i class="fab fa-twitter fa-3x"></i></a>
                    @endif
                    @if ($user->politiciansInfo->getContactInfo()->other_link)
                        <a href="{{$user->politiciansInfo->getContactInfo()->other_link}}" target="_blank" rel="noopener noreferrer" style="margin-left:20px;margin-right:20px;font-size:10px;color:#fff;"><i class="fab fa-instagram fa-3x"></i></a>
                    @endif

                @endif
            </span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="fa fa-star" aria-hidden="true"></span>
                <div class="hidden-xs">Projects and Stances</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="fa fa-briefcase" aria-hidden="true"></span>
                <div class="hidden-xs">Past Experience</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="fa fa-address-card" aria-hidden="true"></span>
                <div class="hidden-xs">Contact Information</div>
            </button>
        </div>
    </div>

    <div class="well">
        <div class="tab-content">
            @if ($user->candidate_has_joined)
                <div class="tab-pane fade in active" id="tab1">
                    @foreach ($user->politiciansInfo->stances as $stance)
                        <div class="text-card">
                            @include('..partials.text-card', [ 'stance' => $stance, 'classes' => 'editable', 'politician_id' => $user->id ])
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade in" id="tab2">
                    <div class="text-card">
                        @include('..partials.about-card', [ 'about' => $user->politiciansInfo->aboutme, 'aboutTitle' => $user->politiciansInfo->aboutme_title, 'date' => $user->politiciansInfo->updated_at, 'user_id' => $user->id, 'politician_id' => $user->id ])
                    </div>
                </div>
                <div class="tab-pane fade in" id="tab3">
                    <div class="text-card">
                        @include('..partials.contactme-card', [ 'contactInfo' => $user->politiciansInfo->contactme])
                    </div>
                </div>
            @else
                <div class="text-card">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h4 style="color:black;float:left;">This candidate has not yet joined CAPSLOK. Click "Notify Candidate" to send a request to join CAPSLOK.</h4><br /><br />

                    @auth
                        <form method="POST" action="{{ route('candidate.notifyRegister') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="candidate_id" value="{{$user->id}}">
                            <button class="btn btn-primary" type="submit">Notify Candidate</button>
                        </form>
                    @endauth
                    @guest
                        <form method="GET" action="{{ route('login') }}">
                            <button class="btn btn-primary" type="submit">Notify Candidate</button>
                        </form>
                    @endguest
                </div>
            @endif
        </div>
    </div>

</div>
@endsection

<script>

    function ready() {
        $(".btn-pref .btn").click(function () {
            $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
            // $(".tab").addClass("active"); // instead of this do the below
            $(this).removeClass("btn-default").addClass("btn-primary");
        });
    }

    document.addEventListener("DOMContentLoaded", ready);

</script>