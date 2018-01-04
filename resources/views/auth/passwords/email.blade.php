@extends('auth.layout')
@include('auth.partials.recaptcha')
@section('form')

<div class="col s12 m6 offset-m3 valign">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

    <div class="card-panel z-depth-4 panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
      <span class="card-title text mtext chip">Try to <a href="/login">Sign In</a> or <a href="/register">Create a free account</a> </span>


      <div class="row">
        <form class="col s12"  method="POST" action="{{ route('password.email') }}">
                  {{ csrf_field() }}

          <div class="row">
            <div class="input-field col s12">
              <input id="email" type="email" class="validate" name="email" required value="{{ old('email') }}">
              <label for="email">E-Mail Address</label>
              @if ($errors->has('email'))
                  <span class="new red badge left">{{ $errors->first('email') }}</span>
              @endif
            </div>
          </div>

           @yield('recaptcha')

          <button type="submit" class="btn right waves-effect waves-light blue"><i class="material-icons right">send</i> Send Password Reset Link</button>
        </form>
      </div>
    </div>
</div></div>
@endsection
