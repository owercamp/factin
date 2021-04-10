
@extends('home')

@section('title', 'Plan de Mercadeo')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('oportunity.index')}}"><span class="icon-fire"></span> {{__('Oportunidad de Negocio')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('tracking.index')}}"><span class="icon-clipboard"></span> {{__('Seguimiento de Negocio')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('archive.index')}}"><span class="icon-folder-open"></span> {{__('Archivo de Negocios')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('indicators.index')}}"><span class="icon-line-chart"></span> {{__('Indicadores de Exito')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection