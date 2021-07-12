<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars hidden-md" style="display: none;"></a>
            <a class="navbar-brand d-flex" href="index.html">
                <img class="img img-responsive hidden-sm hidden-xs" src="{{ asset('img/logo2.png') }}" alt="LOGO" />
                <div>{{env('APP_NAME')}}</div>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav navbar-right">
                <!-- Tasks -->
                <li class="dropdown pull-right">
                    <a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center" data-toggle="dropdown" role="button">
                        {{  auth()->user()->name }} <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.users.change.password') }}"><i class="material-icons">lock</i>Change Password</a></li>
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
</nav>