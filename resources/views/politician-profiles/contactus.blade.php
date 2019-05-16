@extends('..profiles.politician')

@section('politician-section')
<div class="contactInfo">
    @include('..partials.contactme-card', [ 'contactInfo' => $user->politiciansInfo->contactme])
</div>
@endsection