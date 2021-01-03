
@extends('modules.settingHumanresources')

@section('info')
    <div>
		<div class="row border-bottom">
			<div class="col-md-4">
				<h6 class="navbar-brand">COLABORADORES</h6>
			</div>
			<div  class="col-md-4 text-center">
				<button type="button" title="Registrar" class="btn-success form-control-sm newMunipality-link"><b>Nuevo</b></button>
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
                    <th>NOMBRES COMPLETO</th>
                    <th>IDENTIFICACION</th>
					<th>DEPARTAMENTO</th>
					<th>MUNICIPIO</th>
					<th>DIRECCION</th>
					<th>TELEFONOS</th>
					<th>CORREO</th>
					<th>FOTO</th>
					<th>FIRMA</th>
					<th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>				
                
            </tbody>
        </table>
	</div>
@endsection

@section('ScriptZone')
	<script>
		$(function(){

		});
	</script>
@endsection