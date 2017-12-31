<div class="navbar-fixed">
    <nav>
        <a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>

        <div class="nav-wrapper blue">
          <div class="col s12">
            <a href="/" class="brand-logo" style="left:50px;">ZinoJobs</a>


            @foreach(['right hide-on-med-and-down', 'side-nav'] as $classes)
                <ul class="{{ $classes }}" @if($loop->last) id="mobile-demo" @endif>
                    <li><a class="link" href="{{ url('/') }}">Home</a></li>
                    <li><a class="link" href="{{ url('blog') }}">Blog</a></li>
                    <li><a class="link" href="{{ url('pricing') }}">Pricing</a></li>
                    <li><a class="link" href="{{ url('about') }}">About</a></li>

                    @if ($loop->first)
                        <li><a class="dropdown-button" href="#!" data-activates="support">Support<i class="material-icons right">arrow_drop_down</i></a></li>
                    @else
                        <li><a class="indego-text link" href="{{ url('community') }}">Community</a></li>
                        <li><a class="link" href="{{ url('faqs') }}">FAQs</a></li>
                        <li><a class="link" href="{{ url('contact') }}">Contact-Us</a></li>
                    @endif
                    {{-- @modules() --}}

                    @if (config('app.locale') == 'fr')
                        @menu('main-fr')
                    @else
                        @menu('main')
                    @endif

                    @if (Auth::check())
                        <li><a href="{{ url('home') }}" class="waves-effect waves-light btn yellow darken-2 grey-text text-darken-4 segment-track-login">Dashboard</a></li>
                        @can('quarx')
                            <li><a class="btn" href="{{ url('admin/dashboard') }}">Admin</a></li>
                        @endcan
                    @else
                        <li><a href="{{ url('/login') }}" class="bold-text">Login</a></li>
                        <li><a href="{{ url('/register') }}" class="waves-effect waves-light btn yellow darken-2 grey-text text-darken-4 segment-track-login">Create Free Account</a></li>
                    @endif
                </ul>
            @endforeach


            {{-- <ul class="side-nav" id="mobile-demo">
              <li><a href="/product">Product</a></li>

            </ul> --}}

        </div>
    </div>

</nav>

    <ul id="support" class="dropdown-content">
        <li><a class="indego-text link" href="{{ url('community') }}">Community</a></li>
        <li><a class="link" href="{{ url('faqs') }}">FAQs</a></li>
        <li><a class="link" href="{{ url('contact') }}">Contact-Us</a></li>
    </ul>

</div>
