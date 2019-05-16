@extends('..layouts.app')

@section('nav')
    @include('partials.nav')
@endsection

@section('content')

    <div class="container" style="background-color:white;">
        <h1>Edit Profile</h1>
        <hr>
        <div class="row">
            <!-- left column -->

            @if (Auth::user()->user_type == 4)
                <div class="col-md-12">
                    <div class="col-lg-7 col-sm-12 user_new">
                        <h3 style="text-align:left !important;color:black;margin-top:30px;">Profile images</h3>
                    </div>
                    <div class="text-center col-md-5 col-md-offset-1 col-sm-12" style="padding:10px;margin-bottom:5px;">
                        <img src="{{Auth::user()->profile_pic_path }}" id="previewing" class="avatar profile-pic" alt="avatar" style="width:150px;border-radius: 15%;">
                        <h6>Upload a new profile photo...</h6>



                        <form id="uploadimage" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" class="form-control" onchange="displayChosenImage(this, '.profile-pic', '#sbmitProfilePic')" name="file" id="file" required >
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <input type="submit" class="btn btn-primary" value="Upload" id="sbmitProfilePic" style="display: none" />
                        </form>
                        <h4 id='loading' style="display: none;">Saving profile image..</h4>
                        <div id="message"></div>

                    </div>
                    <div class="text-center col-md-5 col-sm-12" style="padding:10px;">
                        <img src="{{Auth::user()->background_pic_path }}" id="previewingBackgroundImg" class="avatar background-pic" alt="avatar" style="width:150px;border-radius: 15%;">
                        <h6>Upload a new background photo...</h6>



                        <form id="uploadbackgroundimage" action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" class="form-control" onchange="displayChosenImage(this, '.background-pic', '#sbmitBackgroundPic')" name="file" id="fileback" required >
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <input type="submit" class="btn btn-primary" value="Upload" id="sbmitBackgroundPic" style="display: none" />
                        </form>
                        <h4 id='loadingback' style="display: none;">Saving profile image..</h4>
                        <div id="messageback"></div>

                    </div>
                </div>
            @endif

            <!-- edit form column -->
            <div class="col-sm-12 personal-info" style="padding:10px;margin-bottom:5px;">
                <hr />
                @if(Auth::user()->user_type == 4 && Auth::user()->frozen == 1)
                    <div class="alert alert-danger alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">×</a>
                        Your profile is currently hidden and cannot be seen by others. Click <strong>Publish Profile</strong> to allow users to see it.
                    </div>
                @endif
                @if(session('saved'))
                    <div class="alert alert-success alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">×</a>
                        {{session('saved')}}
                    </div>
                @endif
                <div class="col-lg-12" style="margin-top:30px;">
                    <div class="col-lg-7 col-sm-12 user_new">
                        <h3 style="text-align:left !important;color:black;">Personal info</h3>
                    </div>

                    @if (Auth::user()->user_type == 4)
                        <form method="POST" action="{{ route('user.freezeprofile') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <input type="hidden" name="freeze" value="{{Auth::user()->frozen}}">
                            @if(Auth::user()->frozen == 1)
                                <div class="col-lg-5 col-sm-12">
                                    <input type="submit" value="Publish Profile" class="btn btn-success" style="float: right;">
                                </div>
                            @else
                                <div class="col-lg-5 col-sm-12">
                                    <input type="submit" value="Temporarily Hide Profile" class="btn btn-warning flt">
                                </div>
                            @endif
                        </form>
                    @endif
                </div>

                <form method="POST" class="user_form" action="{{ route('user.editprofile') }}">
                    {{ csrf_field() }}
                    <div class="col-lg-12" style="float:left">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">First name:</label>
                            <div class="col-lg-10 col-sm-12">
                                @if ($errors->has('firstname'))
                                    <div class="error">
                                        {{ $errors->first('firstname') }}
                                    </div>
                                @endif
                                <input class="form-control" name="firstname" type="text" value="{{Auth::user()['first_name']}}" style="margin-bottom: 15px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Last name:</label>
                            <div class="col-lg-10">
                                @if ($errors->has('lastname'))
                                    <div class="error">
                                        {{ $errors->first('lastname') }}
                                    </div>
                                @endif
                                <input class="form-control" name="lastname" type="text" value="{{Auth::user()->last_name}}" style="margin-bottom: 15px;">
                            </div>
                        </div>
                        @if (Auth::user()->user_type == 4)
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Party:</label>
                                <div class="col-lg-10">
                                    @if ($errors->has('party'))
                                        <div class="error">
                                            {{ $errors->first('party') }}
                                        </div>
                                    @endif
                                    <select name="party" class="form-control" style="margin-bottom: 15px;">
                                        <option value="" selected disabled hidden>Which party do you represent?</option>
                                        @foreach($parties as $party)
                                            <option value="{{ $party->id }}">{{ $party->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Are you an incumbent?</label>
                                <div class="col-lg-10">
                                    @if ($errors->has('party'))
                                        <div class="error">
                                            {{ $errors->first('party') }}
                                        </div>
                                    @endif
                                    <input type="checkbox" name="is_incumbent" class="form-control" style="margin-bottom: 15px;" {{ Auth::user()->politiciansInfo->is_incumbent ? 'checked' : '' }} />
                                </div>
                            </div>
                        @endif
                        @if(!in_array(Auth::user()->user_type, [4,5]))
                            <div class="form-group" style="padding-top:10px;">
                                <label class="col-lg-2 control-label">Address:</label>
                                <div class="col-lg-10">
                                    @if ($errors->has('address'))
                                        <div class="error">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                    <input class="form-control" name="address" type="text" value="{{Auth::user()->home_address}}" style="margin-bottom: 15px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Your ward:</label>
                                <div class="col-lg-10">
                                    @if ($errors->has('your_ward'))
                                        <div class="error">
                                            {{ $errors->first('your_ward') }}
                                        </div>
                                    @endif
                                    <select name="your_ward" id="your_ward" class="form-control" style="margin-top:10px;margin-bottom:15px;">
                                        <option value="" selected disabled hidden>What is your residential ward?</option>
                                        @foreach($wards as $ward)
                                            <option value="{{ $ward->id }}" {{ $ward->id == Auth::user()['ward_id'] ? 'selected' : '' }}>{{ $ward->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        @if(!in_array(Auth::user()->user_type, [4,5]))
                            <div class="form-group">
                                <label class="col-md-2 control-label">Username:</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="username" type="text" value="{{Auth::user()->user_name}}" style="margin-bottom: 15px;">
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->user_type == 4)
                            <div class="form-group">
                                <label class="col-md-2 control-label">Facebook link:</label>
                                <div class="col-md-10">
                                    @if ($errors->has('facebook'))
                                        <div class="error">
                                            {{ $errors->first('facebook') }}
                                        </div>
                                    @endif
                                    <input class="form-control" name="facebook" type="text" value="{{Auth::user()->contactInfo()->first() ? Auth::user()->contactInfo()->first()->fb_link : ''}}" style="margin-bottom: 15px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Twitter link:</label>
                                <div class="col-md-10">
                                    @if ($errors->has('twitter'))
                                        <div class="error">
                                            {{ $errors->first('twitter') }}
                                        </div>
                                    @endif
                                    <input class="form-control" name="twitter" type="text" value="{{Auth::user()->contactInfo()->first() ? Auth::user()->contactInfo()->first()->twitter_link : ''}}" style="margin-bottom: 15px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Other link:</label>
                                <div class="col-md-10">
                                    @if ($errors->has('other'))
                                        <div class="error">
                                            {{ $errors->first('other') }}
                                        </div>
                                    @endif
                                    <input class="form-control" name="other" type="text" value="{{Auth::user()->contactInfo()->first() ? Auth::user()->contactInfo()->first()->other_link : ''}}" style="margin-bottom: 15px;">
                                </div>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12" style="padding:10px;margin-bottom:5px;margin-top:30px;">
                @if (Auth::user()->user_type == 4)
                    <div class="col-lg-7 col-sm-12 user_new">
                        <h3 style="text-align:left !important;color:black;">Profile Information</h3>
                    </div>
                    <form method="POST" id="political-profile-form" action="{{ route('user.editPoliticianProfile') }}">
                        {{ csrf_field() }}
                        <input type="hidden" required name="experience" class="hidden-aboutme">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" required class="hidden-stance" name="stance">
                        <div class="col-lg-12" style="float:left">
                            @foreach (Auth::user()->politiciansInfo->stances as $stance)
                                <input class="form-control" required name="stance_title" placeholder="Title for your 'Projects & Stances' article" value="{{ $stance->title }}" />
                            @endforeach
                            <div class="form-group" style="display: grid;">
                                <div>
                                    <h3>Stances</h3>
                                    @if ($errors->has('stance'))
                                        <div class="error">
                                            {{ $errors->first('stance') }}
                                        </div>
                                    @endif
                                    @foreach (Auth::user()->politiciansInfo->stances as $stance)
                                        <textarea class="form-control" id="stance">
                                            {!! $stance->content !!}
                                        </textarea>
                                    @endforeach
                                </div>
                            </div>
                            <input class="form-control" required name="experience_title" placeholder="Title for you 'Experience' article" value="{{ Auth::user()->aboutme_title }}" />
                            <div class="form-group" style="display: grid;">
                                <div class="">
                                    <h3>About me</h3>
                                    @if ($errors->has('aboutme'))
                                        <div class="error">
                                            {{ $errors->first('aboutme') }}
                                        </div>
                                    @endif
                                    <textarea class="form-control" id="aboutmeeditor">
                                        {!! Auth::user()->politiciansInfo->aboutme !!}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </form>

                    <button type="submit" form="political-profile-form" style="float:left;margin:10px;" id="aboutmeSaveButton" class="btn btn-primary" onclick="savePoliProfileToHidden()">
                        Save
                    </button>
                @endif
            </div>
        </div>
    </div>
    <hr>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=6o3xulqc8cbdoqi7663fl6um5lthy3xcr53w8bw3ivfzf1fj"></script>
<script>
    function displayChosenImage(fileInput, imageClass, saveButtonClass) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();

            fileReader.onload = function (e) {
                $(imageClass).attr('src', e.target.result);

                // show save button
                $(saveButtonClass).show();
                // if ($('#profilePicUploadBtn').style.display == 'none') {
                //     $('#profilePicUploadBtn').toggle();
                // }
            };

            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }
    $(document).ready(function (e) {
        //************************************** Profile image update *************************************//
        $("#uploadimage").on('submit',(function(e) {
            e.preventDefault();
            $("#message").empty();
            $('#loading').show();
            $.ajax({
                url: "upload_profile_pic.php", // Url to which the request is send
                method: "POST",             // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data)   // A function to be called if request succeeds
                {
                    $('#loading').hide();
                    $("#message").html(data);
                    $("#sbmitProfilePic").hide();
                }
            });


            $.ajax({
                url: "{{route('user.updateProfilePicture')}}", // Url to which the request is send
                method: "POST",             // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data)   // A function to be called if request succeeds
                {
                    $('#loading').hide();
                    $("#sbmitProfilePic").hide();
                }
            });
        }));

// Function to preview image after validation
        $(function() {
            $("#file").change(function() {
                $("#message").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $("#message").html("<div class=\"alert alert-danger alert-dismissable\"> \
                <a class=\"panel-close close\" data-dismiss=\"alert\">×</a> \
                    Only .jpeg, .jpg, and .png allowed \
                </div>");
                    $("#sbmitProfilePic").hide();
                    $('#loading').hide();
                    return false;
                }
                else
                {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
        function imageIsLoaded(e) {
            $("#file").css("color","green");
            $('#image_preview').css("display", "block");
        };


        //************************************** Background image update *************************************//
        $("#uploadbackgroundimage").on('submit',(function(e) {
            e.preventDefault();
            $("#messageback").empty();
            $('#loadingback').show();
            $.ajax({
                url: "upload_background_pic.php", // Url to which the request is send
                method: "POST",             // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data)   // A function to be called if request succeeds
                {
                    $('#loadingback').hide();
                    $("#messageback").html(data);
                    $("#sbmitBackgroundPic").hide();
                }
            });


            $.ajax({
                url: "{{route('user.updateBackgroundPicture')}}", // Url to which the request is send
                method: "POST",             // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data)   // A function to be called if request succeeds
                {
                    $('#loadingback').hide();
                    $("#sbmitBackgroundPic").hide();
                }
            });
        }));

// Function to preview image after validation
        $(function() {
            $("#fileback").change(function() {
                $("#messageback").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $("#messageback").html("<div class=\"alert alert-danger alert-dismissable\"> \
                <a class=\"panel-close close\" data-dismiss=\"alert\">×</a> \
                    Only .jpeg, .jpg, and .png allowed \
                </div>");
                    $("#sbmitBackgroundPic").hide();
                    $('#loadingback').hide();
                    return false;
                }
                else
                {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
        function imageIsLoaded(e) {
            $("#fileback").css("color","green");
            $('#image_preview_background').css("display", "block");
        };
    });

    tinymce.init({
        selector: '#stance',
        height: 200,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css']
    });
    tinymce.init({
        selector: '#aboutmeeditor',
        height: 200,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css']
    });


</script>