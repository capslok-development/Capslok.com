@php
$i = 0;
$index = 0;
$adIndex = 0;
$counter = 0;
$needsClosing = false;
@endphp



<div{{--  class="politician-card-row" --}} {{-- style="overflow: hidden;" --}}>

    @if (isset($title))
        <header style="display:grid;margin:10px;padding:20px;border-radius:0px;margin-bottom: 30px;font-family:Lato, sans-serif;font-size: 3rem;font-weight: 300;color: #424242;">
            <center><a href="{{ url('type/'.$id) }}"><h3 style="color:#337ab7;"><b>{{ $title }}</b></h3></a></center>
        </header>
    @endif
<div class="container">
    <div class="row">
        <div class="large-12 columns">
          <div class="owl-carousel owl-theme">
              @while($i < count($politicians_info))
            @php
                $info = $politicians_info[$i];
            @endphp

            @if ($info->user && $info->user->frozen == 0)
            <div class="item">
                @include('partials/politician-card')
            </div>
            @endif

            @php
                $index++;
                $i++;
                $adIndex++;
            @endphp
        @endwhile
            
          </div>
      </div>
    </div>
</div>

    {{-- <div class="content" style="overflow: scroll;">
        @while($i < count($politicians_info))
            @php
                $info = $politicians_info[$i];
            @endphp

            @if ($info->user && $info->user->frozen == 0)
                @include('../partials/politician-card')
            @endif

            @php
                $index++;
                $i++;
                $adIndex++;
            @endphp
        @endwhile
    </div> --}}
</div>
{{-- <div class="carousel-container">
		<div class="carousel">
			<div class="roll">
				<div class="slides">
					<img src="https://unsplash.it/640/426/?random" alt="slides img 1">
					<ul class="info">
                      <li><a href="#">Mohammad Lee</a></li>
                      <li><a href="#">Edmonton</a></li>
                      <li><a href="#">AB</a></li>
                      <li><a href="#">City Council</a></li>
                    </ul>
                    <ul class="social_list">
                     <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
				</div>
				<div class="slides">
					<img src="https://unsplash.it/640/425/?random" alt="slides img 2">
					<ul class="info">
                      <li><a href="#">Mohammad Lee</a></li>
                      <li><a href="#">Edmonton</a></li>
                      <li><a href="#">AB</a></li>
                      <li><a href="#">City Council</a></li>
                    </ul>
                    <ul class="social_list">
                     <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
				</div>
				<div class="slides">
					<img src="https://unsplash.it/640/424/?random" alt="slides img 3">
					<ul class="info">
                      <li><a href="#">Mohammad Lee</a></li>
                      <li><a href="#">Edmonton</a></li>
                      <li><a href="#">AB</a></li>
                      <li><a href="#">City Council</a></li>
                    </ul>
                    <ul class="social_list">
                     <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
				</div>
				<div class="slides">
					<img src="https://unsplash.it/640/423/?random" alt="slides img 4">
					<ul class="info">
                      <li><a href="#">Mohammad Lee</a></li>
                      <li><a href="#">Edmonton</a></li>
                      <li><a href="#">AB</a></li>
                      <li><a href="#">City Council</a></li>
                    </ul>
                    <ul class="social_list">
                     <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
				</div>
				<div class="slides">
					<img src="https://unsplash.it/640/422/?random" alt="slides img 5">
					<ul class="info">
                      <li><a href="#">Mohammad Lee</a></li>
                      <li><a href="#">Edmonton</a></li>
                      <li><a href="#">AB</a></li>
                      <li><a href="#">City Council</a></li>
                    </ul>
                    <ul class="social_list">
                     <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
				</div>
				<div class="slides">
					<img src="https://unsplash.it/640/421/?random" alt="slides img 6">
					<ul class="info">
                      <li><a href="#">Mohammad Lee</a></li>
                      <li><a href="#">Edmonton</a></li>
                      <li><a href="#">AB</a></li>
                      <li><a href="#">City Council</a></li>
                    </ul>
                    <ul class="social_list">
                     <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
				</div>
				<div class="slides">
					<img src="https://unsplash.it/640/420/?random" alt="slides img 7">
					<ul class="info">
                      <li><a href="#">Mohammad Lee</a></li>
                      <li><a href="#">Edmonton</a></li>
                      <li><a href="#">AB</a></li>
                      <li><a href="#">City Council</a></li>
                    </ul>
                    <ul class="social_list">
                     <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
				</div>
				<div class="slides">
					<img src="https://unsplash.it/640/419/?random" alt="slides img 8">
					<ul class="info">
                      <li><a href="#">Mohammad Lee</a></li>
                      <li><a href="#">Edmonton</a></li>
                      <li><a href="#">AB</a></li>
                      <li><a href="#">City Council</a></li>
                    </ul>
                    <ul class="social_list">
                     <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
				</div>
				<div class="slides">
					<img src="https://unsplash.it/640/418/?random" alt="slides img 9">
					<ul class="info">
                      <li><a href="#">Mohammad Lee</a></li>
                      <li><a href="#">Edmonton</a></li>
                      <li><a href="#">AB</a></li>
                      <li><a href="#">City Council</a></li>
                    </ul>
                    <ul class="social_list">
                     <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
				</div>
			</div>
			<div class="sections">
			</div>
			<button class="navigation" id="nav-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
			<button class="navigation" id="nav-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
		</div>
	</div> --}}
<!-- Load scripts -->
