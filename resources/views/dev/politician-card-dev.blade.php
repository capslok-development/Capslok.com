@extends('..layouts.app')

@section('content')

<div class="container">
    @if (!isset($component_type) || $component_type == NULL)
        @include('..partials.politician-card')
    @else
        @include("..partials.$component_type")
    @endif
</div>

@endsection