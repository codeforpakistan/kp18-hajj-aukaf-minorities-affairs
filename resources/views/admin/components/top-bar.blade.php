<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header col-lg-12" style="float:unset !important;">
            <div class="col-lg-2 hidden-md hidden-sm hidden-xs" style="padding:0px">
                <img class="img img-responsive" src="{{ asset('img/logo2.png') }}" alt="LOGO"  height="60"/>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 haj_div">
                <a href="" class="header_text" >{{ env('APP_NAME') }}</a>
            </div>
            <div class="col-sm-6 col-xs-6 hidden-lg hidden-md" style="padding:0px">
                <a href="javascript:void(0);" class="bars"></a>
            </div>
            <div class="col-sm-6 col-xs-6 hidden-lg hidden-md" style="padding: 9px 0 0 0;">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            </div>

            <div class="col-lg-4 col-md-4">

                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <style> 
                        li.new{ margin-top:20px; margin-right: 17px; display:inline-block; color: white;}
                        .myactive{
                            color: #8BC34A !important;  
                        }
                        /*                        .table-responsive {
                        overflow-x: unset;
                        }*/
                    </style>

                    <ul class="nav navbar-nav navbar-right new">

                        <li class="new">
                            @if(file_exists(public_path('img/applicants/' . $loguser->photo)))
                                <img  style="border-radius:50px;border:2px solid white; " data-close="true" src="{{ asset('img/applicants/' . $loguser->photo) }}" alt="user" width="35" height="35"/>
                            @else
                                <img  style="border-radius:50px;border:2px solid white; " data-close="true" src="{{ asset('img/applicants/upload.png') }}" alt="user" width="35" height="35"/>
                            @endif
                        </li>

                        <li class="new" style="margin-top:27px;">
                            <?php
                            if (!empty($loguser)) {
                                echo $loguser->name;
                            }
                            ?>
                        </li>
                        <!-- #END# Call Search -->
                        <!-- Notifications -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                <i class="material-icons">keyboard_arrow_down</i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="material-icons">lock</i>Change Password</a></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="
                                        event.preventDefault();
                                        document.getElementById('logout-form').submit();
                                    ">
                                        <i class="material-icons">input</i>{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- #Top Bar -->