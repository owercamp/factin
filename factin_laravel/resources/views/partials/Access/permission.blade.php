
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
	<div class="d-flex justify-content-center align-items-center position-fixed bg-update margin-position-fixed d-none-important">
		<div class="spinner-cubo"></div>
		<p class="text-update bg-font-fixed">actualizando permisos</p>
	</div>
	<div class="w-100 container-fluid p-2">
		<form action="{{route('permmission.add')}}" method="post" class="formPermissions">
			@csrf
			<input type="hidden" name="rol">
			<div class="w-100 d-flex justify-content-around mt-2 pt-3">
				<div class="d-flex flex-column w-25 border-secondary border text-center h-fit-content">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">CONFIGURACION</h5>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="access"> Acceso</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="location"> Ubicaciones</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="company"> Empresa</label>
					</div>
				</div>
				<div class="d-flex flex-column w-25 border-secondary border text-center h-fit-content">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">ADMINISTRACION</h5>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="humanResources"> Recursos Humanos</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="typeProducts"> Tipo de Productos</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="typeServices"> Tipo de Servicios</label>
					</div>
				</div>
				<div class="d-flex flex-column w-25 border-secondary border text-center h-fit-content">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">FINANCIERA</h5>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="statusFinance"> Estado de Cuentas</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="commercialTrade"> Movimientos Comerciales</label>
					</div>					
				</div>				
			</div>
			{{-- segunda linea --}}
			<div class="w-100 d-flex justify-content-around mt-3 pt-3 pb-2">
				<div class="d-flex flex-column w-25 border-secondary border text-center h-fit-content">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">SOPORTE</h5>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="requests"> Solicitudes</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="programing"> Programación</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="monitoring"> Seguimiento</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="qualities"> Calificación</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="archive"> Archivo</label>
					</div>
				</div>
				<div class="d-flex flex-column w-25 border-secondary border text-center h-fit-content">
					<div class="border-bottom bg-primary-50 border border-secondary">
						<h5 class="m-2">COMERCIAL</h5>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="portfolio"> Portafolio</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="marketingPlan"> Plan de Mercadeo</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="potentialCustomer"> Clientes Potenciales</label>
					</div>
					<div class="form-group  mb-n1">						
						<label class="text-capitalize w-100"><input type="checkbox" name="contract"> Contratación</label>
					</div>
				</div>
			</div>
			<div class="w-100 d-flex justify-content-around m-3 p-4 border-top border-secondary">
				<button type="button" class="btn btn-outline-danger">CANCELAR</button>
				<button type="button" class="btn btn-outline-success">ACTUALIZAR PERMISOS</button>
			</div>
		</form>
	</div>
@endsection

@section('ScriptZone')
	<script>

		$('.btn-outline-success').click(function (e) { 
			e.preventDefault();			
			if ($('select[name=roleSelected]').val() != "") {
				$('.bg-update').removeClass('d-none-important');
				setTimeout(
					$('.formPermissions').submit(), 5000
				);
			}else{
				const alerts = Swal.mixin({
				timer:4000,
                timerProgressBar: true,
                showConfirmButton: false,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                showClass: {
                    popup: 'animate__animated animate__flipInX'
                },
                hideClass: {
                    popup: 'animate__animated animate__flipOutX'
                }
			});
			alerts.fire({
				icon: 'warning',
                title: '<h3 class="text-info">Sin Rol Seleccionado</h3>',
                html: '<p class="text-center text-dark">seleccione un rol para actualizar</p>'
			});
			}
		});
		// al cambiar la lista de los roles
		$('select[name=roleSelected]').change(function (e) { 
			e.preventDefault();			
			let rol = $('select[name=roleSelected]').val();
			$('input[name=rol]').val(rol);
			$.get("{{route('getPermissionRol')}}", {data: rol},
				function (objectPermissionRol) {
					objectPermissionRol.forEach(element => {						
						if (element.permission_id == "1") {
							$('input[name=access]').prop('checked',true);
							// $('input[name=access]').val('1');
						}
						if (element.permission_id == '7') {
							$('input[name=location]').prop('checked',true);
						}
						if (element.permission_id == '15') {
							$('input[name=company]').prop('checked',true);
						}
						if (element.permission_id == '24') {
							$('input[name=humanResources]').prop('checked',true);
						}
						if (element.permission_id == '33') {
							$('input[name=typeProducts]').prop('checked',true);
						}
						if (element.permission_id == '45') {
							$('input[name=typeServices]').prop('checked',true);
						}
						if (element.permission_id == '112') {
							$('input[name=statusFinance]').prop('checked',true);
						}
						if (element.permission_id == '114') {
							$('input[name=commercialTrade]').prop('checked',true);
						}
						if (element.permission_id == '97') {
							$('input[name=requests]').prop('checked',true);
						}
						if (element.permission_id == '100') {
							$('input[name=programing]').prop('checked',true);
						}
						if (element.permission_id == '103') {
							$('input[name=monitoring]').prop('checked',true);
						}
						if (element.permission_id == '107') {
							$('input[name=qualities]').prop('checked',true);
						}
						if (element.permission_id == '108') {
							$('input[name=archive]').prop('checked',true);
						}
						if (element.permission_id == '49') {
							$('input[name=portfolio]').prop('checked',true);
						}
						if (element.permission_id == '65') {
							$('input[name=marketingPlan]').prop('checked',true);
						}
						if (element.permission_id == '74') {
							$('input[name=potentialCustomer]').prop('checked',true);
						}
						if (element.permission_id == '85') {
							$('input[name=contract]').prop('checked',true);
						}
					});
				}
			);			
		});
	</script>
	@if (session('SuccessCreation'))
		<script>
			const alerts = Swal.mixin({
				timer:2000,
                timerProgressBar: true,
                showConfirmButton: false,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                showClass: {
                    popup: 'animate__animated animate__flipInX'
                },
                hideClass: {
                    popup: 'animate__animated animate__flipOutX'
                }
			});
			alerts.fire({
				icon: 'success',
                title: '<h3 class="text-success">Permisos Actualizados</h3>',
                html: '<p class="text-center text-dark">los permisos han sido agregados correctamente</p>'
			});
		</script>
	@endif
@endsection