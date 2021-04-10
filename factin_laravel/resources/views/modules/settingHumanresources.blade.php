
@extends('home')

@section('title', 'Recursos Humanos')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('collaborator.index')}}"><span class="icon-joomla"></span> {{__('Colaboradores')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('usersclient.index')}}"><span class="icon-street-view"></span> {{__('Usuarios Clientes')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection