
@extends('modules.settingProducttype')

@section('info')
    <div>
		<div class="row border-bottom">
			<div class="col-md-4">
				<h6 class="navbar-brand">CREACION DE MODULOS</h6>
			</div>
			<div  class="col-md-4 text-center">
				<button type="button" title="Registrar" class="btn-success form-control-sm newProduct-link"><b>Nuevo</b></button>
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
                    <th>NOMBRE DEL MODULO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $row=1;
                @endphp
                @foreach ($modules as $item)
                    <tr>
                        <td>{{$row++}}</td>
                        <td>{{$item->mod_name}}</td>
                        <td>                            
                            <a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
                                <span class="icon-magic"></span>
                                <span hidden>{{ $item->mod_id }}</span>
                                <span hidden>{{ $item->mod_name }}</span>
                            </a>
                            <a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
                                <span class="icon-proxmox"></span>
                                <span hidden>{{ $item->mod_id }}</span>
                                <span hidden>{{ $item->mod_name }}</span>
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
    {{-- creación de mi formulario de creación documento --}}
	<div class="modal fade" id="newCreationPro-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>NUEVO MODULO</h6>
				</div>
				<div class="modal-body">
					<form action="{{route('module.save')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12 container-sm">
								<div class="row justify-content-center">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL MODULO:</small>
											<input type="text" style="text-transform: uppercase" name="modulename" maxlength="50" class="form-control form-control-sm" required>
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
    {{-- creación de mi formulario de modificación documento --}}
	<div class="modal fade" id="editCreationProduct-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DEL MODULO</h6>
				</div>
				<div class="modal-body">
					<form action="{{route('module.update')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12 container-sm">
								<div class="row justify-content-center">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL MODULO</small>
											<input type="text" style="text-transform: uppercase" name="modulename_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="moduleid_Edit" readonly required>
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
    {{-- formulario de eliminación --}}
	<div class="modal fade" id="deleteCreationPro-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DEL MODULO:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NOMBRE DEL MODULO </small><br>
							<span class="text-muted"><b class="modulename_Delete"></b></span><br>							
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{route('module.delete')}}" method="POST" class="col-md-6 DeleteSend">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="moduleid_Delete" readonly required>
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
		// Llama al formulario modal de creación
		$('.newProduct-link').on('click',function(){
			$('#newCreationPro-modal').modal();
        });

        // Llama al formulario modal edit de edición
		$('.editCreation-link').on('click',function(e){				
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
                    var modulename, moduleid;
                    moduleid = $(this).find('span:nth-child(2)').text();
					modulename = $(this).find('span:nth-child(3)').text();					
                    $('input[name=modulename_Edit]').val(modulename);
                    $('input[name=moduleid_Edit]').val(moduleid);
					$('#editCreationProduct-modal').modal();
					}
				})
        });
        // Llama al formulario de eliminación
		$('.deleteCreation-link').on('click',function(e){			
			e.preventDefault();
			var productname, productid;
			productid = $(this).find('span:nth-child(2)').text();
			productname = $(this).find('span:nth-child(3)').text();			
			$('input[name=moduleid_Delete]').val(productid);
			$('b.modulename_Delete').text(productname);
			$('#deleteCreationPro-modal').modal();					
        })
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
        })
        
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
			text: '¡producto existente!',
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
				text: 'producto no encontrado',
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