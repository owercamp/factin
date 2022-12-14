
@extends('modules.settingPortfolio')

@section('info')
	<div>
		<div class="row border-bottom">
			<div class="col-md-4">
				<h6 class="navbar-brand">SOPORTE TECNICO</h6>
			</div>
			<div  class="col-md-4 text-center">
				<button type="button" title="Registrar" class="btn-success form-control-sm newCreation-link"><b>Nuevo</b></button>
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
					<th>PRODUCTO</th>
					<th>VALOR</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row=1; @endphp
				@foreach ($tsupport as $item)
				<tr>
					<td>{{$row++}}</td>
					<td>{{$item->pro_name}}</td>
					<td><b>{{number_format($item->tsprice,0,',','.')}}</b></td>
					<td>
						<a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
							<span class="icon-magic"></span>
							<span hidden>{{ $item->id }}</span>
							<span hidden>{{ $item->pro_name }}</span>
							<span hidden>{{ $item->tsprice }}</span>
							<span hidden>{{ $item->cpro_id }}</span>
						</a>
						<a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
							<span class="icon-proxmox"></span>
							<span hidden>{{ $item->id }}</span>
							<span hidden>{{ $item->pro_name }}</span>
							<span hidden>{{ $item->tsprice }}</span>
							<span hidden>{{ $item->cpro_id }}</span>
						</a>
					</td>
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
	{{-- creaci??n de mi formulario de creaci??n documento --}}
	<div class="modal fade" id="newCreationTS-modal">
		<div class="modal-dialog" style="font-size: 15px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>NUEVO PORTAFOLIO SOPORTE TECNICO</h6>
				</div>
				<div class="modal-body">
					<form action="{{route('support.save')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12 container-sm">
								<div class="row justify-content-center">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">SOPORTE TECNICO:</small>
											<select name="ports" class="form-control form-control-sm" required>
												<option value="">Seleccione Producto</option>
												@foreach ($configspro as $item)
													<option value="{{$item->pc_id}}">{{$item->pro_name}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<small class="text-muted">PRECIO:</small>
											<input type="text" name="portsprice" id="priceMoney" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<button type="submit" class="btn-success form-control-sm btn-saveDefinitive"><b>GUARDAR</b></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- creaci??n de mi formulario de edicion --}}
	<div class="modal fade" id="newEditTS-modal">
		<div class="modal-dialog" style="font-size: 15px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>EDITAR PORTAFOLIO SOPORTE TECNICO</h6>
				</div>
				<div class="modal-body">
					<form action="{{route('support.update')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12 container-sm">
								<div class="row justify-content-center">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">SOPORTE TECNICO:</small>
											<select name="ports_Edit" class="form-control form-control-sm" required>
												@foreach ($configspro as $productitem)
													<option value="{{$productitem->pc_id}}">{{$productitem->pro_name}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<small class="text-muted">PRECIO:</small>
											<input type="text" name="portsprice_Edit" id="priceMoney_Edit" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="id_Edit" readonly required>
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
	</div>

	{{-- creaci??n de mi formulario de eliminaci??n --}}
	<div class="modal fade" id="newDeleteTS-modal">
		<div class="modal-dialog" style="font-size: 15px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION SOPORTE TECNICO</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">SOPORTE TECNICO</small><br>
                            <span class="text-muted"><b class="ports_Delete"></b></span><br>
                            <small class="text-muted">PRECIO</small><br>
							<span class="text-muted"><b class="portsprice_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{route('support.delete')}}" method="POST" class="col-md-6 DeleteSend">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="id_Delete" readonly required>
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
@endsection

@section('ScriptZone')
	<script>
		$('.newCreation-link').click(function () {
			$('#newCreationTS-modal').modal();
		});

        $('input[name=portsprice]').focus(function () {
            let price = $('input[name=portsprice]').val();
            let vprice = price.replace(/\./g,"");
            $('input[name=portsprice]').val(vprice);
        });

        $('input[name=portsprice_Edit]').focus(function () {
            let price = $('input[name=portsprice_Edit]').val();
            let vprice = price.replace(/\./g,"");
            $('input[name=portsprice_Edit]').val(vprice);
        });

		//Llama al formulario de edicion
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
					var id, ports, portsprice;
					id = $(this).find('span:nth-child(2)').text();
					ports = $(this).find('span:nth-child(5)').text();
					portsprice = $(this).find('span:nth-child(4)').text();
					$('input[name=id_Edit]').val(id);
					$('select[name=ports_Edit]').val(ports);
					$('input[name=portsprice_Edit]').val(portsprice);
					$('#newEditTS-modal').modal();
				}
			})
		});

		// Llama al formulario de eliminaci??n
		$('.deleteCreation-link').click(function(e){
            e.preventDefault();
            var delid, delsof, delsofprice;
            delid = $(this).find('span:nth-child(2)').text();
			delsof = $(this).find('span:nth-child(3)').text();
			delsofprice = $(this).find('span:nth-child(4)').text();
			$('input[name=id_Delete]').val(delid);
            $('.ports_Delete').text(delsof);
			$('.portsprice_Delete').text(delsofprice);
			$('#newDeleteTS-modal').modal();
		});

		// envia el formulario de eliminaci??n
		$('.DeleteSend').submit('click', function(e){
			e.preventDefault();
			Swal.fire({
				title: '????Eliminaci??n!!',
				text: "Desea continuar con la eliminaci??n",
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
			title: '??creado con exito!',
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
			text: '??configuraci??n existente!',
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
				text: 'Hardware no encontrado',
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
				title: '??actualizado con exito!',
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
				title: '??eliminado con exito!',
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
