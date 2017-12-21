<nav class="navbar navbar-default navbar-fixed-top clearfix">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('') }}">Home</a>
        </div>
        <div class="collapse navbar-collapse" id="navBar">
            <ul class="nav navbar-nav">
                @menu('main', 'quarx-frontend::partials.main-menu')
                <li><a href="{{ url('blog') }}">Blog</a></li>
                <li><a href="{{ url('events') }}">Events</a></li>
                <li><a href="{{ url('faqs') }}">FAQs</a></li>
                <li><a href="{{ url('gallery') }}">Gallery</a></li>
                @modules()
            </ul>
            <ul class="nav navbar-nav navbar-right menu">
                @if (auth()->user())
                    <li><a href="{!! url('user/settings') !!}"><span class="fa fa-fw fa-user"></span> Settings</a></li>
                @else
                    <li><a href="{!! url('login') !!}"><span class="fa fa-fw fa-sign-in"></span> Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
