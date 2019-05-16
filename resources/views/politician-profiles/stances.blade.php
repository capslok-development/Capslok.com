@extends('..profiles.politician')

@section('politician-section')

<div class="stances">
    @foreach ($user->politiciansInfo->stances as $stance)
        @include('..partials.text-card', [ 'stance' => $stance, 'politician_id' => $user->id ])
    @endforeach
</div>
@endsection