@extends('..profiles.politician')

@section('politician-section')
<div class="contactInfo">
    @include('..partials.about-card', [ 'about' => $user->politiciansInfo->aboutme, 'user_id' => $user->id, 'politician_id' => $user->id ])
</div>
@endsection