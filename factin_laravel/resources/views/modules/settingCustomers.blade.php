
@extends('home')

@section('title', 'Clientes Potenciales')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('proposal.index')}}"><span class="icon-fire"></span> {{__('Propuesta Comercial')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('monitoring.index')}}"><span class="icon-clipboard"></span> {{__('Seguimiento Comercial')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('file.index')}}"><span class="icon-folder-open"></span> {{__('Archivo Comercial')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('indicators.index')}}"><span class="icon-line-chart"></span> {{__('Indicadores de Exito')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection