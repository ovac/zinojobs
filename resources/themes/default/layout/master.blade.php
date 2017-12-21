<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">

        <title>{{ config('app.name') }} @if (isset($page) && !is_null($page->title)) - {{ $page->title }} @endif</title>

        <meta name="description" content="@yield('seoDescription')">
        <meta name="keywords" content="@yield('seoKeywords')">
        <meta name="author" content="">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        @yield('stylesheets')
    </head>

    <body>

        @theme('partials.navigation')

        <div class="site-wrapper @if(Request::is('/')) homepage @endif">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <div class="footer container-fluid navbar-fixed-bottom">
            <p class="pull-left">&copy; {{ date('Y') }} - <a href="{{ url('pages') }}">Page Directory</a></p>
            @can('quarx')
                <a class="btn btn-xs btn-default pull-right" href="{{ url('quarx/dashboard') }}">Quarx</a>
                @yield('quarx')
            @else
                <a class="btn btn-xs btn-default pull-right" href="{{ url('login') }}">Login</a>
            @endcan
        </div>

    </body>

    <script type="text/javascript">
        var _token = '{!! csrf_token() !!}';
        var _url = '{!! url("/") !!}';
    </script>
    @yield("pre-javascript")
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @yield('javascript')
</html>
