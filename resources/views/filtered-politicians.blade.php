
@extends('layouts.app')

@section('nav')
    @include('partials.nav')
@endsection

@section('content')

    @include('partials.home-filters')

    @php
        if(!empty($data['title'])) {
            $title = $data['title'];
        }
        $politicians_info = $data['politicians'];

        if(!empty($data['ward'])) {
            $ward = $data['ward'];
        }
    @endphp

    <div class="container">
        @include('partials/politician-card-table')
    </div>

@endsection