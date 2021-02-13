

@extends('modules.settingAgreement')

@section('info')
    <div>
        <div class="row border-bottom">
            <div class="col-md-4">
                <h6 class="navbar-brand">LEGALIZACION CLIENTE</h6>
            </div>
            <div class="col-md-4 text-center">
                <button type="button" title="Registrar" class="btn-success form-control-sm newCreation-link"><b>Añadir legalización</b></button>
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
                    <th>TIPO CLIENTE</th>
                    <th>RAZON SOCIAL</th>
                    <th>DOCUMENTO</th>
                    <th>REPRESENTANTE LEGAL</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $row=1;
                @endphp
                @foreach ($Client as $item)
                    <tr>
                        <td>{{$row++}}</td>
                        <td>{{$item->legal_typeClient}}</td>
                        <td>{{$item->bt_social}}</td>
                        <td>{{$item->legal_DocRepre}}</td>
                        <td>{{$item->legal_repre}}</td>
                        <td>
                            <a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
                                <span class="icon-magic"></span>
                            </a>
                            <a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
                                <span class="icon-proxmox"></span>
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

    {{-- creacion de formulario para ingresar legalización cliente --}}
    <div class="modal fade" id="newCreation-modal">
        <div class="modal-dialog modal-lg" style="font-size: 15px">
            <div class="modal-content">
                <div class="modal-header text-justify">
                    <h5 class="text-primary" style="margin-top: 5px"><em><b>LEGALIZACION CLIENTE</b></em></h5>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        @csrf
                        <div style="padding: 2%">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">DEPARTAMENTO:</small>
                                                <select name="ClDep" id="DepName" class="form-control form-control-sm" required>
                                                    <option value="">Seleccione un departamento</option>
                                                    @foreach ($Departament as $item)
                                                        <option value="{{$item->depid}}">{{$item->depname}}</option>
                                                    @endforeach
                                                    api de busqueda que carga los departamentos segun razón social en ScriptZone ↓
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">MUNICIPIO:</small>
                                                <select name="ClMun" id="MunName" class="form-control form-control-sm" required>
                                                    <option value=''>Seleccione un Municipio</option>
                                                    api de busqueda que carga los municipios segun departamento en ScriptZone ↓
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">DIRECCION:</small>
                                                <input type="text" id="ClDir" name="CoDir" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm">
                                            </div>
                                        </div>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">CORREO ELECTRONICO</small>
                                                <input type="email" name="ClEma" maxlength="100" placeholder="example@correo.com.co" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">TIPO CLIENTE:</small>
                                                <select name="CoCat" class="form-control form-control-sm" required>
                                                    <option value="">Seleccione..</option>
                                                    <option value="PersonaNatural">PERSONA NATURAL</option>
                                                    <option value="PersonaJuridica">PERSONA JURIDICA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                                                <input type="text" name="ClNumero" maxlength="15" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">REPRESENTANTE LEGAL:</small>
                                                <input type="text" name="ClRepresentante" maxlength="50" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">N° DOCUMENTO REPRESENTANTE LEGAL:</small>
                                                <input type="text" name="ClNumero" maxlength="15" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="padding-top: 3%">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-edit" style="margin: 1% 45%">GUARDAR</button>
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
        </div>
    </div>
@endsection

@section('ScriptZone')
    <script>
        // lanza formulario creación
		$('.newCreation-link').on('click',function(){
			$('#newCreation-modal').modal();
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
    </script>
@endsection
