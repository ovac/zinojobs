@extends('layouts.app')
@section('styles')

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="/css/materialize.min.css">
@endsection

{{-- @section('content') --}}
  <style type="text/css">
  html, body {
    background: radial-gradient(circle farthest-side at right bottom,#414b82 34%,#bbdefb 100%);
  }
  .header__background {
    position: absolute;
    display: block;
    pointer-events: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 0;
  }
  </style>

  <canvas class="header__background"></canvas>
  {{-- <div class="container-fluid"> --}}

  <div class="row white z-depth-3">
      <a href="/">
        <img src="/img/logo.png" alt="" class="responsive-img center-align center-block" style="height:100px">
      </a>
  </div>

  <div class="row valign-wrapper">

    @yield('form')
  </div>

@section('script')
  <script src="/js/materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.1.0/particles.min.js"></script>

   <script type="text/javascript">
     Particles.init({
            selector: '.header__background',
            maxParticles: 200,
            color: '#bbdefb',
            connectParticles: false,
            speed: 1
          });
   </script>
   {{-- {!! NoCaptcha::renderJs() !!} --}}
@endsection
