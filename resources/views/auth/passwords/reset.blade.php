@extends('auth.layout')
@include('auth.partials.recaptcha')
@section('form')

<div class="col s12 m6 offset-m3 valign">

    <div class="card-panel z-depth-4 panel panel-default">
                <div class="panel-heading">Reset Password</div>


      <div class="row">
        <form class="col s12"  method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

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
            <div class="input-field col s6">
              <input id="password" type="password" class="validate" name="password" required>
              <label for="password">Pasword</label>
              @if ($errors->has('password'))
                  <span class="new red badge left">{{ $errors->first('password') }}</span>
              @endif
            </div>

            <div class="input-field col s6">
              <input id="password_confirmation" type="password" class="validate" name="password_confirmation" required>
              <label for="password_conf">Confirm Pasword</label>
              @if ($errors->has('password_conf'))
                  <span class="new red badge left">{{ $errors->first('password_conf') }}</span>
              @endif
            </div>
          </div>

           @yield('recaptcha')

          <button type="submit" class="btn right waves-effect waves-light blue"><i class="material-icons right">send</i> Reset password</button>
        </form>
      </div>
    </div>
</div>
@endsection
