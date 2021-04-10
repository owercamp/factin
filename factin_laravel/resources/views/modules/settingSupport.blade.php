
@extends('home')

@section('title', 'Soporte')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="text-primary" href="{{route('request.index')}}"><span class="icon-fire"></span> {{__('Solicitudes')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('programming.index')}}"><span class="icon-clipboard"></span> {{__('Programación')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('tracing.index')}}"><span class="icon-folder-open"></span>{{__('Seguimiento')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('qualification.index')}}"><span class="icon-line-chart"></span> {{__('Calificación')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('archive.index')}}"><span class="icon-line-chart"></span> {{__('Archivo')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection
