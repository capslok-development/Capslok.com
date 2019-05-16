  <nav class="navbar navbar-default navbar-static-top" style="background-color: ghostwhite;">
        <div class="container" style="display:block;">
            <div class="navbar-header" style="padding-top:5px;">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->

                <a href="{{ url('/') }}" style="margin:5px 15px;" id="home-default">
                    <img src="{{ url('/images/logocapslok.png') }}" width="200" height="30" class="d-inline-block align-top" alt="">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black;">
                                Services <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/services/capsfeed">CAPSFeed</a>
                                </li>
                                <li>
                                    <a href="/services/capsinsight">CAPSInsight</a>
                                </li>
                                <li>
                                    <a href="/services/capsread">CAPSRead</a>
                                </li>
                            </ul>
                    </li>                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black;">
                            Purpose <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/purpose/representatives">Representatives</a>
                            </li>
                            <li>
                                <a href="/purpose/voters">Voters</a>
                            </li>
                            <li>
                                <a href="/purpose/elections">Elections</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black;">
                            Information <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/info/representatives">Representatives</a>
                            </li>
                            <li>
                                <a href="/info/voters">Voters</a>
                            </li>
                            <li>
                                <a href="/info/elections">Elections</a>
                            </li>
                            <li>
                                <a href="/info/privacy">Privacy Policy</a>
                            </li>                            
                            <li class="divider"></li>
                            <li>
                                <a href="/info/votinginfo">Voting information</a>
                            </li>
                        </ul>
                    </li>


                @guest
                        <li><a href="{{ route('login') }}" style="color:black;">Login</a></li>
                        <li><a href="{{ route('register') }}" style="color:black;">Register</a></li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        @if (Auth::user()->user_type == 3)
                            <li>
                                <a href="{{route('admin.updateCandidates')}}">Update Candidates</a>
                            </li>
                            <li>
                                <a href="{{route('admin.userlisting')}}">Users</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('user.getEditUserProfile')}}">Account</a>
                        </li>
                        <li>
                            <a onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

  <script>

    function updateHomeLink() {
        if(localStorage.getItem('capslok.postalcode') !== null && localStorage.getItem('capslok.postalcode') !== '') {
            $('#home-default').attr("href", "/home?postalcode="+localStorage.getItem('capslok.postalcode'));
        }
    }

    document.addEventListener("DOMContentLoaded", updateHomeLink);
  </script>
