<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">


        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>{{ config('app.name') }} @if (isset($page) && !is_null($page->title)) - {{ $page->title }} @endif</title>

        <meta name="description" content="@yield('seoDescription')">
        <meta name="keywords" content="@yield('seoKeywords')">
        <meta name="author" content="">

        @include('partials.favicon')

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="/css/sweetalert2.css">


        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> --}}

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->

        @yield('stylesheets')
    </head>

    <body>
        @theme('partials.navigation')

        <div class="site-wrapper @if(Request::is('/')) homepage @endif">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        {{-- <div class="footer container-fluid navbar-fixed-bottom">
            <p class="pull-left">&copy; {{ date('Y') }}</p>
            @can('quarx')
                <a class="btn btn-xs btn-default pull-right" href="{{ url('quarx/dashboard') }}">Quarx</a>
                @yield('quarx')
            @else
                <a class="btn btn-xs btn-default pull-right" href="{{ url('login') }}">Login</a>
            @endcan
        </div> --}}

    </body>

    <script type="text/javascript">
        var _token = '{!! csrf_token() !!}';
        var _url = '{!! url("/") !!}';
    </script>
    @yield("pre-javascript")
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/js/sweetalert2.js"></script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="/js/materialize.min.js"></script>
    <script type="text/javascript">
        $('.button-collapse').sideNav({
                menuWidth: 300, // Default is 300
                edge: 'right', // Choose the horizontal origin
                closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                draggable: true, // Choose whether you can drag to open on touch screens,
                onOpen: function(el) { /* Do Stuff*/ }, // A function to be called when sideNav is opened
                onClose: function(el) { /* Do Stuff*/ }, // A function to be called when sideNav is closed
            }
        );
    </script>
    @yield('javascript')
    @include('flash')

</html>
