<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Auqaf, hajj, Religious & Minority Affairs</title>
        <link rel="icon" href="<?php echo $this->request->webroot; ?>img/index.png" type="image/x-icon">


        <!--=== CSS ===-->

        <!-- Bootstrap -->
        <link href="<?php echo $this->request->webroot ?>front_theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- jQuery UI -->
        <!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
        <!--[if lt IE 9]>
                <link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
        <![endif]-->

        <!-- Theme -->
        <link href="<?php echo $this->request->webroot ?>front_theme/assets/css/main.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->request->webroot ?>front_theme/assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->request->webroot ?>front_theme/assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->request->webroot ?>front_theme/assets/css/icons.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>front_theme/assets/css/fontawesome/font-awesome.min.css">
        <!--[if IE 7]>
                <link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
        <![endif]-->

        <!--[if IE 8]>
                <link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

        <!--=== JavaScript ===-->

        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/assets/js/libs/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/assets/js/libs/lodash.compat.min.js"></script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="assets/js/libs/html5shiv.js"></script>
        <![endif]-->

        <!-- Smartphone Touch Events -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/event.swipe/jquery.event.move.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/event.swipe/jquery.event.swipe.js"></script>

        <!-- General -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/assets/js/libs/breakpoints.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/respond/respond.min.js"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/cookie/jquery.cookie.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>

        <!-- Page specific plugins -->
        <!-- Charts -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/sparkline/jquery.sparkline.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/daterangepicker/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/blockui/jquery.blockUI.min.js"></script>

        <!-- Forms -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/select2/select2.min.js"></script> <!-- Styled select boxes -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/plugins/typeahead/typeahead.min.js"></script> <!-- AutoComplete -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/plugins/select2/select2.min.js"></script> <!-- Styled select boxes -->
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/plugins/bootstrap-inputmask/jquery.inputmask.min.js"></script>

        <!-- Form Validation -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/validation/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/validation/additional-methods.min.js"></script>

        <!-- Form Wizard -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

        <!-- Noty -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/noty/jquery.noty.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/noty/layouts/top.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/plugins/noty/themes/default.js"></script>

        <!-- App -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/assets/js/app.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/assets/js/plugins.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/assets/js/plugins.form-components.js"></script>

        <script>
            $(document).ready(function () {
                "use strict";

                App.init(); // Init layout and core plugins
                Plugins.init(); // Init all plugins
                FormComponents.init(); // Init all form-specific plugins
            });
        </script>

        <script>
            $(function () {
                $('#applicant_image').change(function () {
                    var file_name = $(this).val().replace(/C:\\fakepath\\/i, '')
                    $('#applicant_img_name').text(file_name);
                });


            })
        </script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>js/custom.js"></script>

        <script type="text/javascript" src="<?php echo $this->request->webroot ?>js/custom2.js"></script>
        <!--<script type="text/javascript" src="<?php // echo $this->request->webroot   ?>js/custom3.js"></script>-->


        <!-- Demo JS -->
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/assets/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot ?>front_theme/assets/js/demo/form_wizard.js"></script>
        <script type="text/javascript" src="<?php echo $this->request->webroot; ?>front_theme/assets/js/demo/form_components.js"></script>

        <style>
            .form-horizontal .control-label{
                text-align: left !important;
            }
            #clicktoadd{
                cursor: pointer; 
            }
            .crumbs{
                margin: 34px -20px 0px !important;
            }
            i[class^="icon-"] {
                font-size: 18px;
            }
        </style>
        <style>

            .header_text{
                font-size: 25px;
                color: #077923;
            }
            .sidebar-fixed{
                top: 70px !important;
            }
            .crumbs{
                margin: 34px -20px 0px !important;
            }
            .my_active{
                border-left: 8px solid #4d7496 !important;
            }
            /* On screens that are 992px wide or less, the background color is blue */
            @media screen and (max-width: 980px) {

                .sidebar-fixed{
                    top: 0 !important;
                }
                .crumbs{
                    margin: 0px -20px !important;
                }
            }
            @media screen and (max-width: 768px) {
                .header_text{
                    font-size: 20px;
                }
            }

            /* On screens that are 600px wide or less, the background color is olive */
            @media screen and (max-width: 500px) {
                .header_text{
                    font-size: 18px;
                }
            }
            .modal {
                text-align: center;
            }
            @media screen and (min-width: 768px) { 
                .modal:before {
                    display: inline-block;
                    vertical-align: middle;
                    content: " ";
                    height: 100%;
                }
            }
            .modal-dialog {
                display: inline-block;
                text-align: left;
                vertical-align: middle;
            }

        </style>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127152505-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-127152505-1');
        </script>


    </head>

    <body class="bg-image">
            <?php echo $this->element('header'); ?>
        <div id="container">
            <?php
            if ($auth->user('role_id') != null) {
                echo $this->element('sidebar');
            }
            ?>
            <!-- /Sidebar -->
<?php echo $this->fetch('content'); ?>
        </div>
    </body>
</html>