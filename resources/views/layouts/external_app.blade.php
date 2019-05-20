<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <body class="layout-boxed-bg sidebar-xs">

        <!-- Boxed layout wrapper -->
        <div class="d-flex flex-column flex-1 layout-boxed">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Content area -->
                    <div class="content">
                        @yield('content')
                    </div>

                    <!-- Main footer -->
                    @include('footers.main')

                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('js/core/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/core/app.js') }}"></script>

        <!-- Vendors -->
        <script src="{{ asset('vendors/loaders/blockui.min.js') }}"></script>

        <!-- Custom -->
        <script src="{{ asset('js/custom.js') }}"></script>

        @stack('scripts')
    </body>
</html>
