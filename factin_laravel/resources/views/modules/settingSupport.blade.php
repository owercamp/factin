
@extends('home')

@section('title', 'Soporte')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-fire"></span>
        <a class="text-primary" href="{{route('request.index')}}">{{__('Solicitudes')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-clipboard"></span>
        <a class="text-primary" href="{{route('programming.index')}}">{{__('Programación')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-folder-open"></span>
        <a class="text-primary" href="{{route('tracing.index')}}">{{__('Seguimiento')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-line-chart"></span>
        <a class="text-primary" href="{{route('qualification.index')}}">{{__('Calificación')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-line-chart"></span>
        <a class="text-primary" href="{{route('archive.index')}}">{{__('Archivo')}}</a>
    </li>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection
