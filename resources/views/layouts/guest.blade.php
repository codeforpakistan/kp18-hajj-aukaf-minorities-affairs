<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>{{ env('APP_NAME') }}</title>
        <link rel="icon" href="{{ asset('img/index.png')  }}" type="image/x-icon">
        <!--=== CSS ===-->
        <!-- Bootstrap -->
        <link href="{{ asset('client/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- jQuery UI -->
        <!--<link href="{{ asset('client/plugins/jquery-ui/jquery-ui-1.10.2.custom.css') }}" rel="stylesheet" type="text/css" />-->
        <!--[if lt IE 9]>
                <link rel="stylesheet" type="text/css" href="{{ asset('client/plugins/jquery-ui/jquery.ui.1.10.2.ie.css') }}"/>
        <![endif]-->

        <!-- Theme -->
        <link href="{{ asset('client/assets/css/main.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('client/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('client/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('client/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{ asset('client/assets/css/fontawesome/font-awesome.min.css') }}">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
        <script>
            var baseUrl = "{{ route('guest.home.index') }}";
        </script>
        <!--=== JavaScript ===-->
        <script type="text/javascript" src="{{ asset('client/assets/js/libs/jquery-1.10.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('client/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/assets/js/libs/lodash.compat.min.js') }}"></script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="{{ asset('client/assets/js/libs/html5shiv.js') }}"></script>
        <![endif]-->

        <!-- Smartphone Touch Events -->
        <script type="text/javascript" src="{{ asset('client/plugins/touchpunch/jquery.ui.touch-punch.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/event.swipe/jquery.event.move.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/event.swipe/jquery.event.swipe.js') }}"></script>

        <!-- General -->
        <script type="text/javascript" src="{{ asset('client/assets/js/libs/breakpoints.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/respond/respond.min.js') }}"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
        <script type="text/javascript" src="{{ asset('client/plugins/cookie/jquery.cookie.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/slimscroll/jquery.slimscroll.horizontal.min.js') }}"></script>
        <!-- Page specific plugins -->
        <!-- Charts -->
        <script type="text/javascript" src="{{ asset('client/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/daterangepicker/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/blockui/jquery.blockUI.min.js') }}"></script>
        <!-- Forms -->
        <script type="text/javascript" src="{{ asset('client/plugins/select2/select2.min.js') }}"></script> <!-- Styled select boxes -->
        <script type="text/javascript" src="{{ asset('client/plugins/typeahead/typeahead.min.js') }}"></script> <!-- AutoComplete -->
        <script type="text/javascript" src="{{ asset('client/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/select2/select2.min.js') }}"></script> <!-- Styled select boxes -->
        <script type="text/javascript" src="{{ asset('client/plugins/bootstrap-inputmask/jquery.inputmask.min.js') }}"></script>
        <!-- Form Validation -->
        <script type="text/javascript" src="{{ asset('client/plugins/validation/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/plugins/validation/additional-methods.min.js') }}"></script>
        <!-- Form Wizard -->
        <script type="text/javascript" src="{{ asset('client/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
        <!-- App -->
        <script type="text/javascript" src="{{ asset('client/assets/js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/assets/js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/assets/js/plugins.form-components.js') }}"></script>
        <script src="{{ asset('js/axios.min.js') }}"></script>
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
        <script type="text/javascript" src="{{ asset('client/js/custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/js/custom2.js') }}"></script>
        <!--<script type="text/javascript" src="{{ asset('client/js/custom3.js') }}"></script>-->
        <!-- Demo JS -->
        <script type="text/javascript" src="{{ asset('client/assets/js/custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/assets/js/demo/form_wizard.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/assets/js/demo/form_components.js') }}"></script>
        <style>
            .form-horizontal .control-label{ text-align: left !important; }
            #clicktoadd{ cursor: pointer; }
            .crumbs{ margin: 34px -20px 0px !important; }
            i[class^="icon-"] { font-size: 18px; }
            .header_text{ font-size: 25px; color: #077923; }
            .sidebar-fixed{ top: 70px !important; }
            .crumbs{ margin: 34px -20px 0px !important; }
            .my_active{ border-left: 8px solid #4d7496 !important; }
            /* On screens that are 992px wide or less, the background color is blue */
            @media screen and (max-width: 980px) {
                .sidebar-fixed{ top: 0 !important; }
                .crumbs{ margin: 0px -20px !important; }
            }
            @media screen and (max-width: 768px) {
                .header_text{ font-size: 20px; }
            }
            /* On screens that are 600px wide or less, the background color is olive */
            @media screen and (max-width: 500px) {
                .header_text{ font-size: 18px; }
            }
            .modal { text-align: center; }
            @media screen and (min-width: 768px) { 
                .modal:before { display: inline-block; vertical-align: middle; content: " "; height: 100%; }
            }
            .modal-dialog { display: inline-block; text-align: left; vertical-align: middle;}
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
    <body class="">
        <!-- Header -->
        <header class="header navbar navbar-fixed-top" role="banner" style="background-color:white;height: 85px;border-bottom: 1px solid #077923;">
            <!-- Top Navigation Bar -->
            <div class="container">
                <!-- Only visible on smartphones, menu toggle -->
                <div class="row">
                    <div class="col-xs-2 hidden-sm hidden-lg hidden-md"></div>
                    <div class="col-sm-6 col-lg-2 col-md-2 hidden-sm hidden-xs"  style="height: 85px;padding: 5px 0px 15px 0px;">
                        <img style="height: 100%;" src="{{ asset('img/logo.png') }}" alt="logo" />
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-8"  style="color:white;">
                        <h2 class="header_text">{{ env("APP_NAME") }}</h2>
                    </div>
                    {{-- @if( ! \Auth::check() )
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 pull-right"  style="color:white;">
                            <h2 class="header_text">
                                <a href="{{ route('login') }}" class="btn btn-success btn-lg">Login</a>
                            </h2>
                        </div>
                    @endif --}}
                    <!-- /logo -->
                    <!-- Top Right Menu -->
                </div>
                <!-- /Top Right Menu -->
            </div>
            <!-- /top navigation bar -->
        </header> <!-- /.header -->

        <div id="container" class="bg-image">
            @yield('content')
        </div>
    </body>
</html>