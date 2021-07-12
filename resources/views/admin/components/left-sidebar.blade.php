<aside id="leftsidebar" class="sidebar">
            <!-- #User Info -->
            <!-- Menu -->
    <div class="menu">
        <div class="scroller" style="position: relative; overflow: auto; width: auto; height: 100%;">
            <ul class="list">
            {{-- <li class="header">MAIN NAVIGATION</li> --}}
            @if(auth()->user()->hasRole('Operator') || auth()->user()->hasRole('Admin'))
                <li>
                    <a href="{{ route('admin.dashboard.index') }}">
                        <i class="material-icons">dashboard</i>
                        <span class="@if($routeController == 'dashboard') myactive @endif">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.fund-categories.index') }}">
                        <i class="material-icons">category</i>
                        <span class="{{@$mItem['active']}}">Fund Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.sub-categories.index') }}">
                        <i class="material-icons">category</i>
                        <span>Fund Sub Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.funds.index') }}">
                        <img src="{{ asset('img/funds.svg') }}" width="24px">
                        <span>Funds</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <img src="{{ asset('img/reporting.svg') }}" width="24px">
                        <span>Reports</span>
                        <i class="arrow-down"></i>
                    </a>
                    <ul class="ml-menu">
                        <?php $list = [
                            'general-report' => 'General Reports',
                            'region-religion-report' => 'Region/Religion Rport',
                            'date-wise-summary' => 'Date wise summary',
                            'institutes-report' => 'Institutes Report',
                            'institutes-classes-report' => 'Institutes Classes Report',
                            'institutes-students-report' => 'Institutes Students Report',
                        ] ?>
                        @foreach($list as $routee => $itemName)
                            <li>
                                <a href="{{route('admin.reports.'.$routee)}}">{{ $itemName }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.applicants.index') }}">
                        <img src="{{ asset('img/funds.svg') }}" width="24px">
                        <span>Applicants</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <img src="{{ asset('img/reporting.svg') }}" width="24px">
                        <span>Applied Institutes</span>
                        <i class="arrow-down"></i>
                    </a>
                    <ul class="ml-menu">
                        @foreach ($eduFunds as $key => $eduFund)
                            <li>
                                <a href="{{route('admin.applied-institutes.funds',[$eduFund->id])}}">{{ $eduFund->fund_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <img src="{{ asset('img/reporting.svg') }}" width="24px">
                        <span>Selection phase</span>
                        <i class="arrow-down"></i>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span class="span _level_1">Selection</span>
                                <i class="arrow-down _level_1"></i>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="{{route('admin.selection-phase.poverty-based')}}">Poverty based</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.selection-phase.balloting')}}">Balloting system</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('admin.selection-phase.de-select')}}">De-select</a>
                        </li>
                        <li>
                            <a href="{{route('admin.selection-phase.distribution')}}">Distribution</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.districts.index') }}">
                        <i class="material-icons">place</i>
                        <span>Districts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.religions.index') }}">
                        <img src="{{ asset('/img/religion.svg') }}" width="24px">
                        <span>Religions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.institute-types.index') }}">
                        <img src="{{ asset('/img/institute type-07.svg') }}" width="24px">
                        <span>Institute Types</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.school-classes.index') }}">
                        <img src="{{ asset('/img/institute type-07.svg') }}" width="24px">
                        <span>School Classes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.institutes.index') }}">
                        <i class="material-icons">location_city</i>
                        <span>Institutes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.qualification-levels.index') }}">
                        <i class="material-icons">school</i>
                        <span>Qualification Levels</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.disciplines.index') }}">
                        <i class="material-icons">class</i>
                        <span>Disciplines</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.degree-awarding-boards.index') }}">
                        <img src="{{ asset('img/degree awarding.svg') }}" width="24px">
                        <span>Degree Awarding Boards</span>
                    </a>
                </li>
            <li>
                <a href="{{ route('admin.marital-statuses.index') }}">
                    <i class="material-icons">assignment</i>
                    <span>Marital Statuses</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->hasRole('Admin'))
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <i class="material-icons">account_box</i>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.roles.index') }}">
                        <i class="material-icons">timeline</i>
                        <span>Roles</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; {{date('Y')}} <a href="javascript:void(0);">Admin Minorites Department</a>.
        </div>
    </div>
    <!-- #Footer -->
</aside>