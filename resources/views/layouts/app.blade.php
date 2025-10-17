<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Project Managenagement System - @yield('title')</title>
        <link type="text/css" rel="stylesheet" href="{{ asset('./assets/css/fontawesome.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('./assets/css/fonts.googleapis.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('./assets/css/mdb.min.css') }}" />
        @yield('custom_css')
    </head>
    <body style="background-color: #EEEFF2;">
        @yield('header')

        <div class="container-fluid">
            @yield('content')
        </div>

        <script type="text/javascript" src="{{ asset('./assets/js/jquery-3.5.1.js') }}"></script>
        <script type="text/javascript" src="{{ asset('./assets/js/mdb.umd.min.js') }}"></script>
        @yield('custom_js')
    </body>
</html>
