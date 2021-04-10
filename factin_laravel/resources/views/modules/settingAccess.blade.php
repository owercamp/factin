
@extends('home')

@section('title', 'Accesos')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class=" list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('access.roles')}}"><span class="icon-stack-overflow"></span> {{__('Roles')}}</a>
    <div class="dropdown-divider"></div>
    <a class=" list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('access.permission')}}"><span class="icon-shield"></span> {{__('Permisos')}}</a>
    <div class="dropdown-divider"></div>
    <a class=" list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('access.users')}}"><span class="icon-group"></span> {{__('Usuarios')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>    
@endsection