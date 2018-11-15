<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'IT') }} - @yield('title')</title>

        <!-- Fonts -->

        <!-- Icons -->
        <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/core/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/core/bootstrap_limitless.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/core/colors.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/core/components.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/core/layout.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        @stack('css')

    </head>
    <body class="navbar-top sidebar-xs">

        <!-- Main navbar -->
        @include('navbars.main')

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            @include('sidebars.main')

            <!-- Other sidebars -->
            @yield('other_sidebars')

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                @include('partials.page-header')

                <!-- Content area -->
                <div class="content">
                    {{-- @include('flash::message') --}}
                    @yield('content')
                </div>

                <!-- Main footer -->
                @include('footers.main')

            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('js/core/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/core/app.js') }}"></script>
        <script src="{{ asset('js/partials/layout_fixed_sidebar_custom.js') }}"></script>

        <!-- Vendors -->
        <script src="{{ asset('vendors/scrollbar/perfect_scrollbar.min.js') }}"></script>
        <script src="{{ asset('vendors/loaders/blockui.min.js') }}"></script>

        <!-- Custom -->
        <script src="{{ asset('js/custom.js') }}"></script>

        @stack('scripts')

    </body>
</html>
