
@extends('modules.settingHumanresources')

@section('info')
	<div>
		<div class="row border-bottom">
			<div class="col-md-4">
				<h6 class="navbar-brand">USUARIO CLIENTES</h6>
			</div>
			<div  class="col-md-4 text-center">
				<button type="button" title="Registrar" class="btn-success form-control-sm newProductWeb-link"><b>Nuevo Usuario</b></button>
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
					<th>CLIENTE</th>
					<th>USUARIO</th>
					<th>CORREO</th>
                    <th>TELEFONOS</th>
                    <th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row=1; @endphp
                @foreach ($user_client as $item)
                        <tr>
                            <th>{{$row++}}</th>
                            <th>{{$item->bt_social}}</th>
                            <th>{{$item->uc_users}}</th>
                            <th>{{$item->uc_email}}</th>
                            <th>{{$item->uc_pho1}} - {{$item->uc_pho2}} - {{$item->uc_pho3}}</th>
                            <th>
                                <a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
                                    <span class="icon-magic"></span>
                                </a>
                                <a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
                                    <span class="icon-proxmox"></span>
                                </a>
                                <a href="#" title="Imprimir" class="btn-edit form-control-sm Imprimir-PDF">
                                    <span class="icon-arrow-circle-down"></span>
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
	{{-- creación de mi formulario de creación documento --}}
	<div class="modal fade" id="newCreation-modal">
		<div class="modal-dialog modal-lg" style="font-size: 15px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>NUEVO USUARIO CLIENTE</h6>
				</div>
				<div class="modal-body">
					<form action="{{route('usersclient.save')}}" method="POST" style="padding: 1% 3%">
						@csrf
						<div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">CLIENTE:</small>
                                    <select name="uc_cli" class="form-control form-control-sm" required>
                                        <option value="">Seleccione Producto</option>
                                        @foreach ($client as $item)
                                            @if ($item->con_final >= date('Y-m-d'))
                                                <option value="{{$item->con_id}}">{{$item->bt_social}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">NOMBRE USUARIO</small>
                                    <input type="text" name="uc_user" style="text-transform: uppercase" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">TIPO DE DOCUMENTO</small>
                                    <select name="uc_type" class="form-control form-control-sm">
                                        <option value="">Seleccione ...</option>
                                        <option value="CEDULA DE CIUDADANIA">CEDULA DE CIUDADANIA</option>
                                        <option value="NIT">NIT</option>
                                        <option value="PASAPORTE">PASAPORTE</option>
                                        <option value="CEDULA DE EXTRANJERIA">CEDULA DE EXTRANJERIA</option>
                                    </select>
                                </div>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">N° DEL DOCUMENTO</small>
                                    <input type="text" name="uc_ide" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <small class="text-muted">CORREO ELECTRONICO</small>
                                    <input type="email" name="uc_ema" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">TELEFONO 1</small>
                                    <input type="text" name="uc_pho1" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">TELEFONO 2</small>
                                    <input type="text" name="uc_pho2" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">TELEFONO 3</small>
                                    <input type="text" name="uc_pho3" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-6" style="padding: 2% 20%">
								<button type="submit" class="btn btn-success form-control-sm"><b>GUARDAR</b></button>
							</div>
							<div class="col-md-6" style="padding: 2% 12%">
								<button type="button" class=" btn btn-secondary form-control-sm" data-dismiss="modal"><b>CANCELAR</b></button>
							</div>
						</div>
						{{-- <div class="form-group text-center mt-3">
							<button type="submit" class="btn-success form-control-sm btn-saveDefinitive"><b>GUARDAR</b></button>
						</div> --}}
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- creación de mi formulario de edicion --}}
	{{-- <div class="modal fade" id="newEditWeb-modal">
		<div class="modal-dialog" style="font-size: 15px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>EDITAR PORTAFOLIO WEB</h6>
				</div>
				<div class="modal-body">
					<form action="#" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12 container-sm">
								<div class="row justify-content-center">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL PRODUCTO WEB:</small>
											<select name="porweb_Edit" class="form-control form-control-sm" required>
												@foreach ($configpro as $productitem)
													<option value="{{$productitem->pc_id}}">{{$productitem->pro_name}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<small class="text-muted">PRECIO:</small>
											<input type="text" name="porprice_Edit" id="priceMoney_Edit" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="por_id_Edit" readonly required>
								<button type="submit" class="btn btn-edit form-control-sm my-3">GUARDAR CAMBIOS</button>
							</div>
							<div class="col-md-6">
								<button type="button" class="btn btn-delete mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> --}}

	{{-- creación de mi formulario de eliminación --}}
	{{-- <div class="modal fade" id="newDeleteWeb-modal">
		<div class="modal-dialog" style="font-size: 15px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION PORTAFOLIO WEB</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NOMBRE DEL PORTAFOLIO WEB</small><br>
                            <span class="text-muted"><b class="porweb_Delete"></b></span><br>
                            <small class="text-muted">PRECIO</small><br>
							<span class="text-muted"><b class="porprice_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="#" method="POST" class="col-md-6 DeleteSend">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="por_id_Delete" readonly required>
							<button type="submit" class="btn btn-edit form-control-sm my-3">ELIMINAR</button>
						</form>
						<div class="col-md-6">
							<button type="button" class="btn btn-delete mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
@endsection

@section('ScriptZone')

    <script>
        // Llama al formulario modal de creación
        $('.newProductWeb-link').click(function () {
            $('#newCreation-modal').modal();
        });
    </script>

	@if(session('SuccessCreation'))
	<script>
		Swal.fire({
			icon: 'success',
			title: '¡creado con exito!',
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
	@if(session('SecondaryCreation'))
	<script>
		Swal.fire({
			icon: 'error',
			title: 'Oops..',
			text: '¡registro existente!',
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
	@if (session('SecondCreation') == "NoEncontrado")
		<script>
			Swal.fire({
				icon: 'error',
				title: 'Oops..',
				text: 'Producto Web no encontrado',
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
	@if (session('PrimaryCreation'))
		<script>
			Swal.fire({
				icon: 'success',
				title: '¡actualizado con exito!',
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
	@if (session('WarningCreation'))
		<script>
			Swal.fire({
				icon: 'success',
				title: '¡eliminado con exito!',
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
