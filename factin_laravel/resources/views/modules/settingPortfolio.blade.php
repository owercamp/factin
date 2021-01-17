
@extends('home')

@section('title', 'Portafolio')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-globe"></span>
        <a class="text-primary" href="{{route('factin.index')}}">{{__('Factin Web')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-code"></span>
        <a class="text-primary" href="{{route('software.index')}}">{{__('Software')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-laptop"></span>
        <a class="text-primary" href="{{route('hardware.index')}}">{{__('Hardware')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-cogs"></span>
        <a class="text-primary" href="{{route('support.index')}}">{{__('Soporte Tecnico')}}</a>
    </li>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection