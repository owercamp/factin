
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
                                <a href="#" title="Editar" class="btn-edit form-control-sm editCreation-link">
                                    <span class="icon-magic"></span>
                                    <span hidden>{{$item->id}}</span>
                                    <span hidden>{{$item->uc_cli}}</span>
                                    <span hidden>{{$item->uc_users}}</span>
                                    <span hidden>{{$item->uc_type}}</span>
                                    <span hidden>{{$item->uc_ide}}</span>
                                    <span hidden>{{$item->uc_email}}</span>
                                    <span hidden>{{$item->uc_pho1}}</span>
                                    <span hidden>{{$item->uc_pho2}}</span>
                                    <span hidden>{{$item->uc_pho3}}</span>
                                </a>
                                <a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
                                    <span class="icon-proxmox"></span>
                                    <span hidden>{{$item->id}}</span>
                                    <span hidden>{{$item->uc_cli}}</span>
                                    <span hidden>{{$item->uc_users}}</span>
                                    <span hidden>{{$item->uc_email}}</span>
                                </a>
                                <a href="#" title="Imprimir" class="btn-edit form-control-sm Imprimir-PDF">
                                    <span class="icon-arrow-circle-down"></span>
                                    <span hidden>{{$item->id}}</span>
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
                                    <input type="text" name="uc_email" class="form-control form-control-sm">
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
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- creación de mi formulario de edicion --}}
	<div class="modal fade" id="newCreationEdit-modal">
		<div class="modal-dialog modal-lg" style="font-size: 15px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>EDITAR USUARIO CLIENTE</h6>
				</div>
				<div class="modal-body">
                    <form action="{{route('usersclient.edit')}}" method="POST" style="padding: 1% 3%">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">CLIENTE:</small>
                                    <select name="uc_cli_Edit" class="form-control form-control-sm" required>
                                        <option value="">Seleccione Producto</option>
                                        @foreach ($client as $item)
                                            {{-- @if ($item->con_final >= date('Y-m-d')) --}}
                                                <option value="{{$item->con_id}}">{{$item->bt_social}}</option>
                                            {{-- @endif --}}
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">NOMBRE USUARIO</small>
                                    <input type="text" name="uc_user_Edit" style="text-transform: uppercase" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">TIPO DE DOCUMENTO</small>
                                    <select name="uc_type_Edit" class="form-control form-control-sm">
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
                                    <input type="text" name="uc_ide_Edit" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <small class="text-muted">CORREO ELECTRONICO</small>
                                    <input type="text" name="uc_email_Edit" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">TELEFONO 1</small>
                                    <input type="text" name="uc_pho1_Edit" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">TELEFONO 2</small>
                                    <input type="text" name="uc_pho2_Edit" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <small class="text-muted">TELEFONO 3</small>
                                    <input type="text" name="uc_pho3_Edit" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="padding: 2% 20%">
                                <input type="hidden" name="uc_id_Edit" class="form-control form-control-sm">
                                <button type="submit" class="btn btn-success form-control-sm"><b>GUARDAR</b></button>
                            </div>
                            <div class="col-md-6" style="padding: 2% 12%">
                                <button type="button" class=" btn btn-secondary form-control-sm" data-dismiss="modal"><b>CANCELAR</b></button>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>

	{{-- creación de mi formulario de eliminación --}}
	<div class="modal fade" id="newDelete-modal">
		<div class="modal-dialog" style="font-size: 15px;">
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>ELIMINACION USUARIO CLIENTE</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">CLIENTE</small><br>
                            <span class="text-muted"><b class="uc_cli_Delete"></b></span><br>
                            <small class="text-muted">USUARIO</small><br>
							<span class="text-muted"><b class="uc_user_Delete"></b></span><br>
                            <small class="text-muted">CORREO</small><br>
                            <span class="text-muted"><b class="uc_ema_Delete"></b></span>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{route('usersclient.delete')}}" method="POST" class="col-md-6 DeleteSend">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="uc_id_Delete" readonly required>
							<button type="submit" class="btn btn-edit form-control-sm my-3">ELIMINAR</button>
						</form>
						<div class="col-md-6">
							<button type="button" class="btn btn-delete mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <form action="{{route('userclient.printer')}}" method="post" class="invisible usercli">
        @csrf
        <input type="text" name="user_cli_id">
    </form>
@endsection

@section('ScriptZone')
    <script>
        // envia el id del usuario a imprimir
        $('.Imprimir-PDF').click(function () {
            let id = $(this).find('span:nth-child(2)').text();
            $('input[name=user_cli_id]').val(id);
            $('.usercli').submit();
        });
        // Llama al formulario modal de creación
        $('.newProductWeb-link').click(function () {
            $('#newCreation-modal').modal();
        });

        $('.editCreation-link').click(function(e){
			Swal.fire({
				title: 'Desea editar este registro?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#f58f4d',
                confirmButtonText: 'Si, editar',
                cancelButtonText: 'No',
                showClass: {
                popup: 'animate__animated animate__flipInX'
			},
                hideClass: {
                popup: 'animate__animated animate__flipOutX'
                },
            }).then((result) => {
                if (result.isConfirmed) {
					e.preventDefault();
                    let id,cli,user,type,ide,ema,pho1,pho2,pho3;
                    id = $(this).find('span:nth-child(2)').text();
                    cli = $(this).find('span:nth-child(3)').text();
                    user = $(this).find('span:nth-child(4)').text();
                    type = $(this).find('span:nth-child(5)').text();
                    ide = $(this).find('span:nth-child(6)').text();
                    ema = $(this).find('span:nth-child(7)').text();
                    pho1 = $(this).find('span:nth-child(8)').text();
                    pho2 = $(this).find('span:nth-child(9)').text();
                    pho3 = $(this).find('span:nth-child(10)').text();
                    console.log(id,cli,user,type,ide,ema,pho1,pho2,pho3);
                    $('select[name=uc_cli_Edit]').val(cli);
                    $('input[name=uc_user_Edit]').val(user);
                    $('select[name=uc_type_Edit]').val(type);
                    $('input[name=uc_ide_Edit]').val(ide);
                    $('input[name=uc_email_Edit]').val(ema);
                    $('input[name=uc_pho1_Edit]').val(pho1);
                    $('input[name=uc_pho2_Edit]').val(pho2);
                    $('input[name=uc_pho3_Edit]').val(pho3);
                    $('input[name=uc_id_Edit]').val(id);
					$('#newCreationEdit-modal').modal();
				}
			})
		});

        $('.deleteCreation-link').click(function (e) {
            e.preventDefault();
            let id,cli,user,ema;
            id = $(this).find('span:nth-child(2)').text();
            cli = $(this).find('span:nth-child(3)').text();
            user = $(this).find('span:nth-child(4)').text();
            ema = $(this).find('span:nth-child(5)').text();
            $.get("{{route('getRazonSocialUser')}}", {data: id},
                function (objectSocialClientUser) {
                    console.log(objectSocialClientUser);
                    $('b.uc_cli_Delete').text(objectSocialClientUser[0]['bt_social']);
                }
            );
            $('b.uc_user_Delete').text(user);
            $('b.uc_ema_Delete').text(ema);
            $('input[name=uc_id_Delete]').val(id);
            $('#newDelete-modal').modal();
        });

        // envia el formulario de eliminación
		$('.DeleteSend').submit('click', function(e){
			e.preventDefault();
			Swal.fire({
				title: '¡¡Eliminación!!',
				text: "Desea continuar con la eliminación",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#f58f4d',
				confirmButtonText: 'Si, Eliminar',
				cancelButtonText: 'No',
				showClass: {
				popup: 'animate__animated animate__flipInX'
				},
				hideClass: {
				popup: 'animate__animated animate__flipOutX'
				},
			}).then((result) => {
				if (result.isConfirmed) {
					this.submit();
				}
			})
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
