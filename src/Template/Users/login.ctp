<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Auqaf, hajj, Religious & Minority Affairs</title>
        <link rel="icon" href="<?php echo $this->request->webroot; ?>img/index.png" type="image/x-icon">

        <!--=== CSS ===-->

        <!-- Bootstrap -->
        <link href="<?php echo $this->request->webroot; ?>front_theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- Theme -->
        <link href="<?php echo $this->request->webroot; ?>front_theme/assets/css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->request->webroot; ?>front_theme/assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->request->webroot; ?>front_theme/assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->request->webroot; ?>front_theme/assets/css/icons.css" rel="stylesheet" type="text/css" />

        <!-- Login -->
        <link href="<?php echo $this->request->webroot; ?>front_theme/assets/css/login.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="<?php echo $this->request->webroot; ?>front_theme/assets/css/fontawesome/font-awesome.min.css">
        <!--[if IE 7]>
                <link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
        <![endif]-->

        <!--[if IE 8]>
                <link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

        <!--=== JavaScript ===-->

        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/assets/js/libs/jquery-1.10.2.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/assets/js/libs/lodash.compat.min.js"></script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="assets/js/libs/html5shiv.js"></script>
        <![endif]-->

        <!-- Beautiful Checkboxes -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/plugins/uniform/jquery.uniform.min.js"></script>

        <!-- Form Validation -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/plugins/validation/jquery.validate.min.js"></script>

        <!-- Slim Progress Bars -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/plugins/nprogress/nprogress.js"></script>

        <!-- App -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/assets/js/login.js"></script>
        <script>
            $(document).ready(function () {
                "use strict";
                Login.init(); // Init login JavaScript
            });
        </script>
        <style>
            #email_error{
                color: #a94442;
                /*font-weight: bold;*/
                font-size: 13px;
            }
            #pass_error{
                color: #a94442;
                /*font-weight: bold;*/
                font-size: 13px;
            }
            .bg {
                position: relative;
            }
            .bg:after {
                content : "";
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                /*background-image: url("< $this->request->webroot ?>img/auqaf.jpg");*/ 
                width: 100%;
                height: 100%; 

                /* Center and scale the image nicely */
                /*background-position: center;*/
                background-repeat: no-repeat;
                background-size: contain;

                opacity : 0.4;
                z-index: -1;
            }
            #fullDiv {
                height: 100%;
                width: 100%;
                left: 0;
                top: 0;
                overflow: hidden;
                position: fixed;
                background-image:url('<?php echo $this->request->webroot . 'img/bg1.jpg'; ?>');
                background-position:bottom;
                background-size:cover;
            }
            .modal-dialog{
                width:450px;
            }
            .box{
                width:400px !important;
            }
            .footer{
                width:400px !important;
            }

        </style>
    </head>

    <body class="login bg" id="fullDiv">
        <!-- Logo -->
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?= $this->Flash->render() ?>
            <!-- Login Box -->
            <div class="box">
                <div class="content">
                    <div class="col-lg-12">
                        <img src="<?php echo $this->request->webroot; ?>img/logo.png" class="img img-responsive" style="margin-top: 10px;">
                        <br/>
                    </div>

                    <h3 class="form-title" style="color: #057822;">Auqaf, Hajj, Religious & Minority Affairs</h3>

                    <?= $this->Form->create($user, ['class' => 'form-vertical login-form']); ?>    
                    <!-- Title -->
                    <h3 class="form-title" style="color: #057822;margin: 10px 0px;">Sign In</h3>
                    <!-- Error Message -->
                    <div class="alert fade in alert-danger" style="display: none;">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        Enter any username and password.
                    </div>

                    <!-- Input Fields -->
                    <div class="form-group">
                        <?php echo $this->Form->control('email', ['id' => 'login_email', 'templates' => ['inputContainer' => '<div class="input-icon"><i class="icon-envelope"></i>{{content}}</div>'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Email address', "data-rule-required" => "true", 'data-rule-email' => 'true']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('password', ['templates' => ['inputContainer' => '<div class="input-icon"><i class="icon-lock"></i>{{content}}</div>'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Password', 'data-rule-required' => 'true']); ?>
                    </div>
                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a class="back pull-left" data-toggle="modal" data-target="#myModal" href="#" style="padding: 6px 0px;text-decoration:underline;font-size:14px;color:green;">Forgot Password?</a>
                        <?= $this->Form->button('Sign In', ['name' => 'login', 'escape' => false, 'class' => 'btn btn-success pull-right']) ?>
                    </div>
                    <?php echo $this->Form->end(); ?>

                    <?= $this->Form->create($user, ['id' => 'register_form', 'class' => 'form-vertical register-form', 'style' => "display: none;"]); ?>    
                    <h3 class="form-title">Sign Up</h3>
                    <div class="form-group">
                        <?php echo $this->Form->control('email', ['id' => 'email', 'templates' => ['inputContainer' => '<div class="input-icon"><i class="icon-envelope"></i>{{content}}<p id="email_error"></p></div>'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Email address', "data-rule-required" => "true", 'data-rule-email' => 'true']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('password', ['templates' => ['inputContainer' => '<div class="input-icon"><i class="icon-lock"></i>{{content}}<p id="pass_error"></p></div>'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Password', "id" => "register_password", 'data-rule-required' => 'true']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('password_confirm', ['templates' => ['inputContainer' => '<div class="input-icon"><i class="icon-ok"></i>{{content}}</div>'], 'label' => false, 'div' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm Password', "data-rule-equalTo" => "#register_password", 'data-rule-required' => 'true']); ?>
                    </div>
                    <?php
                    $this->Form->unlockField('error');
                    echo $this->Form->hidden('error', ['secure' => false, 'id' => 'error_field']);
                    ?>
                    <div class="form-actions">
                        <a class="back pull-left" style="padding: 8px 0px;text-decoration:underline;font-size:14px;color:green;cursor: pointer">
                            <!--<i class="icon-angle-left"></i>--> 
                            Login to your Account
                        </a>
                        <?= $this->Form->button('Sign Up', ['name' => 'register', 'escape' => false, 'class' => 'btn btn-success pull-right']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div> 
                <!-- /.content -->
            </div>
            <!-- Footer -->
            <div class="footer" style="background-color:#F9F9F9;padding: unset;">
                <a href="#" class="sign-up">
                    <br/>
                    Don't have an account yet? <strong>Sign Up</strong>
                    <br/><br/>
                </a>
            </div>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding: 10px 15px;">
                            <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                            <h4 class="modal-title" style="font-size: 13px;">Enter an email address</h4>
                        </div>
                        <?= $this->Form->create('forgot'); ?>
                        <div class="modal-body" style="padding: 10px 20px;">
                            <div class="form-group">
                                <?php echo $this->Form->control('email', ['templates' => ['inputContainer' => '<div class="input-icon"><i class="icon-envelope"></i>{{content}}</div>'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Email address', "data-rule-required" => "true", 'data-rule-email' => 'true', 'style' => 'margin-top:10px;']); ?>
                            </div>
                        </div>
                        <div class="modal-footer" style="padding:10px 20px 15px;">
                            <?= $this->Form->button(__('submit'), ['name' => 'forgot', 'class' => 'btn btn-success btn-sm']); ?>
                            <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close</button>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3"></div>

        <script>
            $(function () {
                $('#register_form').submit(function () {
                    var email = $('#error_field').val();
                    var pass = $('#register_password').val();
                    if (email == 1) {
                        return false;
                    }
                    if (pass.length < 6) {
                        $('#pass_error').text('Password must be at least 6 characters long.');
                        return false;
                    }
                    return(true);
                });
//               alert($('.help-block').text());
                $('#email').change(function () {

                    var email = $(this).val();
                    $.ajax({
                        type: "GET",
                        contentType: 'json',
                        url: "<?= $this->Url->build(['controller' => 'Users', 'action' => 'emailValidate']) ?>",
                        data: "email=" + email,
                        success: function (data) {
//                            alert(data);
                            if (data != 1) {
//                                alert(data);
                                $('#error_field').val(1);
                                if ($('.help-block').text()) {
                                    $('#email_error').text('');
                                    //do nothing
                                } else {
                                    $('#email_error').text(data);
                                }

                            } else {
                                $('#error_field').val(0);
                                $('#email_error').text('');
                            }
                        }, error: function (error) {
//                            alert(error);
                        }
                    });
                });
            });
        </script>
        <!-- /Footer -->
    </body>
</html>