@extends('quarx::layouts.master')

@section('navigation')

<div class="raw100 raw-left navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button class="navbar-toggle sidebar-menu-btn">
            <span class="fa fa-bars nav-open"></span>
            <span class="fa fa-close nav-close"></span>
        </button>
        <span class="navbar-brand">
            <a href="/"><img src="/img/logo.png" alt="" height="30px"></a>
        </span>
        @if (Auth::user())
        <p class="navbar-text navbar-left raw-m-hide">Signed in as {{ Auth::user()->name }}</p>
        @endif
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
            <span class="fa fa-gear"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse navbar-right" id="mainNavbar">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('/') }}"><span class="fa fa-arrow-left"></span> Back To Site </a></li>
            @if (Auth::user())
            <li><a href="/logout"><span class="fa fa-sign-out"></span> Logout</a></li>
            @endif
        </ul>
    </div>
</div>

@stop
