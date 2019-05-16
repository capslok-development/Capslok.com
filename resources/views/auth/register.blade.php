@extends('layouts.app')

@include('partials.nav')

@section('script')
<script>
    $(document).ready(function () {
        var checkbox = $('#is_politician');
        checkbox.change(function () {
            if (this.checked) {
                $('.politician-container-new').show(250);
                $('#your_ward').hide(250);
                $('#home_address').hide(250);
            } else {
                $('.politician-container-new').hide(250);
                $('#your_ward').show(250);
                $('#home_address').show(250);
            }
        });

        var profileType = $('#profile_type');
        profileType.change(function () {
            if(profileType[0].selectedIndex == 2){
                $('.location-container-new').show(250);
                $('.ward-container').hide(250);
            } else if(profileType[0].selectedIndex == 1) {
                $('.location-container-new').hide(250);
                $('.ward-container').show(250);
            }
        });
    });
</script>
@endsection

@section('content')
<div class="container" style="width:95%;max-width:450px;background-color:white;border-radius:5px;margin-top:10%;border:1px solid #d4d4d4;padding:20px;padding-left:40px;padding-right:40px;">
    <div class="">
        <h2>Register with Capslok</h2>
        <hr />
        @if ($errors->has('last_name') || $errors->has('first_name') || $errors->has('date_of_birth') || $errors->has('email') || $errors->has('password') || session()->has('selectprofiletype'))
            <div class="alert alert-danger">
                <p>{{$errors->first('last_name')}}</p>
                <p>{{$errors->first('first_name')}}</p>
                <p>{{$errors->first('date_of_birth')}}</p>
                <p>{{$errors->first('email')}}</p>
                <p>{{$errors->first('password')}}</p>
                <p>{{session()->has('selectprofiletype') ? session()->get('selectprofiletype') : null}}</p>
            </div>
        @endif
        <div class="">
            {!! Form::model([
                'method' => 'POST',
                'route' => ['user.register']
            ]) !!}
            {{ csrf_field() }}

            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required="" autofocus="" style="margin-top:10px;margin-bottom:10px;" />
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required="" autofocus="" style="margin-top:10px;margin-bottom:10px;" />
            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="" autofocus="" style="margin-top:10px;margin-bottom:10px;" />
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="" autofocus="" style="margin-top:10px;margin-bottom:10px;" />
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation" required="" autofocus="" style="margin-top:10px;margin-bottom:10px;" />
            <select name="your_ward" id="your_ward" class="form-control" style="margin-top:10px;margin-bottom:10px;">
                <option value="" selected disabled hidden>What is your residential ward?</option>
                @foreach($wards as $ward)
                    <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                @endforeach
            </select>
            <input name="home_address" id="home_address" type="text" class="form-control" placeholder="Or input your home address" style="margin-top:10px;margin-bottom:10px;" />

            <label class="form-control">
                <b style="margin-left:5px;">Are you a candidate for an election?</b>
                <input type="checkbox" name="is_politician" id="is_politician" class="form-inline" style="float:left;">
            </label>



            <div class="politician-container-new" style="display: none;">
                <div class="profile-container">
                    <select name="profile_type_id" id="profile_type" class="form-control" style="margin-top:10px;margin-bottom:10px;">
                        <option value="" selected disabled hidden>What are you running for?</option>
                        @foreach($profiles as $profile)
                            <option value="{{ $profile->id }}" {{$profile->enabled ? '' : 'disabled'}}>{{ $profile->type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="location-container-new" style="display: none;">
                    <select name="city" id="city-input" class="form-control" style="margin-top:10px;margin-bottom:10px;">
                        <option value="" disabled selected hidden>Select city</option>
                        <option id="winnipeg">Winnipeg</option>
                    </select>

                    <input type="hidden" name="province" id="province-input" maxlength="2" value="MB">
                </div>

                <div class="ward-container" style="display: none;">
                    <select name="ward" class="form-control" style="margin-top:10px;margin-bottom:10px;">
                        <option value="" selected disabled hidden>Which ward do you belong to?</option>
                        @foreach($wards as $ward)
                            <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="form-control">
                    <b style="margin-left:5px;">Are you an incumbent?</b>
                    <input type="checkbox" name="is_incumbent" class="form-inline" style="float:left;">
                </label>
            </div>

            <div style="position: relative;">
                <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:20px;margin-bottom:10px;">Register</button>
            </div>

            {!! Form::close() !!}

            <div class="alert alert-info" style="margin-top:20px;position: relative;">
                Already have an account?
                <a href="/login" style="font-weight:bolder;color:darkblue;margin-left:5px;">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection
