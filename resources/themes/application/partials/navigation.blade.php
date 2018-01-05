<div class="navbar-fixed">
    <nav>
        <a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>

        <div class="nav-wrapper blue">
          <div class="col s12">
            <a href="/" class="brand-logo hide-on-med-and-down"><img src="/img/logo.png" class="logo-img" alt="" height="64px"></a>
            <a href="/" class="brand-logo" style="left:100px;">
                ZinoJobs
                <font style="font-size: 10pt">
                    {{ Auth::check() && \Request::user()->company ? 'For Employers': '' }}
                </font>
            </a>



            @foreach(['right hide-on-med-and-down', 'side-nav'] as $classes)
                <ul class="{{ $classes }}" @if($loop->last) id="mobile-demo" @endif>
                    <li><a class="link" href="{{ url('/') }}"><i class="material-icons right">home</i></a></li>
                    @if (Auth::check() && \Request::user()->company)
                        <li><a class="link" href="{{ url('employer/jobs')}}">Jobs</a></li>
                    @else
                        <li><a class="link" href="{{ url('jobs')}}">Jobs</a></li>
                    @endif
                    {{-- <li><a class="link" href="{{ url('pricing') }}">Pricing</a></li> --}}
                    {{-- <li><a class="link" href="{{ url('about') }}">About</a></li> --}}

                    @if ($loop->first)
                        @if (Auth::check() && \Request::user()->company)
                            <li><a class="dropdown-button" href="#!" data-activates="applicant_dropdown">Applicant Account<i class="material-icons right">arrow_drop_down</i></a></li>

                            <ul id="applicant_dropdown" class="dropdown-content">
                                <li><a class="link" href="{{ url('applications') }}">Applicaitons</a></li>
                            </ul>
                        @else
                            <li><a class="dropdown-button" href="#!" data-activates="employer_dropdown">Employer<i class="material-icons right">arrow_drop_down</i></a></li>

                            <ul id="employer_dropdown" class="dropdown-content">
                                <li><a class="indego-text link" href="{{ url('employer/jobs/create') }}">Post a Job</a></li>
                                <li><a class="link" href="{{ url('employer/jobs') }}">Jobs</a></li>
                                <li><a class="link" href="{{ url('employer/setup') }}">Setup Employer Account</a></li>
                            </ul>

                        @endif
                    @endif
                    {{-- @modules() --}}

                    @if (config('app.locale') == 'fr')
                        @menu('main-fr')
                    @else
                        @menu('main')
                    @endif

                    @if (Auth::check())

                        @if (\Request::user()->company)
                            <li><a href="{{ url('employer/jobs/create') }}" class="waves-effect waves-light btn yellow darken-2 grey-text text-darken-4 segment-track-login">POST A JOB</a></li>
                        @else
                            <li><a href="{{ url('applications') }}" class="waves-effect waves-light btn yellow darken-2 grey-text text-darken-4 segment-track-login">My Applications</a></li>
                        @endif
                        @can('quarx')
                            <li><a class="btn" href="{{ url('admin/dashboard') }}">Admin</a></li>
                        @endcan

                        <li>
                            <a href="/account" class="avatar link">
                                <img src="{{ auth()->user()->avatar }}" alt="" class="z-depth-2" style="max-height: 50px;" >
                            </a>
                        </li>
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


</div>
