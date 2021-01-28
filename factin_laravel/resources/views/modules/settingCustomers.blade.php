
@extends('home')

@section('title', 'Clientes Potenciales')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-fire"></span>
        <a class="text-primary" href="{{route('proposal.index')}}">{{__('Propuesta Comercial')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-clipboard"></span>
        <a class="text-primary" href="{{route('monitoring.index')}}">{{__('Seguimiento Comercial')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-folder-open"></span>
        <a class="text-primary" href="{{route('file.index')}}">{{__('Archivo Comercial')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-line-chart"></span>
        <a class="text-primary" href="{{route('indicators.index')}}">{{__('Indicadores de Exito')}}</a>
    </li>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection