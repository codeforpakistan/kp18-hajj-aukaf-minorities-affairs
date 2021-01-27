<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ env("APP_NAME") }}</title>
        <link rel="icon" href="{{ asset('img/index.png') }}" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="{{ asset('css/font.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/icon.css') }}" rel="stylesheet" type="text/css">


        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
     
        <!-- Bootstrap Core Css -->
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

        <!-- Sweet Alert Css -->
        <link href="{{ asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

        <!-- Bootstrap Select Css -->
       <!-- <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />-->

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="{{ asset('css/themes/all-themes.css" rel="stylesheet') }}" />
        <style>
            .slimScrollBar{

                width:10px !important;
            }
            tr > th {
                padding-right: 0 !important;
            }

            .header_text{
                font-size: 25px;
                color:white;

            }
            .haj_div{
                padding: 15px 20px;
            }
            .haj_div > a:hover{
                color: white !important;
                text-decoration: none;
            }
            .haj_div > a:active{
                color: white !important;
                text-decoration: none;
            }
            .haj_div > a:visited{
                color: white !important;
                text-decoration: none;
            }
            .c_b{
                background-color: #607D8B;
                border: none;
                color: white;
                font-size: 12px;
                padding: 7px;
                margin-right: 5px;
                border-radius: 2px;
            }

            @media screen and (max-width: 768px) {
                .header_text{
                    font-size: 22px;
                }
                .navbar-header{
                    margin-bottom: unset !important;
                }
                .haj_div{
                    text-align: center;
                }
                .analysis{
                    margin-top: 125px !important;
                }
            }

            /* On screens that are 600px wide or less, the background color is olive */
            @media screen and (max-width: 500px) {
                .header_text{
                    font-size: 15px;

                }
                .navbar-header{
                    margin-bottom: unset !important;
                }
                .haj_div{
                    padding: 0;
                }
                .t_app{
                    border-bottom: 1px solid #ddd;
                    border-right: unset !important;
                }
                .analysis{
                    margin-top: 125px !important;
                }
            }


        </style>
    </head>
    @php
        $loguser = \Auth::user();
    @endphp
    <body class="theme-light-green">
        <!-- Page Loader -->
        <!--        <div class="page-loader-wrapper">
                    <div class="loader">
                        <div class="preloader">
                            <div class="spinner-layer pl-red">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                        <p>Please wait...</p>
                    </div>
                </div>-->
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        <!-- Search Bar -->
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>
        <!-- #END# Search Bar -->
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
                                li.new{
                                    margin-top:20px;
                                    margin-right: 17px;

                                    display:inline-block;
                                    color: white;

                                }
                                .myactive{
                                    color: #8BC34A !important;  
                                }
                                /*                        .table-responsive {
                                overflow-x: unset;
                                }*/
                            </style>

                            <ul class="nav navbar-nav navbar-right new">

                                <li class="new">
                                    <img  style="border-radius:50px;border:2px solid white; " data-close="true" src="{{ asset('img/applicants/' . $loguser->photo) }}" alt="user" width="35" height="35"/>
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

                                        <li><a href="admin/Users/password_change"><i class="material-icons">lock</i>Change Password</a></li>
                                        <li><a href="admin/Users/logout"><i class="material-icons">input</i>Sign Out</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </nav>
        <!-- #Top Bar -->

        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">


                <!-- Menu -->
                <div class="menu" style="margin-top:15px;">
                    <ul class="list">
                        <?php if ( \Auth::user()->hasRole('Operator')) { ?>
                            <li>
                                <?php
                                $app_arr = array('index', 'add', 'edit');
                                ?>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i class="material-icons">people</i>
                                    <span class="myactive">Applicants</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#indexApplicants">List Applicants</a></li>
                                    <li><a href="#newApplicants">New Applicants</a></li>
                                </ul>
                            </li>             
                        <?php } else { ?>
                            <li>
                                <a href="admin/Applicants/dashboard">
                                    <i class="material-icons">dashboard</i>
                                    <span class="myactive">Dashboard</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i> <img   src="{{ asset('img/category.svg') }}" alt=""  width="24px"/></i>
                                    <span class="myactive">Fund Categories</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#indexCategories">List Fund Categories</a></li>
                                    <li><a href="#newCategories">New Fund Categories</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i> 
                                        <img src="{{ asset('img/sub category.svg') }}" alt=""  width="24px"/>
                                    </i>
                                    <span class="myactive">Fund Sub Categories</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#indexsubCategory">List Fund Sub Categories</a></li>
                                    <li><a href="#newSubCategory">New Fund Sub Categories</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i> <img   src="{{ asset('img/funds.svg') }}" alt=""  width="24px"/></i>
                                    <span class="myactive">Funds</span>
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
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i> <img   src="{{ asset('img/reporting.svg') }}" alt=""  width="24px"/></i>
                                    <span class="myactive">Reporting section</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#reporting">General Reporting</a></li>
                                    @if (!empty($showlink))
                                        <li>
                                            <a href="javascript:void(0);" class="menu-toggle toggled">
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
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i class="material-icons">people</i>
                                    <span class="myactive">Applicants</span>

                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-applicants">List Applicants</a></li>
                                    <li><a href="#new-applicants">New Applicants</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i><img src="{{ asset('img/appliedinstitutues.svg') }}" alt="" width="24px"/></i>
                                    <span class="myactive">Applied Institutes</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle toggled">
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
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i><img src="{{ asset('img/grantsphase.svg') }}" alt="" width="24px"/></i>
                                    <span  class="{{ (request()->input('action') == 'distribution' || request()->input('action') == 'balloting' || request()->input('action') == 'distributegrants' || request()->input('action') == 'deselect') ? 'myactive' : '' }}">Selection phase</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle toggled">
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
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i class="material-icons">place</i>
                                    <span class="myactive">Districts</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-districts">List Districts</a></li>
                                    <li><a href="#new-districts">New Districts</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i><img src="{{ asset('img/religion.svg') }}" alt="" width="24px"/></i>
                                    <span class="myactive">Religions</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-religions">List Religions</a></li>
                                    <li><a href="#new-religions">New Religions</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i> <img src="{{ asset('img/institute type-07.svg') }}" alt="" width="24px"/>
                                    </i> <span class="myactive">Institutes Type</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-institutes-type">List Institutes Type</a></li>
                                    <li><a href="#new-institutes-type">New Institutes Type</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i><img src="{{ asset('img/institute type-07.svg') }}" alt="" width="24px"/>
                                    </i> <span class="myactive">School Classes</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-school-classes">List School Classes</a></li>
                                    <li><a href="#new-school-classes">New School Classes</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i class="material-icons">location_city</i>
                                    <span class="myactive">Institutes</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-institutes">List Institutes</a></li>
                                    <li><a href="#new-institutes">New Institutes</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i class="material-icons">school</i>
                                    <span class="myactive">Qualification Level</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-qualification-level">List Qualification Level</a></li>
                                    <li><a href="#new-qualification-level">New Qualification Level</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i class="material-icons">class</i>
                                    <span class="myactive">Disciplines</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-disciplines">List Disciplines</a></li>
                                    <li><a href="#new-disciplines">New Disciplines</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">

                                    <i> <img src="{{ asset('img/degree awarding.svg') }}" alt="" width="24px"/></i>
                                    <span class="myactive">Degree Awardings Boards</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-degree-awardings-boards">List Degree Awardings Boards</a></li>
                                    <li><a href="#new-degree-awardings-boards">New Degree Awardings Boards</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i class="material-icons">assignment</i>
                                    <span class="myactive">Marital Status</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-marital-status">List Marital Status</a></li>
                                    <li><a href="#new-marital-status">New Marital Status</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i class="material-icons">account_box</i>
                                    <span class="myactive">Users</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-users">List Users</a></li>
                                    <li><a href="#new-users">New Users</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle toggled">
                                    <i class="material-icons">timeline</i>
                                    <span class="myactive">Roles</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><a href="#list-Roles">List Roles</a></li>
                                    <li><a href="#new-Roles">New Roles</a></li>
                                </ul>
                            </li>
                        <?php } ?>
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
            <!-- Right Sidebar -->
            <aside id="rightsidebar" class="right-sidebar">
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                    <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                        <ul class="demo-choose-skin">
                            <li data-theme="red" class="active">
                                <div class="red"></div>
                                <span>Red</span>
                            </li>
                            <li data-theme="pink">
                                <div class="pink"></div>
                                <span>Pink</span>
                            </li>
                            <li data-theme="purple">
                                <div class="purple"></div>
                                <span>Purple</span>
                            </li>
                            <li data-theme="deep-purple">
                                <div class="deep-purple"></div>
                                <span>Deep Purple</span>
                            </li>
                            <li data-theme="indigo">
                                <div class="indigo"></div>
                                <span>Indigo</span>
                            </li>
                            <li data-theme="blue">
                                <div class="blue"></div>
                                <span>Blue</span>
                            </li>
                            <li data-theme="light-blue">
                                <div class="light-blue"></div>
                                <span>Light Blue</span>
                            </li>
                            <li data-theme="cyan">
                                <div class="cyan"></div>
                                <span>Cyan</span>
                            </li>
                            <li data-theme="teal">
                                <div class="teal"></div>
                                <span>Teal</span>
                            </li>
                            <li data-theme="green">
                                <div class="green"></div>
                                <span>Green</span>
                            </li>
                            <li data-theme="light-green">
                                <div class="light-green"></div>
                                <span>Light Green</span>
                            </li>
                            <li data-theme="lime">
                                <div class="lime"></div>
                                <span>Lime</span>
                            </li>
                            <li data-theme="yellow">
                                <div class="yellow"></div>
                                <span>Yellow</span>
                            </li>
                            <li data-theme="amber">
                                <div class="amber"></div>
                                <span>Amber</span>
                            </li>
                            <li data-theme="orange">
                                <div class="orange"></div>
                                <span>Orange</span>
                            </li>
                            <li data-theme="deep-orange">
                                <div class="deep-orange"></div>
                                <span>Deep Orange</span>
                            </li>
                            <li data-theme="brown">
                                <div class="brown"></div>
                                <span>Brown</span>
                            </li>
                            <li data-theme="grey">
                                <div class="grey"></div>
                                <span>Grey</span>
                            </li>
                            <li data-theme="blue-grey">
                                <div class="blue-grey"></div>
                                <span>Blue Grey</span>
                            </li>
                            <li data-theme="black">
                                <div class="black"></div>
                                <span>Black</span>
                            </li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="settings">
                        <div class="demo-settings">
                            <p>GENERAL SETTINGS</p>
                            <ul class="setting-list">
                                <li>
                                    <span>Report Panel Usage</span>
                                    <div class="switch">
                                        <label><input type="checkbox" checked><span class="lever"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <span>Email Redirect</span>
                                    <div class="switch">
                                        <label><input type="checkbox"><span class="lever"></span></label>
                                    </div>
                                </li>
                            </ul>
                            <p>SYSTEM SETTINGS</p>
                            <ul class="setting-list">
                                <li>
                                    <span>Notifications</span>
                                    <div class="switch">
                                        <label><input type="checkbox" checked><span class="lever"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <span>Auto Updates</span>
                                    <div class="switch">
                                        <label><input type="checkbox" checked><span class="lever"></span></label>
                                    </div>
                                </li>
                            </ul>
                            <p>ACCOUNT SETTINGS</p>
                            <ul class="setting-list">
                                <li>
                                    <span>Offline</span>
                                    <div class="switch">
                                        <label><input type="checkbox"><span class="lever"></span></label>
                                    </div>
                                </li>
                                <li>
                                    <span>Location Permission</span>
                                    <div class="switch">
                                        <label><input type="checkbox" checked><span class="lever"></span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- #END# Right Sidebar -->
        </section>


        {{-- <div class="col-lg-9" style=" float: right;  "><?= $this->Flash->render() ?></div> --}}
        @yield('content')


        <!-- Jquery Core Js -->
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery/jquery.min.js"></script>
        <script>
            $(function () {
                $("#checkall").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
                $('#selected_form').submit(function () {
                    var amount_to_dis = 0;
                    var checked = $("[id^='selected']:checked");
                    checked.each(function () {
                        amount_to_dis += +$(this).parent().siblings('td').children('input').val();
                    });
                    if (amount_to_dis > $('#amount_remaining').text()) {
                        alert("You Does not have sufficient balance in the Fund");
                        return false;
                    }
                    var all_checkboxes = $("input[id^='selected']").length;
                    if (all_checkboxes != 0) {
                        var checked = $("[id^='selected']:checked").length;
                        if (checked == 0) {
                            alert("Please select any applicant to submit the form");
                            return false;
                        }
                    }
                    return confirm('Are you sure you want to submit the form');
                });

            });
        </script>

        <script>
            function deselect(id) {
//                alert(id);return false;
                if ($('#deselect' + id).prop('checked')) {
                    var cheque_no = 1;
                } else {
                    var cheque_no = 0;
                }
                $.ajax({
                    type: "GET",
                    contentType: 'json',
                    url: "<?= $this->Url->build(['controller' => 'applicants', 'action' => 'services']) ?>",
                    data: "id=" + id + '&deselect=' + cheque_no,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data != 0) {
                            $('#deselect' + id).parent().parent().hide();
                            $('<div class="alert alert-success"><strong>Success!</strong> The Appliant hasbeen deselected</div>').insertBefore($('.table')).fadeIn(1500).fadeOut(2500);
                        }
                    }, error: function (error) {
                        alert(json.stringify(error));
                    }
                });

            }
            function update_cheque_no(id) {
                if ($('#cheque_no' + id).prop('checked')) {
                    var cheque_no = 1;
                } else {
                    var cheque_no = 0;
                }
                $.ajax({
                    type: "GET",
                    contentType: 'json',
                    url: "<?= $this->Url->build(['controller' => 'applicants', 'action' => 'services']) ?>",
                    data: "id=" + id + '&cheque_no=' + cheque_no,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data != 0) {
//                            $('#cheque_no' + id).parent().next('td').text(data);
                            if (cheque_no == 1) {
                                $('#cheque_no' + id).parent().next('td').text('distributed');
                            } else {
                                $('#cheque_no' + id).parent().next('td').text('');
                            }
                            $('<p style="color:green;">saved.</p>').insertAfter($('#cheque_no' + id).siblings('label')).fadeIn(1500).fadeOut(1500);
                        }
                    }, error: function (error) {
                        alert(json.stringify(error));
                    }
                });

            }
            function count_all() {
//                $('.hidden_selected');
                if ($("#checkall").prop('checked') == true) {
                    var total_amount = $('#amounttotal').text();
                    var checked_selected = $('input[id^=selected]').length;
                    var sum_amount = 0;
                    $('input[id^=amount_recived]').each(function () {
                        sum_amount += +$(this).val();
                    });
                    $('#distribute_amount').text(sum_amount);

//                    alert(sum_amount);
                    $('#total_applicants').text(checked_selected);
                    $('#perhead_amount').text('Amount Per Person: ' + $('#total_amount').val() / checked_selected);
                    $('input[type="hidden"].hidden_selected').each(function () {
                        $(this).val(($(this).attr('valueifselected')));
                    });
                } else {
                    var total_amount = 0;
                    $('#distribute_amount').text(total_amount);
                    $('#total_applicants').text('0');
                    $('#perhead_amount').text('0');
                    $('#perhead_amount').text('Amount Per Person: 0');
                    $('input[type="hidden"].hidden_selected').each(function () {
                        $(this).val(0);
                    });
                }
            }
            function count_checked(id) {
//                $("#selected" + id).val($("#selected" + id).prop('checked') ? id : 0);
                $("#selected" + id).siblings('input').val($("#selected" + id).prop('checked') ? id : 0);
                //                alert($("#selected" + id).val());
                if ($("#selected" + id).prop('checked') == true) {
                    var total_amount = +$('#amount_recived' + id).val() + +$('#distribute_amount').text();
                    $('#distribute_amount').text(total_amount);
                } else {
                    var total_amount = $('#distribute_amount').text() - $('#amount_recived' + id).val();
                    $('#distribute_amount').text(total_amount);
                }

                var checked_selected = $('input[id^=selected]:checked').length;
                if (checked_selected == 0) {
                    $('#total_applicants').text(checked_selected);
                    $('#perhead_amount').text('Amount Per Person: 0');

                } else {
                    $('#total_applicants').text(checked_selected);
                    $('#perhead_amount').text('Amount Per Person: ' + $('#total_amount').val() / checked_selected);
                }
            }
            function swap_fields(fund_id) {

                $.ajax({
                    type: "GET",
                    contentType: 'json',
                    url: "services",
                    data: "fund_subcategory=" + fund_id,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data == 3) {
                            $('#filter_div').find('input:text, select').val('');
                            $('#limit_div').attr('style', 'padding-left: 0;');

                            $('#merit_div').show();
                            $('#filter_div').hide();
                        } else {
                            $('#merit_div').find('input:text, select').val('');
                            $('#limit_div').attr('style', 'padding: 0px 20px 0px 10px !important;');
                            $('#filter_div').show();
                            $('#merit_div').hide();
                        }
                    }, error: function (error) {
                        alert(json.stringify(error));
                    }
                });

            }
            // function header() {
            //     var header_text = "List Of " + $("#applicant_status option:selected").text() + ' Applicants of ' + $("#fundlist option:selected").text() + " for year " + $("#fundyear option:selected").text();
            //     if ($('#city').val() != '') {
            //         header_text += ', District: ' + $("#city option:selected").text();
            //     }
            //     if ($('#religion').val() != '') {
            //         header_text += ', Religion: ' + $("#religion option:selected").text();
            //     }
            //     if ($('#cnic').val() != '') {
            //         header_text += ', CNIC: ' + $("#cnic").val();
            //     }
            //     return header_text;

            // }
            $(function () {
//                alert(header());
                $('#amount_recived').focus(function () {
                    $('#amountinaccount').removeAttr('style');
                });
                $('#amount_recived').change(function () {

                    if (+$(this).val() > +$('#amount_recived').attr('max')) {
                        $('#amount_recived').val('');
                        $('#amountinaccount').attr('style', 'color:red');
                        $('<p style="color:red;">Not enough amount in the account.</p>').insertAfter($('#amount_recived')).fadeIn(2500).fadeOut(2500);
                        return false;
                    }
                    $('#perhead_amount').text('Total: ' + $('#amount_recived').val() * $('#total_applicants').text());
                });

                $('#amount_for_all').change(function () {
                    var checked_selected = $('input[id^=amount_recived]');
                    checked_selected.each(function () {
                        $(this).val($('#amount_for_all').val());
                    })
                });


                $('#DataTables_Table_0_wrapper').attr('style', 'overflow:auto');
                if ($('#fund_id').val() != '') {
                    swap_fields($('#fund_id').val());
                }
                if ($('#total_applicants').text() != 0) {
                    $('#perhead_amount').text('Total: ' + $('#amount_recived').val() / $('#total_applicants').text());
                } else {
                    $('#perhead_amount').text('Total: 0');

                }
                $('#fund_id').change(function () {
                    var fund_id = $(this).val();
                    swap_fields(fund_id);

                });
            }
            );
        </script>

        <!-- Bootstrap Core Js -->
        <script src="<?php echo $this->request->webroot; ?>plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Select Plugin Js -->
        <!--<script src="<?php echo $this->request->webroot; ?>plugins/bootstrap-select/js/bootstrap-select."></script>-->

        <!-- Slimscroll Plugin Js -->
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Jquery Validation Plugin Css -->
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-validation/jquery.validate.js"></script>

        <!-- JQuery Steps Plugin Js -->
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-steps/jquery.steps.js"></script>

        <!-- Sweet Alert Plugin Js -->
        <script src="<?php echo $this->request->webroot; ?>plugins/sweetalert/sweetalert.min.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="<?php echo $this->request->webroot; ?>plugins/node-waves/waves.js"></script>

        <!-- Jquery DataTable Plugin Js -->
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

        <!-- Custom Js -->
        <script src="<?php echo $this->request->webroot; ?>js/admin.js"></script>
        <script src="<?php echo $this->request->webroot; ?>js/pages/tables/jquery-datatable.js"></script>
        <script src="<?php echo $this->request->webroot; ?>js/pages/forms/form-validation.js"></script>

        <!-- Demo Js -->
        <script src="<?php echo $this->request->webroot; ?>js/demo.js"></script>
        <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
        <script src="<?php echo $this->request->webroot; ?>js/jquery-ui.js"></script>
        <script>
            $(function () {
                $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>
        <?php
        if ($this->request->params['action'] == 'reporting') {
            ?>
            <script>
                $(function () {
                    $('<button type="button" class="c_b" data-toggle="modal" data-target="#myModal">Change PDF Header</button>').insertAfter($('#DataTables_Table_0_wrapper > .dt-buttons > .buttons-pdf'));
                });
            </script>
        <?php } ?>
    </body>

</html>

