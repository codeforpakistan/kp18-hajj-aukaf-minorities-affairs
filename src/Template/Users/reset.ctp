<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Auqaf, hajj, Religious & Minority Affairs</title>
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
                width:500px;
            }

        </style>
    </head>

    <body class="login bg" id="fullDiv">
        <!-- Logo -->
        <div class="col-sm-12">
            <?= $this->Flash->render() ?>
            <!-- Login Box -->
            <div class="box">
                <div class="content">
                    <div class="col-lg-12">
                        <img src="<?php echo $this->request->webroot; ?>img/logo.png" class="img img-responsive" style="margin-top: 10px;">
                        <br/>
                    </div>
                    <?= $this->Form->create($user, ['class' => 'form-vertical login-form']); ?>    
                    <!-- Title -->
                    <h3 class="form-title">Reset password</h3>
                    <!-- Error Message -->
                    <div class="form-group">
                        <?php echo $this->Form->control('password', ['templates' => ['inputContainer' => '<div class="input-icon"><i class="icon-lock"></i>{{content}}<p id="pass_error"></p></div>'], 'label' => false, 'class' => 'form-control', 'placeholder' => 'Enter New Password', "id" => "register_password", 'data-rule-required' => 'true','value'=>'']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('password_confirm', ['templates' => ['inputContainer' => '<div class="input-icon"><i class="icon-ok"></i>{{content}}</div>'], 'label' => false, 'div' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm Password', "data-rule-equalTo" => "#register_password", 'data-rule-required' => 'true']); ?>
                    </div>
                    <!-- Form Actions -->
                    <div class="form-actions">
                        <?= $this->Form->button('Change password', ['escape' => false, 'class' => 'btn btn-success pull-right']) ?>
                    </div>
                </div> 
                <!-- /.content -->
            </div>
           
        </div>
    </body>
</html>