@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title bg-card-header flex-justified container-fluid" style="display: inline-flex; padding:0.5%">
                    <span class="icon-sitemap"  style="margin-left: 2%; margin-top:0.12%"></span><h6 class="margin-auto container-fluid"><strong class="directionUri">{{ $_SERVER['REQUEST_URI'] }}</strong></h6>
                </div>
                <div class="card-body form-row">
                    @yield('modules')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

