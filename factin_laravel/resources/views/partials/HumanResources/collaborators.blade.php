
@extends('modules.settingHumanresources')

@section('info')
    <div>
		<div class="row border-bottom">
			<div class="col-md-4">
				<h6 class="navbar-brand">COLABORADORES</h6>
			</div>
			<div  class="col-md-4 text-center">
				<button type="button" title="Registrar" class="btn-success form-control-sm newCollaborator-link"><b>Nuevo</b></button>
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
					<th>DIRECCION</th>
					<th>TELEFONOS</th>
					<th>CORREO</th>
					<th>FOTO</th>
					<th>FIRMA</th>
					<th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                    @php
                        $row = 1;
                    @endphp
                    @foreach ($collaborators as $item)
                    <tr>
                        <th>{{$row++}}</th>
                        <th>{{$item->col_name}}</th>
                        <th>{{$item->col_ide}}</th>
                        <th>{{$item->departament->depname}} - {{$item->municipality->munname}}</th>
                        <th>{{$item->col_adr}}</th>
                        <th>{{$item->col_ph1}} - {{$item->col_ph2}}</th>
                        <th>{{$item->col_ema}}</th>
                        <th><img src="public_photo/photo/{{$item->col_pho}}" alt="{{$item->col_pho}}" height="60px" width="50px"></th>
                        <th><img src="public_signature/signature/{{$item->col_fir}}" alt="{{$item->col_fir}}" height="40px" width="60px"></th>
                        <th>
                            <a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
                                <span class="icon-magic"></span>
                                <span hidden>{{ $item->id }}</span>
                                <span hidden>{{ $item->col_name }}</span>
								<span hidden>{{ $item->col_ide}}</span>
								<span hidden>{{ $item->col_dep}}</span>
								<span hidden>{{ $item->col_mun}}</span>
								<span hidden>{{ $item->col_adr}}</span>
								<span hidden>{{ $item->col_ph1}}</span>
								<span hidden>{{ $item->col_ph2}}</span>
								<span hidden>{{ $item->col_ema}}</span>
								<span hidden>{{ $item->col_pho}}</span>
								<span hidden>{{ $item->col_fir}}</span>
                            </a>
                            <a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
                                <span class="icon-proxmox"></span>
                                <span hidden>{{ $item->id }}</span>
                                <span hidden>{{ $item->col_name }}</span>
								<span hidden>{{ $item->col_ide}}</span>
								<span hidden>{{ $item->col_dep}}</span>
								<span hidden>{{ $item->col_mun}}</span>
								<span hidden>{{ $item->col_adr}}</span>
								<span hidden>{{ $item->col_ph1}}</span>
								<span hidden>{{ $item->col_ph2}}</span>
								<span hidden>{{ $item->col_ema}}</span>
								<span hidden>{{ $item->col_pho}}</span>
								<span hidden>{{ $item->col_fir}}</span>
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

    {{-- formulario de creación --}}
	<div class="modal fade" id="newcollaborator-modal">
		<div class="modal-dialog modal-lg" style="font-size: 15px;">
			<div class="modal-content">
				<div class="modal-header text-center my-3">
					<h4 class="margin-auto">Nuevo Colaborador</h4>
				</div>
				<div class="modal-body">
					<form action="{{route('collaborator.save')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">NOMBRES:</small>
											<input type="text" name="col_name" maxlength="100" class="form-control form-control-sm" placeholder="Nombres" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">IDENTIFCACION:</small>
											<input type="text" name="col_ide" maxlength="10" class="form-control form-control-sm" placeholder="C.C/C.E" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">DEPARTAMENTO:</small>
											<select id="DepName" name="col_dep" class="form-control form-control-sm" required>
												<option value="">Seleccione un Departamento</option>
												@foreach ($departament as $item)
												<option value="{{$item->depid}}">{{$item->depname}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">MUNICIPIO</small>
											<select id="MunName" name="col_mun" class="form-control form-control-sm" required>
												{{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DIRECCION</small>
											<input type="text" name="col_adr" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<small>TELEFONO 1</small>
										<input type="text" name="col_ph1" maxlength="10" class="form-control form-control-sm" required>
									</div>
									<div class="col-md-3">
										<small>TELEFONO 2</small>
										<input type="text" name="col_ph2" maxlength="10" class="form-control form-control-sm" required>
									</div>
									<div class="col-md-6">
										<small>CORREO ELECTRONICO</small>
										<input type="text" name="col_email" maxlength="50" class="form-control form-control-sm" placeholder="correo@correo.com.co" required>
									</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <small>FOTO: </small>
                                            <input type="file" name="col_pho" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <small>FIRMA: </small>
                                            <input type="file" name="col_fir" id="">
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
						<div class="my-3">
							<div class="form-group text-center border-top">
								<button type="submit" class="btn btn-success form-control-sm my-3">GUARDAR</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- formulario de edición --}}
	<div class="modal fade" id="newcollaboratorEdit-modal">
		<div class="modal-dialog modal-lg" style="font-size: 15px;">
			<div class="modal-content">
				<div class="modal-header text-center my-3">
					<h4 class="margin-auto">Modificar Colaborador</h4>
				</div>
				<div class="modal-body">
					<form action="{{route('collaborator.update')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">NOMBRES:</small>
											<input type="text" name="col_name_Edit" maxlength="100" class="form-control form-control-sm" placeholder="Nombres" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">IDENTIFCACION:</small>
											<input type="text" name="col_ide_Edit" maxlength="10" class="form-control form-control-sm" placeholder="C.C/C.E" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">DEPARTAMENTO:</small>
											<select id="DepName_Edit" name="col_dep_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione un Departamento</option>
												@foreach ($departament as $item)
												<option value="{{$item->depid}}">{{$item->depname}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">MUNICIPIO</small>
											<select id="MunName_Edit" name="col_mun_Edit" class="form-control form-control-sm" required>
												{{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DIRECCION</small>
											<input type="text" name="col_adr_Edit" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<small>TELEFONO 1</small>
										<input type="text" name="col_ph1_Edit" maxlength="10" class="form-control form-control-sm" required>
									</div>
									<div class="col-md-3">
										<small>TELEFONO 2</small>
										<input type="text" name="col_ph2_Edit" maxlength="10" class="form-control form-control-sm" required>
									</div>
									<div class="col-md-6">
										<small>CORREO ELECTRONICO</small>
										<input type="text" name="col_email_Edit" maxlength="50" class="form-control form-control-sm" placeholder="correo@correo.com.co" required>
									</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <small>FOTO: </small>
											<input type="file" name="col_pho_Edit" id="">
											<input type="hidden" name="col_pho_Edit2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <small>FIRMA: </small>
											<input type="file" name="col_fir_Edit" id="">
											<input type="hidden" name="col_fir_Edit2">
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

    {{-- formulario de eliminación --}}
	<div class="modal fade" id="deleteCollaborator-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION COLABORADOR</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NOMBRE DEL COLABORADOR</small><br>
                            <span class="text-muted"><b class="col_name_Delete"></b></span><br>
                            <small class="text-muted">IDENTIFCACION COLABORADOR</small><br>
							<span class="text-muted"><b class="col_ide_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{route('collaborator.delete')}}" method="POST" class="col-md-6 DeleteSend">
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

		$('.newCollaborator-link').on('click',function(){
			$('#newcollaborator-modal').modal();
        });

        //consulta de departamento
		$('#DepName').on('change',function(e){
			var Departament = e.target.value;
			$('#MunName').empty();
			$('#MunName').append("<option value=''>Seleccione un Municipio</option>");
			if(Departament != '')
			{
				$.get("{{route('getMunicipalities')}}",{DepId: Departament},function(objectMunicipality){
					for(var i=0; i<objectMunicipality.length;i++){
						$('#MunName').append("<option value='"+objectMunicipality[i]['munid']+"'>"+objectMunicipality[i]['munname']+"</option>");
					}
				})
			}
        });

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
					var col_ids,col_names,col_ides,col_deps,col_muns,col_adrs,col_ph1s,col_ph2s,col_emas,col_phos,col_firs;
					col_ids = $(this).find('span:nth-child(2)').text();
					col_names = $(this).find('span:nth-child(3)').text();
					col_ides = $(this).find('span:nth-child(4)').text();
					col_deps = $(this).find('span:nth-child(5)').text();
					col_muns = $(this).find('span:nth-child(6)').text();
					col_adrs = $(this).find('span:nth-child(7)').text();
					col_ph1s = $(this).find('span:nth-child(8)').text();
					col_ph2s = $(this).find('span:nth-child(9)').text();
					col_emas = $(this).find('span:nth-child(10)').text();
					col_phos = $(this).find('span:nth-child(11)').text();
					col_firs = $(this).find('span:nth-child(12)').text();
					$('input[name=id_Edit]').val(col_ids);
					$('input[name=col_name_Edit]').val(col_names);
					$('input[name=col_ide_Edit]').val(col_ides);
					$('select[name=col_dep_Edit]').val(col_deps);
					$('select[name=col_mun_Edit]').empty();
					$('select[name=col_mun_Edit]').append("<option value=''>Seleccione un Municipio</option>");
					$.get("{{route('getMunicipalities')}}",{DepId: col_deps}, function(objectMunicipality){
						var count = Object.keys(objectMunicipality).length;
						if (count > 0) {
							for (let index = 0; index < count; index++) {
								if (objectMunicipality[index]['munid'] == col_muns) {
									$('select[name=col_mun_Edit]').append("<option value='"+objectMunicipality[index]['munid']+"' selected>"+objectMunicipality[index]['munname']+"</option>");
								} else {
									$('select[name=col_mun_Edit]').append("<option value='"+objectMunicipality[index]['munid']+"'>"+objectMunicipality[index]['munname']+"</option>");
								}
							}
						}
					});
					$('input[name=col_adr_Edit]').val(col_adrs);
					$('input[name=col_ph1_Edit]').val(col_ph1s);
					$('input[name=col_ph2_Edit]').val(col_ph2s);
					$('input[name=col_email_Edit]').val(col_emas);
					$('input[name=col_pho_Edit2]').val(col_phos);
					$('input[name=col_fir_Edit2]').val(col_firs);
					$('#newcollaboratorEdit-modal').modal();
				}
			})
		});

		//consulta de departamento
		$('#DepName_Edit').on('change',function(e){
			var DepartamentSelect = e.target.value;
			$('#MunName_Edit').empty();
			$('#MunName_Edit').append("<option value=''>Seleccione un Municipio</option>");
			if(DepartamentSelect != '')
			{
				$.get("{{route('getMunicipalities')}}",{DepId: DepartamentSelect},function(objectMunicipality){
					for(var i=0; i<objectMunicipality.length;i++){
						$('#MunName_Edit').append("<option value='"+objectMunicipality[i]['munid']+"'>"+objectMunicipality[i]['munname']+"</option>");
					}
				})
			}
        });

        // Llama al formulario de eliminación
		$('.deleteCreation-link').on('click',function(e){
            e.preventDefault();
            var id, name, ide;
            id = $(this).find('span:nth-child(2)').text();
			name = $(this).find('span:nth-child(3)').text();
			ide = $(this).find('span:nth-child(4)').text();
			$('input[name=id_Delete]').val(id);
            $('.col_name_Delete').text(name);
			$('.col_ide_Delete').text(ide);
			$('#deleteCollaborator-modal').modal();
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
			title: '¡Creado con Exito!',
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
			text: '¡Información colaborador no encontrada!',
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
				text: 'Información colaborador no encontrado',
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
