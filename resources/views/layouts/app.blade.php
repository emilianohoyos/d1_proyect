<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- BEGIN #favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
    <!-- END #favicon -->

    <!-- BEGIN #app-css -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
    <!-- END #app-css -->

    <!-- BEGIN #app-js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- END #app-js -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="pace-done">
    <!-- BEGIN #app -->
    <div id="app" class="app">
        <!-- BEGIN #header -->
        <div id="header" class="app-header">
            @include('layouts.partials.header')
        </div>
        <!-- END #header -->

        <!-- BEGIN #sidebar -->
        <div id="sidebar" class="app-sidebar">
            @include('layouts.partials.sidebar')
        </div>
        <!-- END #sidebar -->

        <!-- BEGIN #content -->
        <div id="content" class="app-content">
            @yield('content')
        </div>
        <!-- END #content -->

        <!-- BEGIN scroll-top-btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top"
            data-toggle="scroll-to-top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!-- END scroll-top-btn -->
    </div>
    <!-- END #app -->

    @stack('scripts')
</body>

</html>
