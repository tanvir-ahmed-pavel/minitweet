<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include("layouts.nav")
        <div class="container" style="padding-left: 7%; padding-right: 7%;">
            @include("inc.errors")
        </div>
        <main class="py-4">
            <div class="container" style="padding-left: 7%; padding-right: 7%;">
                @yield('content')
            </div>

        </main>
    </div>
    <footer class="blog-footer text-center" style="background-color: #d5d5d5; padding: 20px;">
        <p>Blog template built for ©MiniTweet by Pavel Ahmed® 🐸🐸</p>
        <p>
            <a href="/posts">Back to Top</a>
        </p>
    </footer>
</body>
</html>
