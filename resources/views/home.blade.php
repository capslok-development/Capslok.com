@extends('layouts.app')

@section('nav')
    @include('partials.nav')
@endsection

@section('content')

@switch (Auth::user()->user_type)
    @case(3)
        {{-- Admin --}}
        @include('admin.all-users')
        @break

    @case(4)
    @case(5)
        {{-- Politician --}}
        @include('edit.politician-profile')
        @break

    @default
        {{-- Other users --}}
        @include('edit.user-profile')

@endswitch

@endsection
