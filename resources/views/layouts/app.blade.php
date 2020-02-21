<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'IT') }} | @yield('title')</title>

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
    <body class="layout-boxed-bg sidebar-xs sidebar-secondary-hidden">


        @include('navbars.modals.sign')

        <div class="d-flex flex-column flex-1 layout-boxed">

            @auth
                @include('navbars.main')
            @endauth

            <div class="page-content">

                @yield('other_sidebars')

                <div class="content-wrapper">

                    @include('partials.page-header')

                    @yield('second_navbar')

                    <div class="content">
                        {{-- @include('flash::message') --}}
                        @yield('content')
                    </div>

                    @include('footers.main')

                </div>

            </div>

            @include('sidebars.search')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('js/core/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/core/app.js') }}"></script>

        <!-- Vendors -->
        <script src="{{ asset('vendors/loaders/blockui.min.js') }}"></script>
        <script src="{{ asset('vendors/styling/uniform.min.js') }}"></script>

        <!-- Custom -->
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/partials/employee.js') }}"></script>

        @stack('scripts')
    </body>
</html>
