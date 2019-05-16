@extends('..layouts.app')

@section('nav')
    @include('partials.nav')
@endsection

@section('content')
<div class="container">
    <div class="single-user-container" style="padding:20px;">

        <div class="content" style="display: flow-root;">
            <div class="col-lg-12" style="padding-bottom: 20px;display: flow-root;padding-top: 20px;">
                <div class="col-lg-12" style="margin-bottom:50px;">
                    <h4 style="color:black">Profile information and actions</h4>
                    <h5 style="color:grey">Manage users' profile information</h5>
                </div>
                <hr />
                <div class="col-lg-5 col-md-6 col-sm-12" style="float:left;">
                    <table>
                        <tr>
                            <td style="padding: 10px;">Name:</td>
                            <td style="padding: 10px;">{{ $user['first_name'] }} {{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">Phone:</td>
                            <td style="padding: 10px;">{{ $user['phone_number'] }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">Email:</td>
                            <td style="padding: 10px;">{{ $user->email ? $user->email : 'Not registered' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">User Type:</td>
                            <td style="padding: 10px;">{{ $user->getUserType() }}</td>
                        </tr>
                        @if(in_array($user->user_type, [4, 5]))
                            <tr>
                                <td style="padding: 10px;">Candidate Type:</td>
                                <td style="padding: 10px;">{{ $user->politiciansInfo->getType()->type }}</td>
                            </tr>
                            @if($user->politiciansInfo->getType()->id == 1)
                                <tr>
                                    <td style="padding: 10px;">Ward:</td>
                                    <td style="padding: 10px;">{{ $user->politiciansInfo->getWard()->name }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td style="padding: 10px;">Party:</td>
                                <td style="padding: 10px;">{{ $user->politiciansInfo->getParty() ? $user->politiciansInfo->getParty()->name : 'None selected' }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;">Is Incumbent:</td>
                                <td style="padding: 10px;">{{ $user->politiciansInfo->is_incumbent ? 'Yes' : 'No' }}</td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="col-lg-5 col-md-6 col-sm-12" style="float:right;">
                    @if($user->user_type == 5)
                        <h2 class="priviledges-title" style="marign-top:0px;">Add to Politicians list:</h2>
                        <form action="/approve-pending-politician" method="POST" class="save-user-status" style="float:left;margin:5px;">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$user->id}}" >
                            <button class="btn btn-primary" type="submit">
                                Accept
                            </button>
                        </form>
                        <form action="/decline-pending-politician" method="POST" class="save-user-status" style="float:left;margin:5px;">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$user->id}}" >
                            <button class="btn btn-danger" type="submit">
                                Decline
                            </button>
                        </form>
                    @endif

                    @if(Auth::user()->user_type ==  3)
                        @if($user->account_locked == 1)
                            <h5>Unblock user account: </h5>
                            <form action="/unlock-account" method="POST" class="lock-account" style="float:left;margin:5px;">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{$user->id}}" >
                                <button class="btn btn-primary" type="submit">
                                    Unblock
                                </button>
                            </form>
                        @else
                            <h5 style="marign-top:0px;">Block user account: </h5>
                            <form action="/lock-account" method="POST" class="unlock-account" style="float:left;margin:5px;">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{$user->id}}" >
                                <button class="btn btn-primary" type="submit">
                                    Block
                                </button>
                            </form>
                        @endif
                        <br />
                        <br />
                        <br />
                            <h5>Delete user account: </h5>
                        <button class="btn btn-danger" onclick="showDelete(true)" id="delete">
                            Delete user
                        </button>
                        <form action="/delete-account" method="POST" class="lock-account" style="float:left;margin:5px;display: none;" id="delete-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{$user->id}}" >
                            <h5>Are you sure you want to delete this user?</h5>
                            <button class="btn btn-danger" type="submit">
                                Yes, delete user
                            </button>
                        </form>
                        <button class="btn btn-primary" onclick="showDelete(false)" id="do-not-delete" style="display: none;">
                            No, do not delete
                        </button>
                        <br />
                        <br />
                        <br />
                        @if($user->frozen == 1)
                            <h5 style="marign-top:0px;">Show/unfreeze user account: </h5>
                            <form action="/show-account" method="POST" class="unlock-account" style="float:left;margin:5px;">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{$user->id}}" >
                                <button class="btn btn-primary" type="submit">
                                    Show/unfreeze
                                </button>
                            </form>
                        @else
                                <h5 style="marign-top:0px;">Hide/freeze user account: </h5>
                                <form action="/hide-account" method="POST" class="unlock-account" style="float:left;margin:5px;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="{{$user->id}}" >
                                    <button class="btn btn-primary" type="submit">
                                        Hide
                                    </button>
                                </form>
                        @endif
                    @endif
                </div>
            </div>
            <hr />
            @if($user->user_type == 4 && $user->candidate_has_joined == 0)
                <div class="col-lg-12" style="display: block;margin-top:50px;">
                    <div class="col-lg-12" style="display: flex;">
                        <h3 style="color:black;float:left;">Candidate onboarding</h3>
                    </div>
                    <div class="col-lg-12" style="display: flex;">
                        <h5 style="color:grey;float:left;margin-bottom:30px;">This candidate has not registered with Capslok yet. Enter/save their email below and click "Send Invitation" to onboard them.</h5>
                    </div>
                    @if (session('savedEmail'))
                        <div class="alert alert-success" style="margin-top:10px;display: flex;">
                            {{session('savedEmail')}}
                        </div>
                    @endif
                    @if (session('invitationSent'))
                        <div class="alert alert-success" style="margin-top:10px;display: flex;">
                            {{session('invitationSent')}}
                        </div>
                    @endif
                    <div class="col-lg-12">
                        @if(!$user->email)
                            <form action="/add-candidate-email" method="post" class="col-lg-4 col-md-6 col-sm-12" style="display: inline-block;">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$user->id}}" />
                                <div class="input-group">
                                    <input class="form-control" name="email" required type="email" placeholder="Candidate email address" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </span>
                                </div>
                            </form>
                        @endif
                        @if($user->email)
                            <form action="/invite-candidate" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$user->id}}" />
                                <button class="btn btn-primary" type="submit">Send Invitation</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

<script>
    function showDelete(show) {
        $('#delete').toggle(!show);
        $('#delete-form').toggle(show);
        $('#do-not-delete').toggle(show);
    }
</script>
