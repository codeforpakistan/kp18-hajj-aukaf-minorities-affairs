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
                    <a href="admin/Applicants/dashboard">
                        <i class="material-icons">dashboard</i>
                        <span class="myactive">Dashboard</span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i> <img   src="{{ asset('img/category.svg') }}" alt=""  width="24px"/></i>
                        <span class="{{-- myactive --}}">Fund Categories</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#indexCategories">List Fund Categories</a></li>
                        <li><a href="#newCategories">New Fund Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i> 
                            <img src="{{ asset('img/sub category.svg') }}" alt=""  width="24px"/>
                        </i>
                        <span class="{{-- myactive --}}">Fund Sub Categories</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#indexsubCategory">List Fund Sub Categories</a></li>
                        <li><a href="#newSubCategory">New Fund Sub Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i> <img   src="{{ asset('img/funds.svg') }}" alt=""  width="24px"/></i>
                        <span class="{{-- myactive --}}">Funds</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#indexFund">List Funds</a></li>
                        <li><a href="#newFund">New Funds</a></li>
                    </ul>
                </li>
                <li>
                    <?php
                    $report_array = array('reporting', 'region', 'institute_reporting', 'institute_classes', 'institutes', 'datereporting');
                    $inst_report_array = array('institute_reporting', 'institute_classes', 'institutes');
                    
                    ?>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i> <img   src="{{ asset('img/reporting.svg') }}" alt=""  width="24px"/></i>
                        <span class="{{-- myactive --}}">Reporting section</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#reporting">General Reporting</a></li>
                        @if (!empty($showlink))
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                                    <span>Institute Reporting</span>
                                </a>
                                <ul class="ml-menu" style="padding-left: 20px;">
                                    <li><a href="#institutes">Institutes</a></li>
                                    <li><a href="#institute-classes">Institute classes</a></li>
                                    <li><a href="#institute-students">Institute students</a></li>
                                </ul>
                            </li>
                        @endif
                        <li><a href="#region-religion-reporting">Region/Religion Reporting</a></li>
                        <li><a href="#date-wise-summary">Date wise summary</a></li>
                    </ul>
                </li>
                <li>
                    @php
                        $app_arr = array('index', 'add');
                    @endphp 
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i class="material-icons">people</i>
                        <span class="{{-- myactive --}}">Applicants</span>

                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-applicants">List Applicants</a></li>
                        <li><a href="#new-applicants">New Applicants</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i><img src="{{ asset('img/appliedinstitutues.svg') }}" alt="" width="24px"/></i>
                        <span class="{{-- myactive --}}">Applied Institutes</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                                <span>Funds</span>
                            </a>
                            <ul class="ml-menu">
                                @foreach ($edu_funds as $key => $edu_fund)
                                    <li><a href="#{{ strtolower($edu_fund) }}">$edu_fund</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i><img src="{{ asset('img/grantsphase.svg') }}" alt="" width="24px"/></i>
                        <span  class="{{ (request()->input('action') == 'distribution' || request()->input('action') == 'balloting' || request()->input('action') == 'distributegrants' || request()->input('action') == 'deselect') ? '{{-- myactive --}}' : '' }}">Selection phase</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                                <span>Selection</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="#poverty-base">Poverty base</a></li>
                                <li><a href="#balloting-system">Balloting system</a></li>
                            </ul>
                        </li>
                        <li>
                            <a style="padding-left: 62px;" href="#admin/Applicants/deselect">De-select</a>
                        </li>
                        <li>
                            <a style="padding-left: 62px;" href="#admin/Applicants/distributegrants">Distribution</a>
                        </li>                                   
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i class="material-icons">place</i>
                        <span class="{{-- myactive --}}">Districts</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-districts">List Districts</a></li>
                        <li><a href="#new-districts">New Districts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i><img src="{{ asset('img/religion.svg') }}" alt="" width="24px"/></i>
                        <span class="{{-- myactive --}}">Religions</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-religions">List Religions</a></li>
                        <li><a href="#new-religions">New Religions</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i> <img src="{{ asset('img/institute type-07.svg') }}" alt="" width="24px"/>
                        </i> <span class="{{-- myactive --}}">Institutes Type</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-institutes-type">List Institutes Type</a></li>
                        <li><a href="#new-institutes-type">New Institutes Type</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i><img src="{{ asset('img/institute type-07.svg') }}" alt="" width="24px"/>
                        </i> <span class="{{-- myactive --}}">School Classes</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-school-classes">List School Classes</a></li>
                        <li><a href="#new-school-classes">New School Classes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i class="material-icons">location_city</i>
                        <span class="{{-- myactive --}}">Institutes</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-institutes">List Institutes</a></li>
                        <li><a href="#new-institutes">New Institutes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i class="material-icons">school</i>
                        <span class="{{-- myactive --}}">Qualification Level</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-qualification-level">List Qualification Level</a></li>
                        <li><a href="#new-qualification-level">New Qualification Level</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i class="material-icons">class</i>
                        <span class="{{-- myactive --}}">Disciplines</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-disciplines">List Disciplines</a></li>
                        <li><a href="#new-disciplines">New Disciplines</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">

                        <i> <img src="{{ asset('img/degree awarding.svg') }}" alt="" width="24px"/></i>
                        <span class="{{-- myactive --}}">Degree Awardings Boards</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-degree-awardings-boards">List Degree Awardings Boards</a></li>
                        <li><a href="#new-degree-awardings-boards">New Degree Awardings Boards</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i class="material-icons">assignment</i>
                        <span class="{{-- myactive --}}">Marital Status</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-marital-status">List Marital Status</a></li>
                        <li><a href="#new-marital-status">New Marital Status</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i class="material-icons">account_box</i>
                        <span class="{{-- myactive --}}">Users</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-users">List Users</a></li>
                        <li><a href="#new-users">New Users</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle {{-- toggled --}}">
                        <i class="material-icons">timeline</i>
                        <span class="{{-- myactive --}}">Roles</span>
                    </a>
                    <ul class="ml-menu">
                        <li><a href="#list-Roles">List Roles</a></li>
                        <li><a href="#new-Roles">New Roles</a></li>
                    </ul>
                </li>
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