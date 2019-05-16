<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="height=device-height, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Capslok') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{--     <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}

      <link rel="stylesheet" href="{{ url('/plugins/owl/assets/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('/plugins/owl/assets/owlcarousel/assets/owl.theme.default.min.css') }}">

    <!-- Font Awesome -->
    <script defer src="{{ asset('js/fontawesome-all.js') }}"></script>
     <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
     <script src="{{ url('/plugins/owl/assets/vendors/jquery.min.js') }}"></script>
    <script src="{{ url('/plugins/owl/assets/owlcarousel/owl.carousel.js') }}"></script>
     {{-- <script src="{{ asset('js/rl-carousel.js') }}"></script> --}}


    @yield('styles')

</head>
<body>
    <div id="app">
        @yield('nav')

        @yield('content')
    </div>

   
   
    <script src="{{ asset('js/sticky-navbar.js') }}"></script>

    @yield('script')
</body>
</html>
