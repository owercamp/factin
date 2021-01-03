
@extends('home')

@section('title', 'Productos')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-list-alt"></span>
        <a class="text-primary" href="{{route('product.index')}}">{{__('Creación de Productos')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-image"></span>
        <a class="text-primary" href="{{route('module.index')}}">{{__('Creación de Modulos')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-image"></span>
        <a class="text-primary" href="{{route('config.index')}}">{{__('Configuración de Productos')}}</a>
    </li>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection