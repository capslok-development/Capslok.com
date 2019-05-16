@extends('..layouts.app')

@section('content')

<div class="container">
    @for(; $numRows > 0; $numRows--)
        @include('..partials.politician-card-row')
    @endfor
</div>

@endsection

