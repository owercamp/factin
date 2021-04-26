
@extends('home')

@section('title', 'Financiera')
    
@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('billingorder.finance')}}"><span class="icon-file-text-o"></span> {{__('Orden Facturación')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('comission.finance')}}"><span class="icon-list-ul"></span> {{__('Liquidación Comisiones')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('sales.index')}}"><span class="icon-line-chart"></span> {{__('Estadisticas Ventas')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="#"><span class="icon-pie-chart"></span> {{__('Estadisticas Comisiones')}}</a>
    <div class="dropdown-divider form-divider"></div>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>    
@endsection