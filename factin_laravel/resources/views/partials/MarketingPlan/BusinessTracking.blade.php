
@extends('modules.settingMarketing')

@section('info')
	<div>
		<div class="row border-bottom">
			<div class="col-md-8">
				<h6 class="navbar-brand">SEGUIMIENTO DE NEGOCIOS</h6>
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
					<th>RAZON SOCIAL</th>
					<th>CONTACTO</th>
					<th>MUNICIPIO</th>
					<th>TELEFONO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php
					$row = 1;
				@endphp
				@foreach ($business as $item)
					@if ($item->bt_status == null)						
					<tr>
						<th>{{$row++}}</th>
						<th>{{$item->bt_social}}</th>
						<th>{{$item->bt_con}}</th>
						<th>{{$item->munname}}</th>
						<th>{{$item->bt_pho}}</th>
						<th>
							<a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
								<span class="icon-magic"></span>
								<span hidden>{{$item->bt_id}}</span>
								<span hidden>{{$item->bt_date}}</span>
								<span hidden>{{$item->bt_social}}</span>
								<span hidden>{{$item->bt_dep}}</span>
								<span hidden>{{$item->bt_mun}}</span>
								<span hidden>{{$item->bt_adr}}</span>
								<span hidden>{{$item->bt_con}}</span>
								<span hidden>{{$item->bt_pho}}</span>
								<span hidden>{{$item->bt_What}}</span>
								<span hidden>{{$item->bt_ema}}</span>
								<span hidden>{{$item->bt_Obs}}</span>
							</a>
							<a href="#" title="Bitacora" class="btn-delete form-control-sm BitacoraCreation-link">
								<span class="icon-list-alt"></span>
								<span hidden>{{$item->bt_id}}</span>
								<span hidden>{{$item->bt_date}}</span>
								<span hidden>{{$item->bt_social}}</span>
								<span hidden>{{$item->bt_dep}}</span>
								<span hidden>{{$item->bt_mun}}</span>
								<span hidden>{{$item->bt_adr}}</span>
								<span hidden>{{$item->bt_con}}</span>
								<span hidden>{{$item->bt_pho}}</span>
								<span hidden>{{$item->bt_What}}</span>
								<span hidden>{{$item->bt_ema}}</span>
								<span hidden>{{$item->bt_Obs}}</span>								
							</a>							
							<a  href="#" title="Aprobar" class="btn-edit form-control-sm AprobarCreation-link">								
								<span class="icon-check"></span>
								<span hidden>{{$item->bt_id}}</span>																																
							</a>							
							<a href="#" title="No Aprobar" class="btn-delete form-control-sm NoAprobarCreation-link">
								<span class="icon-close"></span>
								<span hidden>{{$item->bt_id}}</span>
							</a>
						</th>
					</tr>
					@endif
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
	
	{{-- formulario de edicion de los registros --}}
	<div class="modal fade" id="newEditTra-modal">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>EDICION SEGUMIENTO DE NEGOCIO</h6>
				</div>
				<div class="modal-body">
					<form action="{{route('tracking.update')}}" method="POST">
						@csrf
						<div class="card-body border">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<small class="text-muted">FECHA:</small>
												<input type="text" name="OpDate_Edit" class="form-control form-control-sm datepicker" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<small class="text-muted">RAZON SOCIAL:</small>
												<input type="text" name="OpSocial_Edit" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<small class="text-muted">DEPARTAMENTO:</small>
												<select name="OpDep_Edit" id="DepName" class="form-control form-control-sm" required>
													<option value="">Seleccione un Departamento</option>
													@foreach ($departament as $item)
														<option value="{{ $item->depid}}">{{$item->depname}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<small class="text-muted">MUNICIPIO:</small>
												<select name="OpMun_Edit" id="MunName" class="form-control form-control-sm" required>
													{{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<small class="text-muted">DIRECCION:</small>
												<input type="text" name="OpDir_Edit" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<small class="text-muted">CONTACTO:</small>
												<input type="text" name="OpCon_Edit" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<small class="text-muted">TELEFONO:</small>
												<input type="text" name="OpTel_Edit" maxlength="10" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<small class="text-muted">WHATSAPP:</small>
												<input type="text" name="OpWhat_Edit" maxlength="10" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<small class="text-muted">CORREO ELECTRONICO</small>
												<input type="email" name="OpEma_Edit" maxlength="100" placeholder="example@correo.com.co" class="form-control form-control-sm">
											</div>
											<div class="form-group">
												<input type="hidden" class="form-control form-control-sm" name="Opid_Edit" readonly required>
												<button type="submit" class="btn btn-edit" style="margin: 5% 35%">ACTUALIZAR</button>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<small class="text-muted">OBSERVACIONES:</small>
												<textarea name="OpObs_Edit" cols="30" rows="10" maxlength="1000" class="form-control form-control-sm">
												</textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- creacion de mi formulario bitacora --}}
	<div class="modal fade" id="newBitacora-modal">
		<div class="modal-dialog modal-lg" style="font-size: 15px">
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h3 style="padding-top: 2%">NUEVA BITACORA</h3>
				</div>
				<div class="modal-body">
					<form action="{{route('teken.index')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<small class="text-muted">FECHA:</small><br>
									<span class="text-muted"><b class="NowDate"></b></span><br>
									<input type="hidden" name="datelocale" value="{{date('Y-m-d')}}">
									<small class="text-muted">RAZON SOCIAL</small>
									<input type="text" name="social" class="form-control form-control-sm" disabled>									
									<input type="hidden" name="sid">																		
									<div class="form-group" style="padding: 8% 15%">
										<button type="submit" class="btn btn-success btn-width">Agregar Bitacora</button>
										<button data-dismiss="modal" class="btn btn-dark btn-width" style="margin-top:5%">Cancelar</button>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<small class="text-muted">BITACORA</small>
									<textarea name="Bitacora" id="Bitacora" cols="30" rows="10" class="form-control form-control-sm" required></textarea>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="invisible">
		<form action="{{route('status.approved')}}" method="POST" class="formstatusAp">
			@csrf
			<input type="text" name="bt_id_status">
		</form>
	</div>
	<div class="invisible">
		<form action="{{route('status.non-approved')}}" method="POST" class="statusdenied">
		@csrf
			<input type="text" name="bt_status_denied">
		</form>
	</div>
@endsection

@section('ScriptZone')
	<script>
		// llama a mi bitacora 
		$('.BitacoraCreation-link').click(function (e) {
			e.preventDefault();
			var id, txtSocial, listSocial;
			id = $(this).find('span:nth-child(2)').text();
			RSocial = $(this).find('span:nth-child(4)').text();			
			$('input[name=social]').val(RSocial);
			$('input[name=sid]').val(id);
			$('#newBitacora-modal').modal();
		});
		// cambia de estado a abrobado segun mi objecto
		$('.AprobarCreation-link').click(function (e) { 
			e.preventDefault();
			var newid;
			newid = $(this).find('span:nth-child(2)').text();
			$('input[name=bt_id_status]').val(newid);
			$('.formstatusAp').submit();
		});
		// cambia de estado a denegado segun mi object
		$('.NoAprobarCreation-link').click(function (e) { 
			e.preventDefault();
			var deniedid;
			deniedid = $(this).find('span:nth-child(2)').text();
			$('input[name=bt_status_denied]').val(deniedid);
			$('.statusdenied').submit();			
		});


		// consulta municipios dependiendo de el departamento
		$('#DepName').change(function(e){
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
					var id,date,social,dep,mun,adr,con,pho,what,ema,obs;
					id = $(this).find('span:nth-child(2)').text();
					date = $(this).find('span:nth-child(3)').text();
					social = $(this).find('span:nth-child(4)').text();
					dep = $(this).find('span:nth-child(5)').text();
					mun = $(this).find('span:nth-child(6)').text();
					adr = $(this).find('span:nth-child(7)').text();
					con = $(this).find('span:nth-child(8)').text();
					pho = $(this).find('span:nth-child(9)').text();
					what = $(this).find('span:nth-child(10)').text();
					ema = $(this).find('span:nth-child(11)').text();
					obs = $(this).find('span:nth-child(12)').text();
					$('input[name=OpDate_Edit]').val(date);
					$('input[name=OpSocial_Edit]').val(social);
					$('select[name=OpDep_Edit]').val(dep);
					$('select[name=OpMun_Edit]').empty();
					$('select[name=OpMun_Edit]').append("<option value=''>Seleccione un Municipio</option>");
					$.get("{{route('getMunicipalities')}}",{DepId: dep}, function(objectMunicipality){
						var count = Object.keys(objectMunicipality).length;
						if (count > 0) {
							for (let index = 0; index < count; index++) {
								if (objectMunicipality[index]['munid'] == mun) {
									$('select[name=OpMun_Edit]').append("<option value='"+objectMunicipality[index]['munid']+"' selected>"+objectMunicipality[index]['munname']+"</option>");
								} else {
									$('select[name=OpMun_Edit]').append("<option value='"+objectMunicipality[index]['munid']+"'>"+objectMunicipality[index]['munname']+"</option>");
								}
							}
						}
					});
					$('input[name=OpDir_Edit]').val(adr);
					$('input[name=OpCon_Edit]').val(con);
					$('input[name=OpTel_Edit]').val(pho);
					$('input[name=OpWhat_Edit]').val(what);
					$('input[name=OpEma_Edit]').val(ema);
					$('input[name=Opid_Edit]').val(id);
					$('textarea[name=OpObs_Edit]').val(obs);
					$('#newEditTra-modal').modal();
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
			text: '¡configuración existente!',
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
				text: 'registro no encontrado',
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
	@if (session('Message') == 'MessageError')
		<script>
			Swal.fire({
				icon: 'info',
				title: 'Area en Construcción, Pronto estara disponible!',
				timer: 5000,
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