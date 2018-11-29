
<!-- Header -->
<header class="header navbar navbar-fixed-top" role="banner">
    <!-- Top Navigation Bar -->
    <div class="container">

        <!-- Only visible on smartphones, menu toggle -->
        <ul class="nav navbar-nav">
            <li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
        </ul>

        <!-- Logo -->
        <a class="navbar-brand" href="index.html">
            <img src="<?php echo $this->request->webroot ?>assets/img/logo.png" alt="logo" />
            <strong>ME</strong>LON
        </a>
        <!-- /logo -->

        <!-- Sidebar Toggler -->
        <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
            <i class="icon-reorder"></i>
        </a>
        <!-- /Sidebar Toggler -->

        <!-- Top Left Menu -->
        <!--        <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
                    <li>
                        <a href="#">
                            Dashboard
                        </a>
                    </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Dropdown
                                        <i class="icon-caret-down small"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-user"></i> Example #1</a></li>
                                        <li><a href="#"><i class="icon-calendar"></i> Example #2</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><i class="icon-tasks"></i> Example #3</a></li>
                                    </ul>
                                </li>
                </ul>-->
        <!-- /Top Left Menu -->

        <!-- Top Right Menu -->
        <ul class="nav navbar-nav navbar-right">
            <!-- User Login Dropdown -->
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
                    <i class="icon-male"></i>
                    <span class="username"><?= isset($user_name['name']) ? ucwords($user_name['name']) : $user_name; ?></span>
                    <i class="icon-caret-down small"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="icon-dashboard"></i> Dashboard</a></li>

                    <li class="divider"></li>
                    <li><a href="<?php echo $this->request->webroot . 'Applicants/profile' ?>"><i class="icon-user"></i> My Profile</a></li>
                    <!--<li><a href="pages_calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>-->
                    <!--<li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>-->
                    <li class="divider"></li>
                    <li><a href="<?php echo $this->request->webroot . 'Users/logout' ?>"><i class="icon-key"></i> Log Out</a></li>
                </ul>
            </li>
            <!-- /user login dropdown -->
        </ul>
        <!-- /Top Right Menu -->
    </div>
    <!-- /top navigation bar -->

</header> <!-- /.header -->
