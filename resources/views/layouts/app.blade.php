<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/scroll.css') }}">
{{--    <link type="text/css" rel="stylesheet" href="{{ mix('css/ok.css') }}">--}}
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body style="min-height: 100vh">
    <div id="app">
        @include("layouts.nav")
        <div class="container" style="padding-left: 7%; padding-right: 7%;">
            @include('inc.errors')
        </div>
        <main class="py-4">
            <div class="container min-vh-100">
                @yield('content')
            </div>

        </main>

    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
