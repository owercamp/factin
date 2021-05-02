
@extends('modules.settingAccess')

@section('info')
	<div class="w-100 row">
		<div class="col-md-6">
			<h3 class="text-monospace text-black-50 ml-5">PERMISOS</h3>
		</div>
		<div class="col-md-6 d-flex flex-row-reverse ml-n5">
			<select name="roleSelected" class=" w-50 form-control form-control-sm text-monospace">
				<option value="">Seleccione...</option>
				@foreach ($role as $item)
					<option value="{{$item->id}}">{{$item->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="w-100 container p-2">
		<form action="" method="post">
			<div class="w-100 d-flex justify-content-around">
				<div class="d-flex flex-column w-25 border-secondary border text-center">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">CONFIGURACION</h5>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="access">
						<label class="text-capitalize">Acceso</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="location">
						<label class="text-capitalize">Ubicaciones</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="company">
						<label class="text-capitalize">Empresa</label>
					</div>
				</div>
				<div class="d-flex flex-column w-25 border-secondary border text-center">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">ADMINISTRACION</h5>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="humanResources">
						<label class="text-capitalize">Recursos Humanos</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="typeProducts">
						<label class="text-capitalize">Tipo de Productos</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="typeServices">
						<label class="text-capitalize">Tipo de Servicios</label>
					</div>
				</div>
				<div class="d-flex flex-column w-25 border-secondary border text-center">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">COMERCIAL</h5>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="portfolio">
						<label class="text-capitalize">Portafolio</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="marketingPlan">
						<label class="text-capitalize">Plan de Mercadeo</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="potentialCustomer">
						<label class="text-capitalize">Clientes Potenciales</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="contract">
						<label class="text-capitalize">Contratación</label>
					</div>
				</div>
			</div>
			{{-- segunda linea --}}
			<div class="w-100 d-flex justify-content-around mt-3">
				<div class="d-flex flex-column w-25 border-secondary border text-center">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">SOPORTE</h5>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="request">
						<label class="text-capitalize">Solicitudes</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="programing">
						<label class="text-capitalize">Programación</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="monitoring">
						<label class="text-capitalize">Seguimiento</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="qualities">
						<label class="text-capitalize">Calificación</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="archive">
						<label class="text-capitalize">Archivo</label>
					</div>
				</div>
				<div class="d-flex flex-column w-25 border-secondary border text-center">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">FINANCIERA</h5>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="statusFinance">
						<label class="text-capitalize">Estado de Cuentas</label>
					</div>
					<div class="form-group mt-1 mb-n1">
						<input type="checkbox" name="commercialTrade">
						<label class="text-capitalize">Movimientos Comerciales</label>
					</div>					
				</div>
			</div>
		</form>
	</div>
@endsection

@section('ScriptZone')
	<script>
		$(function(){

		});
	</script>
@endsection