
@extends('home')

@section('title', 'Contratación')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('ClientLegalization.index')}}"><span class="icon-stack-overflow"></span> {{__('Legalización Cliente')}}</a>    
    <div class="dropdown-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('ContractLegalization.index')}}"><span class="icon-shield"></span> {{__('Legalización Contrato')}}</a>
    <div class="dropdown-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('ContractsFile.index')}}"><span class="icon-group"></span> {{__('Archivo Contrataciones')}}</a>
    <div class="dropdown-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('SuccessIndicator.index')}}"><span class="icon-group"></span> {{__('Indicadores de Exito')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection
