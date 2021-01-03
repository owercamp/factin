
@extends('modules.settingCompanyinfo')

@section('info')
    <div>
        <div class="row border-bottom">
            <div class="col-md-4">
                <h6 class="navbar-brand">INFORMACION CORPORATIVA</h6>
            </div>
            <div class="col-md-6">
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
        @if (isset($company))
		<div class="container-fluid my-3">
			<div class="row text-warning">
				<div class="col-md-6">
					<small class="text-muted">RAZON SOCIAL: </small><br>
					<span class="text-muted blockquote text-uppercase">
						<b class="text-info">
							{{ $company->comsocial }}
						</b>
					</span><br>
					<small class="text-muted">DEPARTAMENTO - MUNICIPIO: </small><br>
					<span class="text-muted blockquote text-uppercase">
						<b>
							{{$company->departament->depname}}
						</b>
						<b>{{' - '}}</b>
						<b>
							{{$company->municipality->munname}}
						</b>
					</span><br>
					<small class="text-muted">EMAIL:</small><br>
					<span class="text-muted blockquote">
						<b>
							{{$company->comemail}}
						</b>
					</span><br>
					<div class="row my-5">
						<a href="#" title="Eliminar información" class="btn btn-delete deleteCompany-link"><span class="icon-trash"></span> ELIMINACION DE INFORMACION
							<span hidden>{{$company->comid}}</span>
							<span hidden>{{$company->comnit}}</span>
							<span hidden>{{$company->comsocial}}</span>
						</a>
					</div>
				</div>
				<div class="col-md-6">
					<small class="text-muted">NIT: </small><br>
					<span class="text-muted blockquote text-uppercase">
						<b class="text-primary">
							{{ $company->comnit }}
						</b>
					</span><br>
					<small class="text-muted">DIRECCION: </small><br>
					<span class="text-muted blockquote text-Capitalize">
						<b>
							{{ $company->comaddress }}
						</b>
					</span><br>
					<small class="text-muted">TELEFONOS: </small><br>
					<span class="text-muted blockquote text-uppercase">
						<b>
							{{$company->comphone1}}
						</b>
						<b>{{' - '}}</b>
						<b>
							{{$company->comphone2}}
						</b>
					</span><br>
					<div class="row my-5">
						<a href="#" title="Editar información" class="btn btn-edit editCompany-link"><span class="icon-pencil"></span> MODIFICACION DE LA INFORMACION
							<span hidden>{{$company->comid}}</span>
							<span hidden>{{$company->comsocial}}</span>
							<span hidden>{{$company->comnit}}</span>
							<span hidden>{{$company->comdepid}}</span>
							<span hidden>{{$company->communid}}</span>
							<span hidden>{{$company->comaddress}}</span>
							<span hidden>{{$company->comphone1}}</span>
							<span hidden>{{$company->comphone2}}</span>
							<span hidden>{{$company->comemail}}</span>
						</a>
					</div>
				</div>			
			</div>
		</div>
        @else
            <div class="row">
				<div class="col-md-12 text-center my-5">
					<h6>NO EXISTE INFORMACION CORPORATIVA</h6>
					<br>
					<button type="button" title="Registrar Información Corporativa" class="btn-edit my-4 form-control-sm newcompany-link"><span class="icon-file-text-o"></span> <b>AÑADIR INFORMACION</b></button>
				</div>
			</div>
        @endif
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
	<div class="modal fade" id="newcompany-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header text-center my-3">
					<h4 class="margin-auto">INFORMACION CORPORATIVA</h4>
				</div>
				<div class="modal-body">
					<form action="{{route('company.save')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">RAZON SOCIAL:</small>
											<input type="text" name="comSocial" maxlength="50" class="form-control form-control-sm" placeholder="Razon Social" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NIT:</small>
											<input type="text" name="comNit" maxlength="12" class="form-control form-control-sm" placeholder="NIT Compañia" required>											
										</div>
									</div>
								</div>
								<div class="row">									
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">DEPARTAMENTO:</small>
											<select id="DepName" name="comDepid" class="form-control form-control-sm" required>
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
											<select id="MunName" name="comMunid" class="form-control form-control-sm" required>
												{{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DIRECCION</small>
											<input type="text" name="comAddress" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<small>TELEFONO 1</small>
										<input type="text" name="comPhone1" maxlength="10" class="form-control form-control-sm" required>
									</div>
									<div class="col-md-3">
										<small>TELEFONO 2</small>
										<input type="text" name="comPhone2" maxlength="10" class="form-control form-control-sm" required>
									</div>
									<div class="col-md-6">
										<small>EMAIL</small>
										<input type="text" name="comEmail" maxlength="50" class="form-control form-control-sm" required>
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
	<div class="modal fade" id="newcompanyEdit-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header text-center my-3">
					<h4 class="margin-auto">INFORMACION CORPORATIVA</h4>
				</div>
				<div class="modal-body">
					<form action="#" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">RAZON SOCIAL:</small>
											<input type="text" name="comSocial_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Razon Social" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NIT:</small>
											<input type="text" name="comNit_Edit" maxlength="12" class="form-control form-control-sm" placeholder="NIT Compañia" required>											
										</div>
									</div>
								</div>
								<div class="row">									
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">DEPARTAMENTO:</small>
											<select id="DepName" name="comDepid_Edit" class="form-control form-control-sm" required>
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
											<select id="MunName" name="comMunid_Edit" class="form-control form-control-sm" required>
												{{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DIRECCION</small>
											<input type="text" name="comAddress_Edit" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<small>TELEFONO 1</small>
										<input type="text" name="comPhone1_Edit" maxlength="10" class="form-control form-control-sm" required>
									</div>
									<div class="col-md-3">
										<small>TELEFONO 2</small>
										<input type="text" name="comPhone2_Edit" maxlength="10" class="form-control form-control-sm" required>
									</div>
									<div class="col-md-6">
										<small>EMAIL</small>
										<input type="text" name="comEmail_Edit" maxlength="50" class="form-control form-control-sm" required>
									</div>
								</div>								
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="comId_Edit" readonly required>
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
	<div class="modal fade" id="newcompanyDelete-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE LA INFORMACION</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NIT</small><br>
                            <span class="text-muted"><b class="comnit_Delete"></b></span><br>
                            <small class="text-muted">Razón Social</small><br>
							<span class="text-muted"><b class="comsocial_Delete"></b></span><br>							
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{route('company.delete')}}" method="POST" class="col-md-6 DeleteSend">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="comid_Delete" readonly required>
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
		
		$('.newcompany-link').on('click',function(){
			$('#newcompany-modal').modal();
		});

		$('.editCompany-link').on('click',function(e){
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
					var Social,Nit,Departament,Municipality,Address,Phone1,Phone2,Email;
					Social = $(this).find('span:nth-child(3)').text();
					Nit = $(this).find('span:nth-child(4)').text();
					Departament = $(this).find('span:nth-child(5)').text();
					Municipality = $(this).find('span:nth-child(6)').text();
					Address = $(this).find('span:nth-child(7)').text();
					Phone1 = $(this).find('span:nth-child(8)').text();
					Phone2 = $(this).find('span:nth-child(9)').text();
					Email = $(this).find('span:nth-child(10)').text();
					$('input[name=comSocial_Edit]').val(Social);
					$('input[name=comNit_Edit]').val(Nit);
					$('input[name=comAddress_Edit]').val(Address);
					$('select[name=comDepid_Edit]').val(Departament);
					
					$('input[name=comPhone1_Edit]').val(Phone1);
					$('input[name=comPhone2_Edit]').val(Phone2);
					$('input[name=comEmail_Edit]').val(Email);
					$('#newcompanyEdit-modal').modal();
                    }
                })			
		});
		// llama al formulario de eliminación
		$('.deleteCompany-link').on('click',function(e){
			e.preventDefault();
			var comid = $(this).find('span:nth-child(2)').text();
			var comnit = $(this).find('span:nth-child(3)').text();
			var comsocial = $(this).find('span:nth-child(4)').text();
			$('input[name=comid_Delete]').val(comid);
            $('.comnit_Delete').text(comnit);             
			$('.comsocial_Delete').text(comsocial);
			$('#newcompanyDelete-modal').modal();
		});
		// envio del formulario de eliminación
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
			text: '¡Información corporativa no encontrada!',
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
				text: 'Información corporativa no encontrado',
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

