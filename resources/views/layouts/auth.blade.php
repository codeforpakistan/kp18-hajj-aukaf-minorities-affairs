<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>{{ env('APP_NAME') }}</title>
        <link rel="icon" href="{{ asset('img/index.png')  }}" type="image/x-icon">

        <!--=== CSS ===-->

        <!-- Bootstrap -->
        <link href="{{ asset('client/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Theme -->
        <link href="{{ asset('client/assets/css/main.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('client/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('client/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('client/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />

        <!-- Login -->
        <link href="{{ asset('client/assets/css/login.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{ asset('client/assets/css/fontawesome/font-awesome.min.css') }}">
        <!--[if IE 7]>
                <link rel="stylesheet" href="{{ asset('client/assets/css/fontawesome/font-awesome-ie7.min.css') }}">
        <![endif]-->

        <!--[if IE 8]>
                <link href="{{ asset('client/assets/css/ie8.css') }}" rel="stylesheet" type="text/css" />
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

        <!--=== JavaScript ===-->
        <script type="text/javascript" src="{{ asset('client/assets/js/libs/jquery-1.10.2.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('client/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('client/assets/js/libs/lodash.compat.min.js') }}"></script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="{{ asset('client/assets/js/libs/html5shiv.js') }}"></script>
        <![endif]-->

        <!-- Beautiful Checkboxes -->
        <script type="text/javascript" src="{{ asset('client/plugins/uniform/jquery.uniform.min.js') }}"></script>

        <!-- Form Validation -->
        <script type="text/javascript" src="{{ asset('client/plugins/validation/jquery.validate.min.js') }}"></script>

        <!-- Slim Progress Bars -->
        <script type="text/javascript" src="{{ asset('client/plugins/nprogress/nprogress.js') }}"></script>

        <!-- App -->
        <script type="text/javascript" src="{{ asset('client/assets/js/login.js') }}"></script>
        <script>
            $(document).ready(function () {
                "use strict";
                Login.init(); // Init login JavaScript
            });
        </script>
        <style>
            #email_error{ color: #a94442; font-size: 13px; }
            #pass_error{ color: #a94442; font-size: 13px; }
            .bg { position: relative; }
            .bg:after { content : ""; display: block; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-repeat: no-repeat; background-size: contain; opacity : 0.4; z-index: -1; }
            #fullDiv { height: 100%; width: 100%; left: 0; top: 0; overflow: hidden; position: fixed; background-image:url('{{ asset('img/bg1.jpg') }}'); background-position:bottom; background-size:cover; }
            .modal-dialog{ width:450px; }
            .box{ width:400px !important; }
            .footer{ width:400px !important; }
        </style>
    </head>
    <body class="login bg" id="fullDiv">
        @yield('content')
    </body>
    @yield('scripts')
</html>