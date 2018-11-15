<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PTI') }} - @yield('title')</title>

    <!-- Fonts -->

    <!-- Icons -->
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/core/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/core/bootstrap_limitless.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/core/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/core/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/core/layout.min.css') }}" rel="stylesheet">

    @stack('css')

</head>
<body>

<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">
            @yield('content')
        </div>

    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/core/jquery.min.js') }}" defer></script>
<script src="{{ asset('js/core/bootstrap.bundle.min.js') }}" defer></script>
<script src="{{ asset('js/core/app.js') }}" defer></script>

@stack('scripts')

</body>
</html>
