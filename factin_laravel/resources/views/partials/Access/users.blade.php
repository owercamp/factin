
@extends('modules.settingAccess')

@section('info')
	<div class="w-100 d-flex p-2">
		<div class="col-md-4">
			<h5 class="text-left ml-4 mt-2 text-bold text-black-50">USUARIOS</h5>
		</div>
		<div class="col-md-4 d-flex justify-content-center">
			<a href="{{route('register')}}" class="btn btn-outline-secondary">Nuevo Usuario</a>
		</div>
		<div class="col-md-4">
			@if (session('SuccessAssign'))
				<div class="alert alert-success">
					{{session('SuccessAssign')}}
				</div>
			@endif
			@if (session('SecondaryAssign'))
				<div class="alert alert-warning">
					{{session('SocundaryAssign')}}
				</div>
			@endif
		</div>
	</div>
	<div class="container-fluid">
		<table class="table table-striped text-center">
			<thead>
				<tr>
					<th>#</th>
					<th>COLABORADOR</th>
					<th>ROL</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php
					$row = 1;
				@endphp
				@foreach ($data as $item)					
					<tr>
						<td>{{$row++}}</td>
						<td>{{$item->rec_users}}</td>
						<td>{{$item->rec_rol}}</td>
						<td>
							<a href="#" title="Asignar Rol" class="btn-edit form-control-sm assignRol-link">
								<span class="icon-drivers-license"></span>
								<span hidden>{{$item->rec_users}}</span>
								<span hidden>{{$item->rec_id}}</span>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="assignRol-form">
		<div class="modal-dialog" style="font-size: 15px;">
			<div class="modal-content">
				<div class="modal-header d-flex justify-content-center align-content-center">
					<h5>ASIGNACION ROL</h5>
				</div>
				<div class="modal-body w-100">
					<form action="{{route('role.assign')}}" method="post" class="w-75 m-auto">
						@csrf
						<div class="form-group">
							<small class="text-muted">USUARIO</small>
							<input type="text" name="user" class="form-control form-control-sm text-monospace">
						</div>
						<div class="form-group">
							<small class="text-muted">ROL</small>
							<select name="rol_User" class="form-control form-control-sm text-monospace">
								<option value="">Seleccione...</option>
								@foreach ($rol as $item)
									<option value="{{$item->name}}">{{$item->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="w-100 d-flex justify-content-evenly">
							<input type="hidden" name="userid">
							<button class="btn btn-secondary">CANCELAR</button>
							<button class="btn btn-success">ASIGNAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('ScriptZone')
	<script>
		$('.assignRol-link').click(function (e) { 
			e.preventDefault();
			let user = $(this).find('span:nth-child(2)').text();
			let id = $(this).find('span:nth-child(3)').text();
			$('input[name=user]').val(user);
			$('input[name=userid]').val(id);
			$('#assignRol-form').modal();
		});
	</script>
	@if (session('SuccessAssign'))
		<script>
			Swal.fire({
				icon: 'success',
				title: '¡ rol asignado !',
				timer: 3000,
				timerProgressBar: true,
				showConfirmButton: false,
				showClass: {
					popup: 'animate__animated animate__flipInX'
				},
				hideClass: {
				popup: 'animate__animated animate__flipOutX'
				}
			})
		</script>
	@endif
	@if (session('SecondaryAssign'))
		<script>
			Swal.fire({
				icon: 'error',
				title: 'Error al assignar el rol',
				timer: 3000,
				timerProgressBar: true,
				showConfirmButton: false,
				showClass: {
					popup: 'animate__animated animate__flipInX'
				},
				hideClass: {
				popup: 'animate__animated animate__flipOutX'
				}
			})
		</script>
	@endif
@endsection