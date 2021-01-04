
<!-- Header -->
<header class="header navbar navbar-fixed-top" role="banner" style="background-color:white;height: 85px;border-bottom: 1px solid #077923;">
    <!-- Top Navigation Bar -->
    <div class="container">

        <!-- Only visible on smartphones, menu toggle -->
        <div class="row">
            <?php
            if ($this->request->params['controller'] == 'Applicants' && $this->request->params['action'] == 'add') {
                ?>
                <div class="col-xs-2 hidden-sm hidden-lg hidden-md"></div>
            <?php } else { ?>
                <ul class="nav navbar-nav col-xs-2 hidden-sm hidden-lg hidden-md">
                    <li class="nav-toggle" style="border: none;margin-left: 8px;">
                        <a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a>
                    </li>
                </ul>
            <?php } ?>


            <!-- Logo -->
            <!--        <a class="navbar-brand" href="index.html">
                        <img src="<?php echo $this->request->webroot ?>assets/img/logo.png" alt="logo" />
                        <strong>ME</strong>LON
                    </a>-->

            <div class="col-sm-6 col-lg-2 col-md-2 hidden-sm hidden-xs"  style="height: 85px;padding: 5px 0px 15px 0px;">
                <!--<a class="col-sm-10" href="">-->
                <img style="height: 100%;" src="<?php echo $this->request->webroot ?>img/logo.png" alt="logo" />
                <!--</a>-->
            </div>
            <div class="col-lg-7 col-md-7 col-sm-8 col-xs-8"  style="color:white;">
                <h2 class="header_text">Auqaf, Hajj, Religious & Minority Affairs</h2>
            </div>
            <!-- /logo -->

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
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-2">
                <?php
                if ($auth->user('role_id') != null) {
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- User Login Dropdown -->
                        <li class="dropdown user" style="border: none;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-top:10px;font-size: 14px;color:#077923;">
                                    <!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
                                <i class="icon-user" style="font-size: 22px;"></i>
                                <span class="username" style="font-weight:unset;"><?= isset($user_name['name']) ? ucwords($user_name['name']) : $user_name; ?></span>
                                <i class="icon-angle-down" style="font-size: 22px;"></i>
                            </a>

                            <ul class="dropdown-menu">
                                <!--<li><a href="< $this->request->webroot; ?>Applicants/dashboard"><i class="icon-dashboard"></i> Dashboard</a></li>-->

                                <!--<li class="divider"></li>-->
                                <!--<li><a href="<?php // echo $this->request->webroot . 'Applicants/profile'   ?>"><i class="icon-user"></i> My Profile</a></li>-->
                                 <!--<li><a href="pages_calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>-->
                                 <!--<li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>-->
                                <li><a href="<?php echo $this->request->webroot . 'Institutes/add' ?>"><i class="icon-user"></i> My Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo $this->request->webroot . 'Users/logout' ?>"><i class="icon-signout"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- /user login dropdown -->
                    </ul>
                <?php } ?>
            </div>
        </div>
        <!-- /Top Right Menu -->
    </div>
    <!-- /top navigation bar -->

</header> <!-- /.header -->
