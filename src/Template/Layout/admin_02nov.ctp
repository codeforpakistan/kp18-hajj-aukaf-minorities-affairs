<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Auqaf, hajj, Religious & Minority Affairs</title>
        <link rel="icon" href="<?php echo $this->request->webroot; ?>img/index.png" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="<?php echo $this->request->webroot; ?>css/font.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo $this->request->webroot; ?>css/icon.css" rel="stylesheet" type="text/css">


        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
     
        <!-- Bootstrap Core Css -->
        <link href="<?php echo $this->request->webroot; ?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="<?php echo $this->request->webroot; ?>plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="<?php echo $this->request->webroot; ?>plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Sweet Alert Css -->
        <link href="<?php echo $this->request->webroot; ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="<?php echo $this->request->webroot; ?>css/style.css" rel="stylesheet">
        <!-- JQuery DataTable Css -->
        <link href="<?php echo $this->request->webroot; ?>plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- Bootstrap Select Css -->
       <!-- <link href="<?php echo $this->request->webroot; ?>plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="<?php echo $this->request->webroot; ?>css/themes/all-themes.css" rel="stylesheet" />
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
    <?php
    $loguser = $this->Session->read('Auth.User');
    ?>
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
                        <img class="img img-responsive" src="<?php echo $this->request->webroot . 'img/logo2.png'; ?>" alt="LOGO"  height="60"/>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 haj_div">
                        <a href="" class="header_text" >Hajj, Auqaf, Minorities and Religious Affairs</a>
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
                                    <img  style="border-radius:50px;border:2px solid white; " data-close="true" src="<?php echo $this->request->webroot . 'img/applicants/' . $loguser['photo']; ?>" alt="user" width="35" height="35"/>
                                </li>

                                <li class="new" style="margin-top:27px;">
                                    <?php
                                    if (!empty($loguser)) {
                                        echo $loguser['name'];
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

                                        <li><a href="<?= $this->request->webroot . 'admin/Users/password_change'; ?>"><i class="material-icons">lock</i>Change Password</a></li>
                                        <li><a href='<?= $this->request->webroot . 'admin/Users/logout'; ?>'><i class="material-icons">input</i>Sign Out</a></li>

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
                        <?php if ($auth->user('role_id') == 2) { ?>
                            <li>
                                <?php
                                $app_arr = array('index', 'add', 'edit');
                                ?>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Applicants' && in_array($this->request->params['action'], $app_arr)) ? 'toggled' : ''; ?>">
                                    <i class="material-icons">people</i>
                                    <span class="<?= ($this->request->params['controller'] == 'Applicants' && in_array($this->request->params['action'], $app_arr)) ? 'myactive' : ''; ?>">Applicants</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Applicants'), '/', ['target' => '_blank']) ?></li>
                                </ul>
                            </li>             
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo $this->request->webroot . 'admin/Applicants/dashboard'; ?>">
                                    <i class="material-icons">dashboard</i>
                                    <span class="<?= ($this->request->params['action'] == 'dashboard') ? 'myactive' : ''; ?>">Dashboard</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'FundCategories') ? 'toggled' : ''; ?>">
                                    <i> <img   src="<?php echo $this->request->webroot . 'img/category.svg'; ?>" alt=""  width="24px"/></i>
                                    <span class="<?= ($this->request->params['controller'] == 'FundCategories') ? 'myactive' : ''; ?>">Fund Categories</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Fund Categories'), ['controller' => 'fund_categories', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Fund Categories'), ['controller' => 'fund_categories', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'SubCategories') ? 'toggled' : ''; ?>">
                                    <i> 
                                        <img   src="<?php echo $this->request->webroot . 'img/sub category.svg'; ?>" alt=""  width="24px"/>
                                    </i>
                                    <span class="<?= ($this->request->params['controller'] == 'SubCategories') ? 'myactive' : ''; ?>">Fund Sub Categories</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Fund Sub Categories'), ['controller' => 'sub_categories', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Fund Sub Categories'), ['controller' => 'sub_categories', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Funds') ? 'toggled' : ''; ?>">
                                    <i> <img   src="<?php echo $this->request->webroot . 'img/funds.svg'; ?>" alt=""  width="24px"/></i>

                                    <span class="<?= ($this->request->params['controller'] == 'Funds') ? 'myactive' : ''; ?>">Funds</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Funds'), ['controller' => 'funds', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Funds'), ['controller' => 'funds', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <?php
                                $report_array = array('reporting', 'region', 'institute_reporting', 'institute_classes', 'institutes');
                                $inst_report_array = array('institute_reporting', 'institute_classes', 'institutes');
                                ?>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['action'] == 'region' || in_array($this->request->params['action'], $report_array) == 'reporting') ? 'toggled' : ''; ?>">
                                    <i> <img   src="<?php echo $this->request->webroot . 'img/reporting.svg'; ?>" alt=""  width="24px"/></i>
                                    <span class="<?= ($this->request->params['action'] == 'region' || in_array($this->request->params['action'], $report_array) == 'reporting') ? 'myactive' : ''; ?>">Reporting section</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('General Reporting'), ['controller' => 'Applicants', 'action' => 'reporting']) ?></li>
                                    <?php
                                    if (!empty($showlink)) {
                                        ?>
                                        <li>
                                            <a href="javascript:void(0);" class="menu-toggle <?= (in_array($this->request->params['action'], $inst_report_array)) ? 'toggled' : ''; ?>">
                                                <span>Institute Reporting</span>
                                            </a>
                                            <ul class="ml-menu" style="padding-left: 20px;">
                                                <?= $this->Html->link(__('Institutes'), ['controller' => 'Applicants', 'action' => 'institutes']) ?>
                                                <?= $this->Html->link(__('Institute classes'), ['controller' => 'Applicants', 'action' => 'institute_classes']) ?>
                                                <?= $this->Html->link(__('Institute students'), ['controller' => 'Applicants', 'action' => 'institute_reporting']) ?>

                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li><?= $this->Html->link(__('Region/Religion wise'), ['controller' => 'Applicants', 'action' => 'region']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <?php
                                $app_arr = array('index', 'add');
                                ?>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Applicants' && in_array($this->request->params['action'], $app_arr)) ? 'toggled' : ''; ?>">
                                    <i class="material-icons">people</i>
                                    <span class="<?= ($this->request->params['controller'] == 'Applicants' && in_array($this->request->params['action'], $app_arr)) ? 'myactive' : ''; ?>">Applicants</span>

                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Applicants'), '/', ['target' => '_blank']) ?></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Institutes' && $this->request->params['action'] == 'institutes') ? 'toggled' : ''; ?>">
                                    <i> 
                                        <img   src="<?php echo $this->request->webroot . 'img/appliedinstitutues.svg'; ?>" alt=""  width="24px"/>
                                    </i>
                                    <span class="<?= ($this->request->params['controller'] == 'Institutes' && $this->request->params['action'] == 'institutes') ? 'myactive' : ''; ?>">Applied Institutes</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle toggled">
                                            <span>Funds</span>
                                        </a>

                                        <ul class="ml-menu">
                                            <?php foreach ($edu_funds as $key => $edu_fund): ?>
                                                <li><?= $this->Html->link($edu_fund, ['controller' => 'Institutes', 'action' => 'institutes', $key]) ?></li>
                                            <?php endforeach; ?>
                                            <!--<li>< $this->Html->link(__('Institues'), ['controller' => 'Institutes', 'action' => 'institutes']) ?></li>-->
                                            <!--<li>< $this->Html->link(__('Applicants'), ['controller' => 'Applicants', 'action' => 'index']) ?></li>-->
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['action'] == 'distribution' || $this->request->params['action'] == 'balloting' || $this->request->params['action'] == 'distributegrants') ? 'toggled' : ''; ?>">
                                    <i> 
                                        <img   src="<?php echo $this->request->webroot . 'img/grantsphase.svg'; ?>" alt=""  width="24px"/>
                                    </i>
                                    <span  class="<?= ($this->request->params['action'] == 'distribution' || $this->request->params['action'] == 'balloting' || $this->request->params['action'] == 'distributegrants') ? 'myactive' : ''; ?>">Grant's Distribution phase</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['action'] == 'distribution' || $this->request->params['action'] == 'balloting') ? 'toggled' : ''; ?>">
                                            <span>Selection</span>
                                        </a>
                                        <ul class="ml-menu">
                                            <li><?= $this->Html->link(__('Poverty base'), ['controller' => 'Applicants', 'action' => 'distribution']) ?></li>
                                            <li><?= $this->Html->link(__('Balloting system'), ['controller' => 'Applicants', 'action' => 'balloting']) ?></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a style="padding-left: 62px;" href="<?php echo $this->request->webroot; ?>admin/Applicants/distributegrants">Distribution</a>
                                    </li>
                                    <!--                                <li>
                                                                        <a href="javascript:void(0);" class="menu-toggle">
                                                                            <span>Distribute</span>
                                                                        </a>
                                                                        <ul class="ml-menu">
                                                                            <li>
                                                                                <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>-->
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Cities') ? 'toggled' : ''; ?>">
                                    <i class="material-icons">place</i>
                                    <span class="<?= ($this->request->params['controller'] == 'Cities') ? 'myactive' : ''; ?>">Districts</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Districts'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Districts'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Religions') ? 'toggled' : ''; ?>">
                                    <i> <img   src="<?php echo $this->request->webroot . 'img/religion.svg'; ?>" alt=""  width="24px"/>
                                    </i>
                                    <span class="<?= ($this->request->params['controller'] == 'Religions') ? 'myactive' : ''; ?>">Religions</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Religions'), ['controller' => 'Religions', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Religions'), ['controller' => 'Religions', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'InstituteTypes') ? 'toggled' : ''; ?>">
                                    <i> <img   src="<?php echo $this->request->webroot . 'img/institute type-07.svg'; ?>" alt=""  width="24px"/>
                                    </i> <span class="<?= ($this->request->params['controller'] == 'InstituteTypes') ? 'myactive' : ''; ?>">Institutes Type</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Institutes Type'), ['controller' => 'InstituteTypes', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Institutes Type'), ['controller' => 'InstituteTypes', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'SchoolClasses') ? 'toggled' : ''; ?>">
                                    <i> <img   src="<?php echo $this->request->webroot . 'img/institute type-07.svg'; ?>" alt=""  width="24px"/>
                                    </i> <span class="<?= ($this->request->params['controller'] == 'SchoolClasses') ? 'myactive' : ''; ?>">School Classes</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List School Classes'), ['controller' => 'school_classes', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New School Classes'), ['controller' => 'school_classes', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Institutes') ? 'toggled' : ''; ?>">
                                    <i class="material-icons">location_city</i>
                                    <span class="<?= ($this->request->params['controller'] == 'Institutes') ? 'myactive' : ''; ?>">Institutes</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Institutes'), ['controller' => 'Institutes', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Institutes'), ['controller' => 'Institutes', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'QualificationLevels') ? 'toggled' : ''; ?>">
                                    <i class="material-icons">school</i>
                                    <span class="<?= ($this->request->params['controller'] == 'QualificationLevels') ? 'myactive' : ''; ?>">Qualification Level</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Qualification Level'), ['controller' => 'QualificationLevels', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Qualification Level'), ['controller' => 'QualificationLevels', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Disciplines') ? 'toggled' : ''; ?>">
                                    <i class="material-icons">class</i>
                                    <span class="<?= ($this->request->params['controller'] == 'Disciplines') ? 'myactive' : ''; ?>">Disciplines</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Disciplines'), ['controller' => 'Disciplines', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Disciplines'), ['controller' => 'Disciplines', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'DegreeAwardings') ? 'toggled' : ''; ?>">

                                    <i> <img   src="<?php echo $this->request->webroot . 'img/degree awarding.svg'; ?>" alt=""  width="24px"/></i>
                                    <span class="<?= ($this->request->params['controller'] == 'DegreeAwardings') ? 'myactive' : ''; ?>">Degree Awardings Boards</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Degree Awardings Boards'), ['controller' => 'DegreeAwardings', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Degree Awardings Boards'), ['controller' => 'DegreeAwardings', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Maritalstatus') ? 'toggled' : ''; ?>">
                                    <i class="material-icons">assignment</i>
                                    <span class="<?= ($this->request->params['controller'] == 'Maritalstatus') ? 'myactive' : ''; ?>">Marital Status</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Marital Status'), ['controller' => 'maritalstatus', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Marital Status'), ['controller' => 'maritalstatus', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Users') ? 'toggled' : ''; ?>">
                                    <i class="material-icons">account_box</i>
                                    <span class="<?= ($this->request->params['controller'] == 'Users') ? 'myactive' : ''; ?>">Users</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Users'), ['controller' => 'Users', 'action' => 'add']) ?></li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle <?= ($this->request->params['controller'] == 'Roles') ? 'toggled' : ''; ?>">
                                    <i class="material-icons">timeline</i>
                                    <span class="<?= ($this->request->params['controller'] == 'Roles') ? 'myactive' : ''; ?>">Roles</span>
                                </a>
                                <ul class="ml-menu">
                                    <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
                                    <li><?= $this->Html->link(__('New Roles'), ['controller' => 'Roles', 'action' => 'add']) ?></li>

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
                    <!--                    <div class="version">
                                            <b>Version: </b> 1
                                        </div>-->
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


        <div class="col-lg-9" style=" float: right;  "><?= $this->Flash->render() ?></div>

        <?= $this->fetch('content') ?>


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
            function update_cheque_no(id) {
                var cheque_no = $('#cheque_no' + id).val();
                $.ajax({
                    type: "GET",
                    contentType: 'json',
                    url: "<?= $this->Url->build(['controller' => 'applicants', 'action' => 'services']) ?>",
                    data: "id=" + id + '&cheque_no=' + cheque_no,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data != 0) {
//                            $('#cheque_no' + id).parent().next('td').text(data);
                            $('#cheque_no' + id).parent().next('td').text('distributed');
                            $('<p style="color:green;">saved.</p>').insertAfter($('#cheque_no' + id)).fadeIn(1500).fadeOut(1500);
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

                    $('#perhead_amount').text('Amount Per Person: ' + $('#total_amount').val() / $('#total_applicants').text());
                } else {
                    $('#perhead_amount').text('Amount Per Person: 0');

                }
                $('#total_amount').change(function () {
                    $('#perhead_amount').text('Amount Per Person: ' + $('#total_amount').val() / $('#total_applicants').text());
                });
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
    </body>

</html>

