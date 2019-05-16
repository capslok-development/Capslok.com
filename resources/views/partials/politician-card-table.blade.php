@php
$i = 0;
$index = 0;
$adIndex = 0;
@endphp

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


<div class="politician-card-table">

    <header style="display:grid;margin:10px;padding:10px;border-radius:0px;margin-bottom: 30px;">
        @if (isset($address)) <h3>{{ $address }}</h3> @endif
        <h3 style="color:#337ab7;">City: {{$politicians_info[0]->city}}</h3>
        @if (isset($ward)) <h3 style="color:#337ab7">Ward: {{$ward}}</h3> @endif
    </header>

    <div class="content content1">
    @while($i < count($politicians_info))
        @php
            $info = $politicians_info[$i];
        @endphp

        @include('partials/politician-card')

        @php
            $index++;
            $i++;
            $adIndex++;
        @endphp
    @endwhile
    </div>
</div>
