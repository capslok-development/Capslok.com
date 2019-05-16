@extends('layouts.app')

@include('partials.nav')

@section('content')

    <div class="container" style="width:95%;max-width:450px;background-color:white;border-radius:5px;margin-top:10%;border:1px solid #d4d4d4;padding:20px;padding-left:40px;padding-right:40px;">

        <h2 class="form-signin-heading">Log in to Capslok</h2>
        <hr />
        @if (isset($success) && $success)
            <div class="alert alert-success">
                Registration complete. Please sign in now.
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        @if (isset($verifySent))
            <div class="alert alert-success">
                {{ $verifySent }}
            </div>
        @endif

        @if (session('verifySent'))
            <div class="alert alert-success">
                {{ session('verifySent') }}
            </div>
        @endif

        @if ($errors->has('password'))
            <div class="alert alert-warning">
                {{ $errors->first('password')}}
            </div>
        @endif
        @if ($errors->has('email'))
            <div class="alert alert-warning">
                {{ $errors->first('email')}}
            </div>
        @endif
        @if ($errors->has('emailVerification'))
            <form method="POST" action="{{ route('user.resendVerification') }}">
                {{ csrf_field() }}
                <div class="alert alert-warning">
                    {{ $errors->first('emailVerification')}}<br /><br />
                    <input type="email" name="email" required class="form-control" placeholder="Email" /><br />
                    <button class="btn btn-primary">Resend Verification Email</button>
                </div>
            </form>
        @endif
        <form method="POST" action="{{ route('user.login') }}">
            {{ csrf_field() }}
            <input type="text" class="form-control" name="email" placeholder="Email Address" required="" autofocus="" style="margin-top:10px;margin-bottom:10px;" />
            <input type="password" class="form-control" name="password" placeholder="Password" required="" style="margin-top:10px;margin-bottom:10px;" />
            <label style="margin-left:0px;margin-top:10px;margin-bottom:10px;">
                <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
            </label>

            <a class="btn btn-link" href="{{ route('password.request') }}" style="float:right;">
                Forgot Your Password?
            </a>
            <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:10px;margin-bottom:10px;" >Login</button>
        </form>
    </div>
@endsection
