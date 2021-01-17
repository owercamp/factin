
@extends('home')

@section('title', 'Plan de Mercadeo')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-steam"></span>
        <a class="text-primary" href="{{route('oportunity.index')}}">{{__('Oportunidad de Negocio')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-cube"></span>
        <a class="text-primary" href="{{route('tracking.index')}}">{{__('Seguimiento de Negocio')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-cubes"></span>
        <a class="text-primary" href="{{route('archive.index')}}">{{__('Archivo de Negocios')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-cubes"></span>
        <a class="text-primary" href="{{route('indicators.index')}}">{{__('Indicadores de Exito')}}</a>
    </li>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection