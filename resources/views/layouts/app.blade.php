<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.seo', ['_seo' => null])

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('partials.favicon')

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{-- <link rel="stylesheet" href="{{ mix('css/material.indigo-pink.min.css') }}"> --}}

    @yield('styles')
    {{-- @yield('angular.config') --}}
    {{-- @yield('base') --}}

    {{-- @include('partials.google-analytics') --}}

    {{-- @include('plugin.intercom') --}}
    {{-- @include('plugin.fullstory') --}}
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Plugins -->
    {{-- @include('plugin.pendo') --}}
    {{-- @include('plugin.bitrix24') --}}
    {{-- @include('plugin.chaport') --}}

    {{-- <script src="{{ mix('js/vendor.js') }}"></script> --}}
    <script src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('script')
</body>
</html>
