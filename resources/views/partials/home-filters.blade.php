
<div class="container">
    <center>
        <div style="display:grid;margin:10px;background-color:white;border:1px solid #bdb9b9;padding: 20px;border-radius: 10px;padding-bottom: 50px;">
            <h2>Welcome to Capslok!<img src="{{ url('/images/jetslogo.png') }}" style="width:50px;float:right" /></h2>
            <div>

            </div>
            <hr />
            <div class="col-md-12 mr" style="margin-bottom:0px;margin-top:0px;">
                <form method="GET" action="{{ route('searchby.homeaddress') }}" class="col-md-4 col-xs-12 first_search" style="float:left;">
                    <label for="address">Search for candidates by address:</label>
                    <div class="form-inline" style="margin:10px;">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Home address">
                        <button class="btn btn-primary btn_home">
                            Search
                        </button>
                        @if (session()->has('notfoundaddress'))
                            <div class="alert alert-danger" style="margin-top:10px;">
                                {{session('notfoundaddress')}}
                            </div>
                        @endif
                    </div>
                </form>
                <div class="col-md-4 col-xs-12 second_search">
                    <label>Find your representatives from the Ward Map:</label><br />
                    <button class="btn btn-primary btn-lg btn_home1" onclick="removeClass('closed')">
                        Wardmap
                    </button>
                    @if (isset($data['notfoundward']))
                        <div class="alert alert-danger" style="margin-top:10px;">
                            {{$data['notfoundward']}}
                        </div>
                    @endif
                </div>
                <form method="GET" action="{{ route('user.whereDoIVote') }}" class="col-md-4 col-xs-12 first_search" style="float:left;">
                    <label for="address">Where do I vote?:</label>
                    <div class="form-inline" style="margin:10px;">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Home address">
                        <button class="btn btn-primary btn_home">
                            Search
                        </button>
                        @if (session()->has('notfoundvoteaddress'))
                            <div class="alert alert-danger" style="margin-top:10px;">
                                {{session('notfoundvoteaddress')}}
                            </div>
                        @endif
                    </div>
                </form>
            </div>
            @if (isset($data['hideViewAllButton']))
                <a style="padding:4px;" class="btn btn-primary col-md-2" href="{{ route('home.allPoliticiansInfoView') }}">
                    See all politicians
                </a>
            @endif
        </div>
    </center>
</div>

@if(session()->has('electionDay'))

    <div class="container">
        <center>
            <div style="text-align:left;display:grid;margin:10px;background-color:white;border:1px solid #f1f1f1;padding:10px;border-radius:0px;">
                <h4>Your voting locations</h4>
                <h5>Election day location:</h5>
                <div>
                    Location: {{session('electionDay')['facility']}} <br />
                    Address: {{session('electionDay')['address']}} <br />
                    Distance: {{session('electionDay')['distance']}} km <br />
                    Date: {{session('electionDay')['day']}} from {{session('electionDay')['start_time']}} to {{session('electionDay')['end_time']}} <br />
                </div>
                <button class="btn btn-default col-md-2 col-sm-6" onclick="showAdvance()" style="margin-top: 20px;">Show advance locations</button>
                <div style="display: none;margin-top:20px;" class="col-md-12" id="advancePolls">
                    @foreach(session('advancePolls') as $adv)
                        {{--<div class="col-lg-4 col-md-6 col-md-12" style="float:left;padding:0px;border:1px solid lightgrey;">--}}
                            <div class="col-lg-4 col-md-6 col-sm-12" style="border:1px solid #f1f1f1;padding:0px;margin-top:10px;border-radius:0px;">
                             
                                <div class="card-header" style="background: lightsteelblue; padding: 5px;margin-bottom: 12px;">
                                    <h5 style="height:8px;">{{$adv['facility']}}</h5>
                                    <div class="card-info">
                                        <i>{{$adv['address']}}</i>
                                    </div>
                                </div>
                                <div class="card-body">
                                 <div class="card-text">
                                        <div class="col-md-3">
                                            Distance:<br />
                                            Dates:<br />
                                        </div>
                                        <div class="col-md-9">
                                            {{$adv['distance']}} km <br />
                                            @for ($i = 0; $i < count($adv['start_time']); $i++)
                                                {{$adv['day'][$i]}} from {{$adv['start_time'][$i]}} to {{$adv['end_time'][$i]}} <br />
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                            </div>
                        {{--</div>--}}
                    @endforeach
                </div>
            </div>
        </center>
    </div>
@endif

<script>
    function showAdvance() {
        $('#advancePolls').toggle();
    }
</script>