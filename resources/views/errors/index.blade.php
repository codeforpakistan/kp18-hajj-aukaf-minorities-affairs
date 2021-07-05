<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>
            </nav>

            <main class="py-4 container">
                <table class="table table-borderless table-striped">
                    <tbody>
                        <tr>
                            <td style="font-weight: bold; color: red;">
                                Oops, {{$errors->first()}}
                                <a class="btn btn-primary btn-sm" href="{{ auth()->user() ? route('admin.dashboard.index') : route('guest.home.index') }}">Back to Home</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </body>
</html>
