<div class="navbar-fixed">
    <nav>
        <a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>

        <div class="nav-wrapper blue {{ Auth::check() && \Request::user()->company ? 'darken-4': '' }}">
          <div class="col s12">
            <a href="/" class="brand-logo hide-on-med-and-down">
                <img src="/img/logo.png" class="logo-img" alt="" height="64px"></a>
            <a href="/" class="brand-logo" style="left:120px;">
                ZinoJobs
                <font style="font-size: 10pt">
                    {{ Auth::check() && \Request::user()->company ? 'For Employers': '' }}
                </font>
            </a>



            @foreach(['right hide-on-med-and-down', 'side-nav'] as $classes)
                <ul class="{{ $classes }}" @if($loop->last) id="mobile-demo" @endif>

                    @if (Auth::check() && $loop->last)
                        <li>
                            <div class="user-view">
                                <div class="background blue darken-3">
                                    {{-- <img src="{{ auth()->user()->avatar }}"> --}}
                                </div>
                                <a href="/account"><img class="circle" src="{{ auth()->user()->avatar }}"></a>
                                <a href="/account"><span class="white-text name">{{ auth()->user()->name }}</span></a>
                                <a href="/account"><span class="white-text email">{{ auth()->user()->email }}</span></a>
                            </div>
                        </li>
                    @endif

                    <li><a class="link" href="{{ url('/') }}"><i class="material-icons left">home</i> Home</a></li>
                    @if (Auth::check() && \Request::user()->company)
                        <li><a class="link" href="{{ url('employer/jobs')}}"><i class="material-icons left">work</i> Jobs</a></li>
                    @else
                        <li><a class="link" href="{{ url('jobs')}}"><i class="material-icons left">work</i> Jobs</a></li>
                    @endif
                    {{-- <li><a class="link" href="{{ url('pricing') }}">Pricing</a></li> --}}
                    {{-- <li><a class="link" href="{{ url('about') }}">About</a></li> --}}
                    {{-- @modules() --}}

                    {{--
                    @if (config('app.locale') == 'fr')
                        @menu('main-fr')
                    @else
                        @menu('main')
                    @endif
                    --}}

                    @if (Auth::check())

                        @if (\Request::user()->company)
                            <li><a href="{{ url('employer/jobs/create') }}" class="waves-effect waves-light btn yellow darken-2 grey-text text-darken-4 segment-track-login">POST A JOB</a></li>
                        @else
                            <li><a href="{{ url('applications') }}" class="waves-effect waves-light btn yellow darken-2 grey-text text-darken-4 segment-track-login">My Applications</a></li>
                        @endif

                    @if ($loop->first)
                        @if (Auth::check() && \Request::user()->company)
                            <li><a class="link" href="{{ url('employer/setup') }}"><i class="material-icons left">settings</i> Settings</a></li>
                        @else
                            <li><a class="dropdown-button" href="#!" data-activates="employer_dropdown">I'm an Employer<i class="material-icons right">arrow_drop_down</i></a></li>

                            <ul id="employer_dropdown" class="dropdown-content">
                                {{-- <li><a class="indego-text link" href="{{ url('employer/jobs/create') }}">Post a Job</a></li>
                                <li><a class="link" href="{{ url('employer/jobs') }}">Jobs</a></li> --}}
                                <li><a class="link" href="{{ url('employer/setup') }}">Upgrade to Employer Account</a></li>
                            </ul>

                        @endif
                    @endif

                        @can('quarx')
                            <li><a class="btn" href="{{ url('admin/dashboard') }}">Admin</a></li>
                        @endcan
                        @if($loop->first)
                            <li>
                                <a href="/account">
                                    <img src="{{ auth()->user()->avatar }}" alt="" class="circle z-depth-2" style="max-height: 50px;" >
                                </a>
                            </li>
                        @endif
                    @else
                        <li><a href="{{ url('/login') }}" class="bold-text"><i class="material-icons left">fingerprint</i> Login</a></li>
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


</div>
