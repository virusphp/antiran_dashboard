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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Login">
    <meta name="author" content="MegonoDev">
    <link href="{{ asset('img/icon.png') }}" rel="icon">
    <link href="{{ asset('img/icon.png') }}" rel="apple-touch-icon">
    <title>@yield('title') | {{ config('app.name') }} </title>
    <!-- Main styles for this application-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('coreui/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/all.min.css') }}">
</head>

<body class="c-app flex-row align-items-center">
    @yield('content')
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('coreui/node_modules/js/coreui.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    @stack('scripts')
</body>

</html>