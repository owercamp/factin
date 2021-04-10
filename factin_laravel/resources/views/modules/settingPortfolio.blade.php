
@extends('home')

@section('title', 'Portafolio')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('factin.index')}}"><span class="icon-globe"></span> {{__('Factin Web')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('software.index')}}"><span class="icon-code"></span> {{__('Software')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('hardware.index')}}"><span class="icon-laptop"></span> {{__('Hardware')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('support.index')}}"><span class="icon-cogs"></span> {{__('Soporte Tecnico')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection