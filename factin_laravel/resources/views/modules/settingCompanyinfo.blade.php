
@extends('home')

@section('title', 'Empresa')

@section('modules')
<ul class="col-2 text-center flex-justified">
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('company.information')}}"><span class="icon-list-alt"></span> {{__('Información Corporativa')}}</a>
    <div class="dropdown-divider form-divider"></div>
    <a class="list-group-item-action list-group-item-success w-100 p-3 btn btn-success text-dark" href="{{route('company.image')}}"><span class="icon-image"></span> {{__('Imagen Corporativa')}}</a>
</ul>
<div class="col-9 left-modal">
    @yield('info')
</div>
@endsection