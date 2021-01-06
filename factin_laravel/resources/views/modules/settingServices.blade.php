
@extends('home')

@section('title', 'Servicios')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <li class="nav-link nav-config-user text-primary">
        <span class="icon-steam"></span>
        <a class="text-primary" href="{{route('services.index')}}">{{__('Creación de Servicios')}}</a>
    </li>
    <div class="dropdown-divider form-divider"></div>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection