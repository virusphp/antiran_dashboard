<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.0.0
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Backend">
    <link href="{{ asset('img/icon.png') }}" rel="icon">
    <link href="{{ asset('img/icon.png') }}" rel="apple-touch-icon">
    <meta name="author" content="MegonoDev">
    <title>@yield('title') | EONESIA</title>
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png"> -->

    <!-- Main styles for this application-->
    <link href="{{ asset('coreui/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('toast/jquery.toast.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://coreui.io/demo/3.0-beta.0/vendors/@coreui/icons/css/free.min.css">
    <link rel="stylesheet" href="https://coreui.io/demo/3.0-beta.0/vendors/@coreui/icons/css/brand.min.css">
    <link rel="stylesheet" href="{{ asset('coreui/datepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/sweetalert2/sweetalert2.min.css') }}">
    @stack('css')

</head>

<body class="c-app">
    <div id="app">
        @include('layouts.backend.partials.sidebar')
        <div class="c-wrapper c-fixed-components">
            @include('layouts.backend.partials.header')
            <div class="c-body">
                <main class="c-main">
                    @yield('content')
                </main>
                @include('layouts.backend.partials.footer')
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ !config('vue.isProduction') ? asset('lib/vue/vue.js') : asset('lib/vue/vue.min.js') }}"></script>
    <script src="{{ asset('lib/axios/axios.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script type="text/javascript" src="{{ asset('coreui/moment/min/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('coreui/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('coreui/node_modules/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('coreui/node_modules/chartjs/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('coreui/node_modules/utilsjs/coreui-utils.js') }}"></script>
    <script src="{{ asset('toast/jquery.toast.js') }}"></script>
    <script src="{{ asset('coreui/js/tooltips.js') }}"></script>
    <script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>
    @stack('scripts')
    @include('layouts.backend.partials._flash')
</body>

</html>