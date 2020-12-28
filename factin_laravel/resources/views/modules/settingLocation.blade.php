
@extends('home')

@section('title', 'Ubicaciones')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-map"></span>
        <a class="text-primary" href="{{route('location.located')}}">{{__('Departamentos')}}</a>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-leanpub"></span>
        <a class="text-primary" href="{{route('municipalities.municipality')}}">{{__('Municipios')}}</a>
    </li>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection