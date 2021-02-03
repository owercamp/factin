
@extends('modules.settingCustomers')

@section('info')
	<div>
		<div class="row border-bottom">
		</div>
		<div class="card">
			<div class="card-header text-center">
				<h5 class="text-primary" style="margin-top: 5px"><em><b>REGISTRO PROPUESTA COMERCIAL</b></em></h5>
			</div>
			<form action="{{route('proposal.save')}}" id="FormCommercial" method="POST">
				@csrf
				<div class="card-body p-4 border">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">FECHA:</small>
										<input type="text" name="CoDate" class="form-control form-control-sm datepicker" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<small class="text-muted">RAZON SOCIAL:</small>
										<select id="CoSocial" name="CoSocial" style="text-transform: uppercase" class="form-control form-control-sm" required>
											<option value="">Seleccione Razón Social</option>
											@foreach ($MyData as $item)
												@if($item->bt_status == "APROBADO")
													<option value="{{$item->bt_id}}">{{$item->bt_social}}</option>
												@endif
											@endforeach
										</select>
										{{-- traer la informacion de aprobados de las oportunidades de negocio --}}
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">TIPO DE DOCUMENTO:</small>
										<select name="CoTipo" class="form-control form-control-sm" required disabled>
											<option value="">Seleccione un tipo</option>
											<option value="CEDULA DE CIUDADANIA">CEDULA DE CIUDADANIA</option>
											<option value="NIT">NIT</option>
											<option value="PASAPORTE">PASAPORTE</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<small class="text-muted">NUMERO DE DOCUMENTO:</small>
										<input type="text" name="CoNumero" maxlength="50" style="text-transform: uppercase" class="form-control form-control-sm" required disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">DEPARTAMENTO:</small>
										<select name="CoDep" id="DepName" class="form-control form-control-sm" required disabled>
											<option value="">Seleccione un departamento</option>
											@foreach ($Departament as $item)
												<option value="{{$item->depid}}">{{$item->depname}}</option>
											@endforeach
											{{-- api de busqueda que carga los departamentos segun razón social en ScriptZone ↓ --}}
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">MUNICIPIO:</small>
										<select name="CoMun" id="MunName" class="form-control form-control-sm" required disabled>
											<option value=''>Seleccione un Municipio</option>
											{{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">DIRECCION:</small>
										<input type="text" id="CoDir" name="CoDir" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm" disabled>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">CONTACTO:</small>
										<input type="text" name="CoCon" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm" required disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<small class="text-muted">TELEFONO:</small>
										<input type="text" name="CoTel" maxlength="10" class="form-control form-control-sm" required disabled>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">WHATSAPP:</small>
										<input type="text" name="CoWhat" maxlength="10" class="form-control form-control-sm" disabled>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<small class="text-muted">CATEGORIA:</small>
										<select name="CoCat" class="form-control form-control-sm" required disabled>
											<option value="">Seleccione Categoria</option>
											<option value="FactinWeb">FACTIN WEB</option>
											<option value="Software">SOFTWARE</option>
											<option value="Hardware">HARDWARE</option>
											<option value="SoporteTecnico">SOPORTE TECNICO</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">PRODUCTO:</small> {{-- se realiza la consulta dependiendo la categoria --}}
										<select name="CoPro" id="CoPro" class="form-control form-control-sm" disabled>
											<option value="">Seleccione Producto</option>
											{{-- select dimanics --}}
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<small class="text-muted">PRECIO:</small>
										<input type="text" name="CoPrice" style="font-weight: bold" class="form-control form-control-sm text-primary" required disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<small class="text-muted">CORREO ELECTRONICO</small>
										<input type="email" name="CoEma" maxlength="100" placeholder="example@correo.com.co" class="form-control form-control-sm" disabled>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<small class="text-muted">CANTIDAD:</small>
										<input type="text" name="CoCan"  maxlength="4" class="form-control form-control-sm text-dark" disabled required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<small class="text-muted">SUBTOTAL:</small>
										<input type="text" name="CoSub" style="font-weight: bold" class="form-control form-control-sm text-primary" disabled required>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<small class="text-muted">% IVA:</small>
										<input type="text" name="CoIva" style="font-weight: bold" maxlength="4" class="form-control form-control-sm text-iva" disabled required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<small class="text-muted">VALOR IVA:</small>
										<input type="text" style="font-weight: bold" name="CoVIva" class="form-control form-control-sm text-primary" disabled required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<small class="text-muted">TOTAL:</small>
										<input type="text" style="font-weight: bold" name="CoTotal" class="form-control form-control-sm text-primary" disabled required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<button type="submit" class="btn btn-edit" style="margin: 5% 35%">ALMACENAR</button>
									</div>
									<input type="hidden" id="capture" name="CoProHidden">
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<small class="text-muted">OBSERVACIONES:</small>
										<textarea name="CoObs" cols="30" rows="10" maxlength="1000" class="form-control form-control-sm" disabled>
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
@endsection

@section('ScriptZone')
	<script>
		// realiza la consulta y carga los datos en sus respectivos campos dependiendo de la razón social seleccionada
		$('#CoSocial').change(function (e) {
			var Social = e.target.value;
			$.get("{{route('getCommercial')}}", {data: Social},
				function (FullData) {
					var count = Object.keys(FullData).length;
					if (count > 0) {
						for (let i = 0; i < count; i++) {
							$.get("{{route('getMunicipalities')}}",{DepId: FullData[i]['bt_dep']},
							function(objectMunicipality){
								let count = Object.keys(objectMunicipality).length;
								if (count > 0) {
									for (let index = 0; index < count; index++) {
										if (objectMunicipality[index]['munid'] == FullData[i]['bt_mun'] ) {
											$('#MunName').append("<option value='"+objectMunicipality[index]['munid']+"' selected>"+objectMunicipality[index]['munname']+"</option>");
										}else{
											$('#MunName').append("<option value='"+objectMunicipality[index]['munid']+"'>"+objectMunicipality[index]['munname']+"</option>");
										}
									}
								}
							}
							);
							$('input[name=CoDir]').val(FullData[i]['bt_adr']);
							$('input[name=CoCon]').val(FullData[i]['bt_con']);
							$('input[name=CoTel]').val(FullData[i]['bt_pho']);
							$('input[name=CoWhat]').val(FullData[i]['bt_What']);
							$('input[name=CoEma]').val(FullData[i]['bt_ema']);
							$('textarea[name=CoObs]').val(FullData[i]['bt_Obs']);
							$('select[name=CoDep]').val(FullData[i]['bt_dep']);
						}
					}
			});
			$('#DepName').prop('disabled', false);
			$('#MunName').prop('disabled', false);
			$('input[name=CoDir]').prop('disabled',false);
			$('input[name=CoNumero]').prop('disabled',false);
			$('input[name=CoCon]').prop('disabled',false);
			$('input[name=CoTel]').prop('disabled',false);
			$('input[name=CoWhat]').prop('disabled',false);
			$('input[name=CoEma]').prop('disabled',false);
			$('textarea[name=CoObs]').prop('disabled',false);
			$('select[name=CoPro]').prop('disabled',false);
			$('input[name=CoPrice]').prop('disabled',false);
			$('input[name=CoCan]').prop('disabled',false);
			$('input[name=CoSub]').prop('disabled',false);
			$('input[name=CoIva]').prop('disabled',false);
			$('input[name=CoVIva]').prop('disabled',false);
			$('input[name=CoTotal]').prop('disabled',false);
			$('select[name=CoCat]').prop('disabled',false);
			$('select[name=CoTipo]').prop('disabled',false);
		});

		// selecciona municipio dependiendo de cambio del departamento
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

		// listado dependiendo de la categoria
		$('select[name=CoCat]').change(function(e) {
			var MySelect = e.target.value;
			$('select[name=CoPro]').empty();
			$('input[name=CoPrice]').val('');
			$('input[name=CoSub]').val('');
			$('input[name=CoCan]').val('');
			$('input[name=CoIva]').val('');
			$('input[name=CoVIva]').val('');
			$('input[name=CoTotal]').val('');
			$('select[name=CoPro]').append("<option value=''>Seleccione Producto</option>");
			if (MySelect == 'FactinWeb') {
				$.get("{{route('getFactin')}}",
					function (objectFactin) {
						for (let index = 0; index < objectFactin.length; index++) {
							$('select[name=CoPro]').append("<option value='"+objectFactin[index]['por_id']+"'>"+objectFactin[index]['pro_name']+"</option>");
						}
					}
				);
			}else if(MySelect == 'Software'){
				$.get("{{route('getSoftware')}}",
					function (objectSoftware) {
						for (let index = 0; index < objectSoftware.length; index++) {
							$('select[name=CoPro]').append("<option value='"+objectSoftware[index]['sof_id']+"'>"+objectSoftware[index]['pro_name']+"</option>");
						}
					}
				);
			}else if(MySelect == 'Hardware'){
				$.get("{{route('getHardware')}}",
					function (objectHardware) {
						for (let index = 0; index < objectHardware.length; index++) {
							$('select[name=CoPro]').append("<option value='"+objectHardware[index]['har_id']+"'>"+objectHardware[index]['pro_name']+"</option>");
						}
					}
				);
			}else if(MySelect == 'SoporteTecnico'){
				$.get("{{route('getSupport')}}",
					function (objectSupport) {
						for (let index = 0; index < objectSupport.length; index++) {
							$('select[name=CoPro]').append("<option value='"+objectSupport[index]['id']+"'>"+objectSupport[index]['pro_name']+"</option>");
						}
					}
				);
			}
		});

		$('select[name=CoPro]').change(function (e) {
			let product = e.target.value;
			let Categories = $('select[name=CoCat]').val();
			$('input[name=CoPrice]').val('');
			if (Categories == 'FactinWeb') {
				if (product != '') {
					$.get("{{route('getFactinPrice')}}", {data: product},
						function (FactinPrice) {
							console.log(FactinPrice);
							$('input[name=CoPrice]').val(FactinPrice[0].price);
							$('#capture').val(FactinPrice[0].pro_name);
						}
					);
				}
			}else if (Categories == 'Software') {
				if (product != '') {
					$.get("{{route('getSoftwarePrice')}}", {data: product},
						function (SoftPrice) {
							$('input[name=CoPrice]').val(SoftPrice[0].sofprice);
							$('#capture').val(SoftPrice[0].pro_name);
						}
					);
				}
			}else if (Categories == 'Hardware') {
				if (product != '') {
					$.get("{{route('getHardwarePrice')}}", {data: product},
						function (HardPrice) {
							$('input[name=CoPrice]').val(HardPrice[0].harprice);
							$('#capture').val(HardPrice[0].pro_name);
						}
					);
				}
			}else if (Categories == 'SoporteTecnico') {
				if (product != '') {
					$.get("{{route('getSupportPrice')}}", {data: product},
						function (SupportPrice) {
							$('input[name=CoPrice]').val(SupportPrice[0].tsprice);
							$('#capture').val(SupportPrice[0].pro_name);
						}
					);
				}
			}
		});

		$('input[name=CoCan]').change(function () {
			let Price = $('input[name=CoPrice]').val();
			let Bedrag = $('input[name=CoCan]').val();
			let Total = Price * Bedrag;
			$('input[name=CoSub]').val(Total);
		});

		$('input[name=CoIva]').change(function () {
			let Subtotal = $('input[name=CoSub]').val();
			let PercentageIva = $('input[name=CoIva]').val();
			let ValueIva = (Subtotal * PercentageIva) / 100;
			$('input[name=CoVIva]').val(ValueIva);
			let Total = parseInt(Subtotal) + parseInt(ValueIva);
			$('input[name=CoTotal]').val(Total);
		});
    </script>

    @if(session('SuccessCreation') == 'Almacenado')
	<script>
        Swal.fire({
            icon: 'success',
            title: 'registro exitoso',
            text: '¿Desea ver los registros en la tabla seguimiento comercial?',
            showDenyButton: true,
            showCancelButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#f58f4d',
            confirmButtonText: `Si`,
            denyButtonText: `No`,
            showClass: {
			popup: 'animate__animated animate__flipInX'
			},
			hideClass: {
			popup: 'animate__animated animate__flipOutX'
			}
        }).then((result) => {
        if (result.isConfirmed) {
            location.href = ('https://factin-online.com/factin/Business-Tracking');
        } else if (result.isDenied) {
        }
        });
	</script>
    @endif

    @if (session('SecondCreation') == "NoEncontrado")
		<script>
			Swal.fire({
				icon: 'error',
				title: 'Oops..',
				text: 'no se pudo almacenar',
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
