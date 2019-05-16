@extends('..layouts.app')

@section('nav')
    @include('partials.nav')
@endsection

@section('content')
    <div class="container">
        <div class="col-lg-12" style="border: 1px solid lightgrey;padding: 15px;background-color: white;margin-top: 40px;border-radius:10px;display: block;">
            <h3 style="color:black;float:left;">Update Candidates</h3><br /><br />
            <h5 style="color:red;float:left;">IMPORTANT: This form will update the ward map and structure of the incumbents and non-incumbents. Make sure to download a backup before you
            upload a new file. Any uploads overwrite previous uploads.</h5><br /><br /><hr /><br />


            @if (isset($step1))
                <div class="alert alert-success">
                    Step 1: {{ $step1 }}
                </div>
            @endif
            @if (isset($step3))
                <div class="alert alert-success">
                    Step 3: {{ $step3 }}
                </div>
            @endif
            @if (isset($step4))
                <div class="alert alert-success">
                    Step 4: {{ $step4 }}
                </div>
            @endif
            @if (isset($step6))
                <div class="alert alert-success">
                    Step 6: {{ $step6 }}
                </div>
            @endif

            <table class="table-responsive table-striped table-bordered" style="width:100%;">

                <tr><td style="padding:25px;">
                        <div class="card">
                            <div class="card-header">
                                Step 1
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Upload Candidates</h5>
                                <p class="card-text">Uploads candidate list and creates user accounts for them.</p>
                                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.addPoliticiansWithTypeFromJsonFile') }}">
                                    {{ csrf_field() }}

                                    <label class="form-control" style="margin-top:10px;">
                                        <input type="file" required accept=".json" name="json_file" />
                                    </label>
                                    <button class="btn btn-danger" type="submit" style="margin-top:10px;">Upload Candidate List</button>
                                </form>
                            </div>
                        </div>
                    </td></tr>

                <tr><td style="padding:25px;">
                        <div class="card">
                            <div class="card-header">
                                Step 2 (KML)
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Download Backup</h5>
                                <p class="card-text">Download the current KML file for backup.</p>
                                <form method="GET" action="{{ route('admin.downloadKMLFile') }}">
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger" type="submit" style="margin-top:10px;">Download Latest KML File</button>
                                </form>
                            </div>
                        </div>
                    </td></tr>

                <tr><td style="padding:15px;">
                    <div class="card">
                        <div class="card-header">
                            Step 3 (KML)
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Update KML File</h5>
                            <p class="card-text">Upload the latest KML file containing candidates and their wards here.</p>
                            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.processNewCandidates') }}">
                                {{ csrf_field() }}

                                <label class="form-control" style="margin-top:10px;">
                                    <input type="file" required accept=".kml" name="kml_file" />
                                </label>
                                <button class="btn btn-danger" type="submit" style="margin-top:10px;">Upload and Update Candidates</button>
                            </form>
                        </div>
                    </div>
                </td></tr>

                <tr><td style="padding:15px;">
                    <div class="card">
                        <div class="card-header">
                            Step 4 (KML)
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Update KML File</h5>
                            <p class="card-text">After you have uploaded the latest KML file, you need to run updates to format and populate it with Capslok data.</p>
                            <form method="POST" action="{{ route('admin.updateMap') }}">
                                {{ csrf_field() }}
                                    <button class="btn btn-danger" type="submit" style="margin-top:10px;">Update KML File</button>
                            </form>
                        </div>
                    </div>
                </td></tr>

                <tr><td style="padding:15px;">
                    <div class="card">
                        <div class="card-header">
                            Step 5 (KML)
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Download New KML File</h5>
                            <p class="card-text">Download the latest KML file (after you uploaded and processed a new on) and upload the processed KML file to GoogleMaps.</p>
                            <form method="GET" action="{{ route('admin.downloadKMLFile') }}">
                                {{ csrf_field() }}
                                <button class="btn btn-danger" type="submit" style="margin-top:10px;">Download Latest KML File</button>
                            </form>
                        </div>
                    </div>
                </td></tr>

                <tr><td style="padding:15px;">
                    <div class="card">
                        <div class="card-header">
                            Step 6 (Link)
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Share Iframe link to map</h5>
                            <p class="card-text">After uploading the new KML file to google maps, copy the url from GoogleMaps (copy everythin that comes after
                                'https://www.google.com/maps/d/u/1/edit?mid='. Make sure to set the zoom level to 10 - the last parameter should be 'z=10'.</p>
                            <form method="POST" action="{{ route('admin.updateMapURL') }}">
                                {{ csrf_field() }}
                                <input type="text" class="form-control" required name="map_url" placeholder="Iframe url to the new GoogleMaps instance" style="margin-bottom:10px;" />
                                <button class="btn btn-danger" type="submit" style="margin-top:10px;">Upload link</button>
                            </form>
                        </div>
                    </div>
                </td></tr>
            </table>
        </div>
    </div>
@endsection
