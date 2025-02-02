<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KRONA') }} | @yield('title')</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="shortcut icon" href="{{ asset('/assets/front/images/logo2.png') }}" type="image/png">

    <link href="{{ asset('/assets/front/css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('/assets/front/css/swiper.css') }}" rel="stylesheet">

    <link href="{{ asset('/assets/front/css/ionicons.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @stack('css')
</head>
<body >
<div class="content" id="app">
@include('layouts.front.partial.header')

    @yield('content')

    @include('layouts.front.partial.footer')

</div>

<!-- SCIPTS -->

<script src="{{ asset('/assets/front/js/jquery-3.1.1.min.js') }}"></script>

<script src="{{ asset('/assets/front/js/tether.min.js') }}"></script>

<script src="{{ asset('/assets/front/js/bootstrap.js') }}"></script>

<script src="{{ asset('/assets/front/js/swiper.js') }}"></script>

<script src="{{ asset('/assets/front/js/scripts.js') }}"></script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

{!! Toastr::message() !!}

@stack('js')

</body>
</html>
