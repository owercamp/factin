
@extends('home')

@section('title', 'Recursos Humanos')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-list-alt"></span>
        <a class="text-primary" href="{{route('collaborator.index')}}">{{__('Colaboradores')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-image"></span>
        <a class="text-primary" href="{{route('usersclient.index')}}">{{__('Usuarios Clientes')}}</a>
    </li>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection