<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- Menu -->
    <div class="menu" style="margin-top:15px;">
        <ul class="list">
            @if ( \Auth::user()->hasRole('Operator'))
                <li>
                    @php
                        $app_arr = array('index', 'add', 'edit');
                    @endphp
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i class="material-icons">people</i>
                        <span class="{{-- myactive --}}">Applicants</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#indexApplicants">List Applicants</a></li>
                        <li><a href="#newApplicants">New Applicants</a></li>
                    </ul>
                </li>           
            @else
                <li>
                    <a href="{{ route('admin.dashboard.index') }}">
                        <i class="material-icons">dashboard</i>
                        <span class="@if($routeController == 'dashboard') myactive @endif">Dashboard</span>
                    </a>
                </li>
                @foreach($navigationLinks as $navigationLink)
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle @if($navigationLink->controller == $routeController) toggled @endif">
                            @if(@$navigationLink->icon)
                                <i class="material-icons">{{ $navigationLink->icon }}</i>
                            @elseif(@$navigationLink->imageIcon)
                                <img src="{{ asset($navigationLink->imageIcon) }}" width="24px">
                            @endif
                            <span class="@if($navigationLink->controller == $routeController) myactive @endif">{{ $navigationLink->name }}</span>
                        </a>
                        <ul class="ml-menu">
                            @foreach($navigationLink->subNav as $subNavLink)
                                {{-- @dd(Route::has('admin.' . 'applied-institutes' . '.' . $subNavLink->action)) --}}
                                @if($subNavLink->action == 'funds')
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle @if($navigationLink->controller == $routeController) toggled @endif" style="padding-left: 50px !important;">
                                            <span>Funds</span>
                                        </a>
                                        <ul class="ml-menu">
                                            @foreach ($eduFunds as $key => $eduFund)
                                                <li><a href="{{ route('admin.' . $navigationLink->controller . '.' . $subNavLink->action, [$eduFund->id])}}">{{ $eduFund->fund_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @elseif($subNavLink->action == 'selection')
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle @if($navigationLink->controller == $routeController) toggled @endif" style="padding-left: 50px !important;">
                                            <span>{{ $subNavLink->name }}</span>
                                        </a>
                                        <ul class="ml-menu">
                                            @foreach($subNavLink->subNav as $subSubNavLink)
                                                <li><a class="{{ $navigationLink->controller == $routeController && $routeAction == $subSubNavLink->action ? 'myactive' : '' }}" href="{{ Route::has('admin.' . $navigationLink->controller . '.' . $subSubNavLink->action) ? route('admin.' . $navigationLink->controller . '.'  . $subSubNavLink->action) : '#' }}">{{ $subSubNavLink->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ Route::has('admin.' . $navigationLink->controller . '.' . $subNavLink->action) ? route('admin.' . $navigationLink->controller . '.' . $subNavLink->action) : '#' }}" class="@if($navigationLink->controller == $routeController && $routeAction == $subNavLink->action) myactive @endif">{{ $subNavLink->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; <?= date('Y') ?>  <a href="javascript:void(0);">Admin Minorites Department</a>.
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->