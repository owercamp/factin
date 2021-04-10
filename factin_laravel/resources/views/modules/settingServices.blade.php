
@extends('home')

@section('title', 'Servicios')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('services.index')}}"><span class="icon-steam"></span> {{__('Creación de Servicios')}}</a>
    <div class="dropdown-divider form-divider"></div>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection