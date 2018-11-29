
<!-- Header -->
<header class="header navbar navbar-fixed-top" role="banner" style="background-color:white;height: 85px;border-bottom: 1px solid #077923;">
    <!-- Top Navigation Bar -->
    <div class="container">

        <!-- Only visible on smartphones, menu toggle -->
        <div class="row">
            <ul class="nav navbar-nav col-xs-2 hidden-sm hidden-lg hidden-md">
                <li class="nav-toggle" style="border: none;margin-left: 8px;">
                    <a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a>
                </li>
            </ul>

            <div class="col-sm-6 col-lg-2 col-md-2 hidden-sm hidden-xs"  style="height: 85px;padding: 5px 0px 15px 0px;">
                <!--<a class="col-sm-10" href="">-->
                <img style="height: 100%;" src="<?php echo $this->request->webroot ?>img/logo.png" alt="logo" />
                <!--</a>-->
            </div>
            <div class="col-lg-7 col-md-7 col-sm-8 col-xs-8"  style="color:white;">
                <h2 class="header_text">Auqaf, Hajj, Religious & Minority Affairs</h2>
            </div>

            <!-- Top Right Menu -->
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-2">

                <ul class="nav navbar-nav navbar-right">
                    <!-- User Login Dropdown -->
                    <li class="dropdown user" style="border: none;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-top:10px;font-size: 14px;color:#077923;">
                            <i class="icon-user" style="font-size: 22px;"></i>
                            <span class="username" style="font-weight:unset;"><?= isset($user_name['name']) ? ucwords($user_name['name']) : $user_name; ?></span>
                            <i class="icon-angle-down" style="font-size: 22px;"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->request->webroot . 'Institutes/add' ?>"><i class="icon-user"></i> My Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $this->request->webroot . 'Users/logout' ?>"><i class="icon-signout"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- /user login dropdown -->
                </ul>
            </div>
        </div>
        <!-- /Top Right Menu -->
    </div>
    <!-- /top navigation bar -->

</header> <!-- /.header -->
