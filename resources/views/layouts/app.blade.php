<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME','Laravel-App') }} | @yield('title','Administration')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])
    {!! Html::style('css/toastr.min.css') !!}

    @yield('header-css')

</head>
<body>
    <div id="app">
       @include('layouts.includes.header')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@vite(['resources/js/app.js'])
{!! Html::script('js/jquery.min.js') !!}
{!! Html::script('js/toastr.min.js') !!}
{!! Toastr::message() !!}

@yield('footer-script')
</html>
