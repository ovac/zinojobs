@extends('auth.layout')
@include('auth.partials.recaptcha')
@section('form')

<div class="col s12 m6 offset-m3 valign">

    <div class="card-panel z-depth-4">


      <span class="card-title text mtext chip">Don't have an account? <a href="/register">Sign-up Free</a> </span>


      <div class="row">
        <form class="col s12"  method="POST" action="{{ route('login') }}">
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

          <div class="row">
            <div class="input-field col s12">
              <input id="password" type="password" class="validate" name="password" required>
              <label for="password">Pasword</label>
              @if ($errors->has('password'))
                  <span class="new red badge left">{{ $errors->first('password') }}</span>
              @endif
            </div>
          </div>

           @yield('recaptcha')

          <div class="chip">
            <a href="password/reset">Forgot your password?</a>
          </div>
          <button type="submit" class="btn right waves-effect waves-light blue"><i class="material-icons right">send</i> Login</button>
        </form>
      </div>
    </div>
</div>
@endsection
