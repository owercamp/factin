

@extends('modules.settingAgreement')

@section('info')
    <div>
        <div class="row border-bottom">
        </div>
        <div class="card">
            <div class="card-header text-center">
                <h5 class="text-primary" style="margin-top: 5px"><em><b>LEGALIZACION CLIENTE</b></em></h5>
            </div>
            <form action="#" id="FormCommercial" method="POST">
                @csrf
                <div class="card-body p-4 border">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">RAZON SOCIAL:</small>
                                        <select id="ClSocial" name="ClSocial" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                            <option value="">Seleccione Razón Social</option>
                                            @foreach ($Client as $item)
                                                @if($item->lead_status == "APROBADO")
                                                    <option value="{{$item->lead_id}}">{{$item->bt_social}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        {{-- traer la informacion de aprobados de las oportunidades de negocio --}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">DEPARTAMENTO:</small>
                                        <select name="ClDep" id="DepName" class="form-control form-control-sm" required>
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
                                        <select name="ClMun" id="MunName" class="form-control form-control-sm" required>
                                            <option value=''>Seleccione un Municipio</option>
                                            {{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">DIRECCION:</small>
                                        <input type="text" id="ClDir" name="CoDir" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <small class="text-muted">TELEFONO:</small>
                                        <input type="text" name="ClTel" maxlength="10" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <small class="text-muted">WHATSAPP:</small>
                                        <input type="text" name="ClWhat" maxlength="10" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">CORREO ELECTRONICO</small>
                                        <input type="email" name="ClEma" maxlength="100" placeholder="example@correo.com.co" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <small class="text-muted">TIPO CLIENTE:</small>
                                        <select name="CoCat" class="form-control form-control-sm" required>
                                            <option value="">Seleccione..</option>
                                            <option value="PersonaNatural">PERSONA NATURAL</option>
                                            <option value="PersonaJuridica">PERSONA JURIDICA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">TIPO DOCUMENTO:</small>
										<select name="CoTipo" class="form-control form-control-sm" required>
											<option value="">Seleccione un tipo</option>
											<option value="CEDULA DE CIUDADANIA">CEDULA DE CIUDADANIA</option>
											<option value="NIT">NIT</option>
											<option value="PASAPORTE">PASAPORTE</option>
                                            <option value="CEDULA DE EXTRANJERIA">CEDULA DE EXTRANJERIA</option>
										</select>
									</div>
								</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">NUMERO DE DOCUMENTO:</small>
										<input type="text" name="ClNumero" maxlength="15" style="text-transform: uppercase" class="form-control form-control-sm" required>
									</div>
								</div>
                                <div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">REPRESENTANTE LEGAL:</small>
										<input type="text" name="ClRepresentante" maxlength="50" style="text-transform: uppercase" class="form-control form-control-sm" required>
									</div>
								</div>
                                <div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">TIPO DOCUMENTO REPRESENTANTE LEGAL:</small>
										<select name="CoTipo" class="form-control form-control-sm" required>
											<option value="">Seleccione un tipo</option>
											<option value="CEDULA DE CIUDADANIA">CEDULA DE CIUDADANIA</option>
											<option value="NIT">NIT</option>
											<option value="PASAPORTE">PASAPORTE</option>
                                            <option value="CEDULA DE EXTRANJERIA">CEDULA DE EXTRANJERIA</option>
										</select>
									</div>
								</div>
                                <div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">N° DOCUMENTO REPRESENTANTE LEGAL:</small>
										<input type="text" name="ClNumero" maxlength="15" style="text-transform: uppercase" class="form-control form-control-sm" required>
									</div>
								</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-edit" style="margin: 1% 45%">ALMACENAR</button>
                                    </div>
                                    <input type="hidden" id="capture" name="CoProHidden">
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
    </script>
@endsection
