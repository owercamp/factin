
@extends('home')

@section('title', 'Contratación')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-stack-overflow"></span>
        <a class="text-primary" href="{{route('ClientLegalization.index')}}">{{__('Legalización Cliente')}}</a>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-shield"></span>
        <a class="text-primary" href="{{route('ContractLegalization.index')}}">{{__('Legalización Contrato')}}</a>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-group"></span>
        <a class="text-primary" href="{{route('ContractsFile.index')}}">{{__('Archivo Contrataciones')}}</a>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-group"></span>
        <a class="text-primary" href="{{route('SuccessIndicator.index')}}">{{__('Indicadores de Exito')}}</a>
    </li>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection
