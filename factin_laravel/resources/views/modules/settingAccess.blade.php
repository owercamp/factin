
@extends('home')

@section('title', 'Accesos')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-stack-overflow"></span>        
        <a class="text-primary" href="{{route('access.roles')}}">{{__('Roles')}}</a>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-shield"></span>
        <a class="text-primary" href="{{route('access.permission')}}">{{__('Permisos')}}</a>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-group"></span>
        <a class="text-primary" href="{{route('access.users')}}">{{__('Usuarios')}}</a>
    </li>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>    
@endsection