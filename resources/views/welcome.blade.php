
@extends('layouts.app')

@section('nav')
    @include('partials.nav')
@endsection

@section('content')

@include('partials.home-filters')

<div class="pop-up closed" id="wardmap">
    <div class="pop-up-content">
        <div class="close-button" onclick="addClassTo('pop-up', 'closed');">
            <i class="fas fa-times"></i>
        </div>
        <div class="title" style="padding:15px;">Choose Your Ward:</div>
        <div class="content" style="height:100%">

            <iframe src="https://www.google.com/maps/d/embed?mid={{$data['map_url']}}" style="width:100%;height:100%;"></iframe>
        </div>
    </div>
</div>



<div class="modal hide pop-up" id="requestPostalcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-top:10%">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h2 class="modal-title" id="exampleModalLabel">Welcome to CAPSLOK!</h2>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/postalCodeSubmission">
                {{ csrf_field() }}
                <div class="modal-body" style="margin-top:20px;">
                    Please enter your residential address and we will provide you with your relevant elections and candidates.<br /><br />
                    <input type="text" id="postalcode" name="postalcode" placeholder="Address" class="form-control" >
                </div>
                <div class="modal-footer" style="margin-top:20px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closePostalModal()">Continue without address</button>
                    <button type="submit" class="btn btn-primary" onclick="storePostalCode()">Search by address</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">

    @php
        $politician_info_city = $data['politicianInfo'];
        $profile_type = $data['profile_types'][0];

        $title = $profile_type->type;
        $politicians_info = $politician_info_city['city'];
        $id = 1;
    @endphp

    <div class="container">
        @include('partials/politician-card-row')

        

    @php
        $profile_type = $data['profile_types'][1];

        $title = $profile_type->type;
        $politicians_info = $politician_info_city['municipal'];
        $id = 2;
    @endphp

    <div class="container">
        @include('partials/politician-card-row')
    </div>

    @php
        $profile_type = $data['profile_types'][2];

        $title = $profile_type->type." - Comming soon";
        $politicians_info = $politician_info_city['provincial'];
        $id = 3;
    @endphp

    <div class="container" style="opacity:0.5;pointer-events: none;">
        @include('partials/politician-card-row')
    </div>

    @php
        $profile_type = $data['profile_types'][3];

        $title = $profile_type->type." - Comming soon";
        $politicians_info = $politician_info_city['federal'];
        $id = 4;
    @endphp

    <div class="container" style="opacity:0.5;pointer-events: none;">
        @include('partials/politician-card-row')
    </div>

</div>




<script>
    // function ready() {
    //     if(localStorage.getItem('capslok.postalcode') == null) {
    //         $('#requestPostalcode').removeClass('hide');
    //         $('#requestPostalcode').addClass('show');
    //     }
    // }
    //
    // document.addEventListener("DOMContentLoaded", ready);
    //
    // function storePostalCode() {
    //     let postalcode = document.getElementById("postalcode");
    //     localStorage.setItem('capslok.postalcode', postalcode.value);
    // }
    //
    // function closePostalModal() {
    //     $('#requestPostalcode').removeClass('show');
    //     $('#requestPostalcode').addClass('hide');
    //     localStorage.setItem('capslok.postalcode', '');
    // }
</script>



<script>
            // $(document).ready(function() {
              $('.owl-carousel').owlCarousel({
                loop: true,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: true
                  },
                  1000: {
                    items: 4,
                    nav: true,
                    loop: false
                  }
                }
              });
            // })
          </script>

@endsection

@section('script')
    
@endsection
