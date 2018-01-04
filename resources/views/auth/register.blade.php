@extends('auth.layout')
@include('auth.partials.recaptcha')
@section('form')

<div class="col s12 m8 offset-m2 valign">

    <div class="card-panel z-depth-4">

        <span class="card-title text mtext chip">Already have an account? <a href="/login">Sign In</a> </span>


        <div class="row">
          <form class="col s12"  method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
            <div class="row">
              <div class="input-field col s12">
                <input id="name" type="text" class="validate" name="name" required {{ old('name') }}>
                <label for="name">Full Name</label>
                @if ($errors->has('name'))
                    <span class="new red badge left">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <input id="username" type="text" class="validate" name="username" required {{ old('username') }}>
                <label for="username">Username</label>
                @if ($errors->has('username'))
                    <span class="new red badge left">{{ $errors->first('username') }}</span>
                @endif
              </div>
              <div class="input-field col s6">
                <input id="uplinker" type="text" class="validate" name="uplinker" value="{{ session('uplinker') }}">
                <label for="uplinker">Affilate/Referal Code (Optional)</label>
                @if ($errors->has('uplinker'))
                    <span class="new red badge left">{{ $errors->first('uplinker') }}</span>
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
                <label for="password_confirmation">Confirm Password</label>
                @if ($errors->has('password_confirmation'))
                    <span class="new red badge left">{{ $errors->first('password_confirmation') }}</span>
                @endif
              </div>
            </div>
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

            <button type="submit" class="btn right waves-effect waves-light blue"><i class="material-icons right">send</i> Register</button>
          </form>
        </div>
    </div>
</div>
@endsection
