
    <div class="card" style="width:300px;text-align: center;padding-bottom:10px;border-radius:20px 20px 0px 0px;border:3px solid white;background-color:#337ab7;">
        <a href="{{ url('/profile/'.$info->user->id) }}">
            <div class="card-header" style="position: relative;overflow: hidden;height: 180px;width: 294px;padding: 0px;border-radius:20px 20px 0px 0px;">
                <img class="" src="{{url('/').'/'.$info->user->background_pic_path}}" style="position: relative;width: 293px !important;height: 190px;display: inline-block;-webkit-filter: blur(7px); /* Safari 6.0 - 9.0 */
    filter: blur(7px);">
                <img class="card-img-top profile-pic-container" src="{{url('/').'/'.$info->user->profile_pic_path}}" style="position: absolute;top: 8%;left: 26%;">
            </div>
            <div class="card-body" style="background-color: white;margin: 1px;padding-top: 14px;padding-bottom: 8px;">
                <h5 class="card-title">{{ $info->user->first_name }} {{ $info->user->last_name }}</h5>
                <p class="card-text">
                    {{ $info->city }}<br />
                    {{ $info->province }}<br />
                    {{ $info->getProfileName() }}<br />
                </p>
            </div>
        </a>
        <div class="card-footer" style="padding-top:10px;height:45px;">
            <div class="text-muted" style="color:white;">
                @if ($info->user->contactInfo)
                    @if ($info->user->contactInfo->fb_link)
                        <a href="{{$info->user->contactInfo->fb_link}}" target="_blank" rel="noopener noreferrer" style="margin-left:20px;margin-right:20px;font-size:10px;color:#fff;"><i class="fab fa-facebook-f fa-3x"></i></a>
                    @endif
                    @if ($info->user->contactInfo->twitter_link)
                        <a href="{{$info->user->contactInfo->twitter_link}}" target="_blank" rel="noopener noreferrer" style="margin-left:20px;margin-right:20px;font-size:10px;color:#fff;"><i class="fab fa-twitter fa-3x"></i></a>
                    @endif
                    @if ($info->user->contactInfo->other_link)
                        <a href="{{$info->user->contactInfo->other_link}}" target="_blank" rel="noopener noreferrer" style="margin-left:20px;margin-right:20px;font-size:10px;color:#fff;"><i class="fab fa-instagram fa-3x"></i></a>
                    @endif

                @endif
            </div>
        </div>
    </div>