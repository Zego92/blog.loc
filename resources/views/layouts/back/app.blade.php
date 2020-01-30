<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KRONA') }} | @yield('title')</title>

    <link rel="icon" href="{{ asset('/assets/back/favicon.ico') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link href="{{ asset('/assets/back/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('/assets/back/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <link href="{{ asset('/assets/back/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <link href="{{ asset('/assets/back/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <link href="{{ asset('/assets/back/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('/assets/back/css/themes/all-themes.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    @stack('css')
</head>
<body class="theme-blue">
<div class="content" id="app">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input aria-label="" type="text" placeholder="Начните Поиск...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
@include('layouts.back.partial.topbar')
    <section>
@include('layouts.back.partial.sidebar')
    </section>
    <section class="content">
        @yield('content')
    </section>
</div>

<script src="{{ asset('/assets/back/plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('/assets/back/plugins/bootstrap/js/bootstrap.js') }}"></script>

<script src="{{ asset('/assets/back/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<script src="{{ asset('/assets/back/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<script src="{{ asset('/assets/back/plugins/node-waves/waves.js') }}"></script>

<script src="{{ asset('/assets/back/js/admin.js') }}"></script>

<script src="{{ asset('/assets/back/js/demo.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

{!! Toastr::message() !!}

<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
        toastr["error"]("Введите Имя", "Ошибка");
        toastr.options ={
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            };
        @endforeach
    @endif
</script>

@stack('js')

</body>
</html>
