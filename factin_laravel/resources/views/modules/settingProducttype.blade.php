
@extends('home')

@section('title', 'Productos')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('product.index')}}"><span class="icon-steam"></span> {{__('Creación de Productos')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('module.index')}}"><span class="icon-cube"></span> {{__('Creación de Modulos')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('config.index')}}"><span class="icon-cubes"></span> {{__('Configuración de Productos')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection