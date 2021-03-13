
@extends('home')

@section('title', 'Seguimiento')

@section('modules')
    <div class="container-fluid" style="margin: 0.2% 10%">
        <div class="row">
            <div class="col-md-8">
                <h6 class="navbar-brand">SEGUIMIENTO</h6>
            </div>
            <div class="col-md-4">
                @if(session('SuccessCreation'))
                <div class="alert alert-success">
                    {{ session('SuccessCreation') }}
                </div>
                @endif
                @if(session('PrimaryCreation'))
                    <div class="alert alert-primary">
                    {{ session('PrimaryCreation') }}
                    </div>
                @endif
                @if(session('WarningCreation'))
                    <div class="alert alert-warning">
                        {{ session('WarningCreation') }}
                    </div>
                @endif
                @if(session('SecondaryCreation'))
                    <div class="alert alert-secondary">
                        {{ session('SecondaryCreation') }}
                    </div>
                @endif
            </div>
        </div>
        <table id="tableDatatable" class="table table-hover table-bordered text-center top-modal" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>IDENTIFICACION USUARIO</th>
                    <th>CLIENTE</th>
                    <th>NOMBRE USUARIO</th>
                    <th>N° CONTRATO</th>
                    <th>COLABORADOR</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $row = 1;
                @endphp
                @foreach ($follow as $item)
                    <tr>
                        <th>{{$row++}}</th>
                        <th>{{$item->foll_ide}}</th>
                        <th>{{$item->bt_social}}</th>
                        <th>{{$item->foll_user}}</th>
                        <th>{{sprintf("%'.04d\n",$item->fol_con)}}</th>
                        @if ($item->foll_cola != null)
                            <th>
                                @foreach ($collaborator as $col)
                                    @if($col->id = $item->foll_cola)
                                        {{$col->col_name}}
                                    @endif
                                @endforeach
                            </th>
                        @else
                            <th>{{__('AUN NO ASIGNADO')}}</th>
                        @endif
                        <th>
                            <a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
                                <span class="icon-magic"></span>
                            </a>
                            <a href="#" title="Respuesta" class="btn-delete form-control-sm RequestCreation-link">
                                <span class="icon-telegram"></span>
                            </a>
                            <a href="#" title="Asignación" class="btn-edit form-control-sm AssignCreation-link">
                                <span class="icon-handshake-o"></span>
                            </a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @php
        $yearnow = date('Y');
        $mountnow = date('m');
        $yearfutureOne = date('Y') + 1;
        $yearfutureTwo = date('Y') + 2;
        $yearfutureThree = date('Y') + 3;
        $yearfutureFour = date('Y') + 4;
        $yearfutureFive = date('Y') + 5;
        $yearfutureSix = date('Y') + 6;
        $yearfutureSeven = date('Y') + 7;
    @endphp

@endsection

@section('ScriptZone')
	<script>
		$(function(){

		});
	</script>
@endsection
