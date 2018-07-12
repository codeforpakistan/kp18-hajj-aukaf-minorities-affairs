<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>

<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<link rel="icon" href="<?php echo $this->request->webroot ;?>favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo $this->request->webroot ;?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo $this->request->webroot ;?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo $this->request->webroot ;?>plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="<?php echo $this->request->webroot ;?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo $this->request->webroot ;?>css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo $this->request->webroot ;?>css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="login-page" style="background: #009688">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b></b></a>
            <small>Admin Hajj Auqaf and Minority Department</small>
        </div>
        <div class="card">
            <div class="body">
                <?= $this->Form->create() ?>
                
                    <div class="msg">Sign in to start your session
                    <?= $this->Flash->render() ?></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <?php echo $this->Form->input('username',['class'=>'form-control','placeholder'=>'Username','label'=>false,'autofocus']);?>
                           
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <?php echo $this->Form->input('password',['class'=>'form-control','placeholder'=>'Password','label'=>false]);?>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <?= $this->Form->button('Submit',['class'=>'btn btn-block bg-pink waves-effect']) ?>
                           
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                 
                 <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

    
    
      

    <!-- Jquery Core Js -->
    <script src="<?php echo $this->request->webroot ;?>plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo $this->request->webroot ;?>plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo $this->request->webroot ;?>plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo $this->request->webroot ;?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="<?php echo $this->request->webroot ;?>plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="<?php echo $this->request->webroot ;?>plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="<?php echo $this->request->webroot ;?>plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo $this->request->webroot ;?>plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo $this->request->webroot ;?>js/admin.js"></script>
    <script src="<?php echo $this->request->webroot ;?>js/pages/forms/form-validation.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo $this->request->webroot ;?>js/demo.js"></script>
</body>

</html>




