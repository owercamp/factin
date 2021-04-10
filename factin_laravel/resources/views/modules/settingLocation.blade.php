
@extends('home')

@section('title', 'Ubicaciones')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('location.located')}}"><span class="icon-map"></span> {{__('Departamentos')}}</a>
    <div class="dropdown-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('municipalities.municipality')}}"><span class="icon-leanpub"></span> {{__('Municipios')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection