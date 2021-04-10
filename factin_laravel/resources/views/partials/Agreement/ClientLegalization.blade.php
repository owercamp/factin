

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
                                <span hidden>{{$item->legal_id}}</span>
                                <span hidden>{{$item->legal_social}}</span>
                                <span hidden>{{$item->legal_dep}}</span>
                                <span hidden>{{$item->legal_mun}}</span>
                                <span hidden>{{$item->legal_adr}}</span>
                                <span hidden>{{$item->legal_pho}}</span>
                                <span hidden>{{$item->legal_what}}</span>
                                <span hidden>{{$item->legal_ema}}</span>
                                <span hidden>{{$item->legal_typeClient}}</span>
                                <span hidden>{{$item->legal_typeDocRSocial}}</span>
                                <span hidden>{{$item->legal_DocRSocial}}</span>
                                <span hidden>{{$item->legal_repre}}</span>
                                <span hidden>{{$item->legal_typeDocRepre}}</span>
                                <span hidden>{{$item->legal_DocRepre}}</span>
                                <span hidden>{{$item->legal_Cola}}</span>
                                <span hidden>{{$item->legal_comi}}</span>
                            </a>
                            <a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
                                <span class="icon-proxmox"></span>
                                <span hidden>{{$item->legal_id}}</span>
                                <span hidden>{{$item->legal_social}}</span>
                                <span hidden>{{$item->legal_typeClient}}</span>
                                <span hidden>{{$item->legal_repre}}</span>
                                <span hidden>{{$item->legal_DocRepre}}</span>
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
                    <form action="{{route('ClientLegalization.save')}}" method="POST">
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
                                                    @foreach ($ClientActive as $item)
                                                        @if($item->lead_status == "APROBADO")
                                                            <option value="{{$item->lead_id}}">{{$item->bt_social}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                {{-- traer la informacion de aprobados de las archivo comercial --}}
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
                                                    {{-- api de busqueda que carga los departamentos segun razón social en ScriptZone ↓ --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">MUNICIPIO:</small>
                                                <select name="ClMun" id="MunName" class="form-control form-control-sm" required>
                                                    <option value=''>Seleccione un Municipio</option>
                                                    {{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">DIRECCION:</small>
                                                <input type="text" id="ClDir" name="ClDir" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm">
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
                                                <select name="CltypeCli" class="form-control form-control-sm" required>
                                                    <option value="">Seleccione..</option>
                                                    <option value="PERSONA NATURAL">PERSONA NATURAL</option>
                                                    <option value="PERSONA JURIDICA">PERSONA JURIDICA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">TIPO DOCUMENTO:</small>
                                                <select name="ClDoc" class="form-control form-control-sm" required>
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
                                                <select name="ClDocRepre" class="form-control form-control-sm" required>
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
                                                <input type="text" name="ClNumeroRepre" maxlength="15" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin: 0% 10%;">
                                                <small class="text-muted">COLABORADOR</small>
                                                <select name="ClCola" class="form-control form-control-sm">
                                                    <option value="">Seleccione...</option>
                                                    @foreach ($Collaborator as $item)
                                                        <option value="{{$item->id}}">{{$item->col_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin: 0% 10%;">
                                                <small class="text-muted">COMISION</small>
                                                <input type="text" name="ClComi" class="form-control form-control-sm text-primary font-weight-bolder">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="padding-top: 3%">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-edit" style="margin: 1% 45%">GUARDAR</button>
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

    {{-- creacion del formulario de edicion --}}
    <div class="modal fade" id="newCreationEdit-modal">
        <div class="modal-dialog modal-lg" style="font-size: 15px">
            <div class="modal-content">
                <div class="modal-header text-justify">
                    <h5 class="text-primary" style="margin-top: 5px"><em><b>EDITAR LEGALIZACION CLIENTE</b></em></h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('ClientLegalization.update')}}" method="POST">
                        @csrf
                        <div style="padding: 2%">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">RAZON SOCIAL:</small>
                                                <select id="ClSocial" name="ClSocial_Edit" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                                    <option value="">Seleccione Razón Social</option>
                                                    @foreach ($Client as $item)
                                                        @if($item->lead_status == "APROBADO")
                                                            <option value="{{$item->lead_id}}">{{$item->bt_social}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                {{-- traer la informacion de aprobados de las archivo comercial --}}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">DEPARTAMENTO:</small>
                                                <select name="ClDep_Edit" id="DepName" class="form-control form-control-sm" required>
                                                    <option value="">Seleccione un departamento</option>
                                                    @foreach ($Departament as $item)
                                                        <option value="{{$item->depid}}">{{$item->depname}}</option>
                                                    @endforeach
                                                    {{-- api de busqueda que carga los departamentos segun razón social en ScriptZone ↓ --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">MUNICIPIO:</small>
                                                <select name="ClMun_Edit" id="MunName" class="form-control form-control-sm" required>
                                                    <option value=''>Seleccione un Municipio</option>
                                                    {{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">DIRECCION:</small>
                                                <input type="text" id="ClDir_Edit" name="ClDir_Edit" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <small class="text-muted">TELEFONO:</small>
                                                <input type="text" name="ClTel_Edit" maxlength="10" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <small class="text-muted">WHATSAPP:</small>
                                                <input type="text" name="ClWhat_Edit" maxlength="10" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">CORREO ELECTRONICO</small>
                                                <input type="email" name="ClEma_Edit" maxlength="100" placeholder="example@correo.com.co" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">TIPO CLIENTE:</small>
                                                <select name="CltypeCli_Edit" class="form-control form-control-sm" required>
                                                    <option value="">Seleccione..</option>
                                                    <option value="PERSONA NATURAL">PERSONA NATURAL</option>
                                                    <option value="PERSONA JURIDICA">PERSONA JURIDICA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">TIPO DOCUMENTO:</small>
                                                <select name="ClDoc_Edit" class="form-control form-control-sm" required>
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
                                                <input type="text" name="ClNumero_Edit" maxlength="15" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">REPRESENTANTE LEGAL:</small>
                                                <input type="text" name="ClRepresentante_Edit" maxlength="50" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">TIPO DOCUMENTO REPRESENTANTE LEGAL:</small>
                                                <select name="ClDocRepre_Edit" class="form-control form-control-sm" required>
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
                                                <input type="text" name="ClNumeroRepre_Edit" maxlength="15" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin: 0% 10%;">
                                                <small class="text-muted">COLABORADOR</small>
                                                <select name="ClCola_Edit" class="form-control form-control-sm">
                                                    <option value="">Seleccione...</option>
                                                    @foreach ($Collaborator as $item)
                                                        <option value="{{$item->id}}">{{$item->col_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin: 0% 10%;">
                                                <small class="text-muted">COMISION</small>
                                                <input type="text" name="ClComi_Edit" class="form-control form-control-sm text-primary font-weight-bolder">
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
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- creacion del formulario de eliminación --}}
    <div class="modal fade" id="newCreationDelete-modal">
        <div class="modal-dialog" style="font-size: 15px;">
            <div class="modal-content">
                <div class="modal-header" style="margin: auto">
                    <h5>ELIMINACION LEGALIZACION CLIENTE</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <small class="text-muted">TIPO CLIENTE</small><br>
                            <span class="text-muted"><b class="typeCDelete"></b></span><br>
                            <small class="text-muted">RAZON SOCIAL</small><br>
                            <span class="text-muted"><b class="rsocialDelete"></b></span><br>
                            <small class="text-muted">DOCUMENTO</small><br>
                            <span class="text-muted"><b class="DocDelete"></b></span><br>
                            <small class="text-muted">REPRESENTANTE LEGAL</small><br>
                            <span class="text-muted"><b class="repreDelete"></b></span>
                        </div>
                    </div>
                    <div class="row mt-3 border-top text-center">
                        <form action="{{route('ClientLegalization.delete')}}" method="post" class="cold-md-6 DeleteSend" style="margin: auto">
                            @csrf
                            <input type="hidden" name="LegalCli_Delete" class="form-control form-control-sm" readonly required>
                            <button type="submit" class="btn btn-edit form-control-sm my-3" >ELIMINAR</button>
                        </form>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-delete form-control-sm mt-3" data-dismiss="modal">CANCELAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('ScriptZone')
    <script>
        // consulta clientes de la tbl agreements
        $('select[name=ClSocial]').change(function (e) { 
            e.preventDefault();
            $('select[name=ClDep]').val("");
            $('select[name=ClMun]').empty();
            $('select[name=ClMun]').append("<option value=''>Seleccione un Municipio</option>");
            $('input[name=ClDir]').val("");
            $('input[name=ClTel]').val("");
            $('input[name=ClWhat]').val("");
            let id = $('select[name=ClSocial]').val();            
            $.get("{{route('getClientLegal')}}", {data: id},
                function (objectClientLegal) {
                    $('select[name=ClDep]').val(objectClientLegal[0]['lead_dep']);
                    $.get("{{route('getMunicipalities')}}",{DepId: objectClientLegal[0]['lead_dep']}, function(objectMunicipality){
						var count = Object.keys(objectMunicipality).length;
						if (count > 0) {
							for (let index = 0; index < count; index++) {
								if (objectMunicipality[index]['munid'] == objectClientLegal[0]['lead_mun']) {
									$('select[name=ClMun]').append("<option value='"+objectMunicipality[index]['munid']+"' selected>"+objectMunicipality[index]['munname']+"</option>");
								} else {
									$('select[name=ClMun]').append("<option value='"+objectMunicipality[index]['munid']+"'>"+objectMunicipality[index]['munname']+"</option>");
								}
							}
						}
					});
                    $('input[name=ClDir]').val(objectClientLegal[0]['lead_adr']);
                    $('input[name=ClTel]').val(objectClientLegal[0]['lead_pho']);
                    $('input[name=ClWhat]').val(objectClientLegal[0]['lead_what']);
                    $('input[name=ClEma]').val(objectClientLegal[0]['lead_ema']);                    
                }
            );
        });
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
                    var cid,rs,dep,mun,adr,pho,what,ema,tc,td,nd,rep,tdrep,ndrep,cola,comi;
                    cid = $(this).find('span:nth-child(2)').text();
                    rs = $(this).find('span:nth-child(3)').text();
                    dep = $(this).find('span:nth-child(4)').text();
                    mun = $(this).find('span:nth-child(5)').text();
                    adr = $(this).find('span:nth-child(6)').text();
                    pho = $(this).find('span:nth-child(7)').text();
                    what = $(this).find('span:nth-child(8)').text();
                    ema = $(this).find('span:nth-child(9)').text();
                    tc = $(this).find('span:nth-child(10)').text();
                    td = $(this).find('span:nth-child(11)').text();
                    nd = $(this).find('span:nth-child(12)').text();
                    rep = $(this).find('span:nth-child(13)').text();
                    tdrep = $(this).find('span:nth-child(14)').text();
                    ndrep = $(this).find('span:nth-child(15)').text();
                    cola = $(this).find('span:nth-child(16)').text();
                    comi = $(this).find('span:nth-child(17)').text();
                    $('select[name=ClSocial_Edit]').val(rs);
                    $('select[name=ClDep_Edit]').val(dep);
                    $('select[name=ClMun_Edit]').empty();
                    $('select[name=ClMun_Edit]').append("<option value=''>Seleccione un Municipio</option>");
                    $.get("{{route('getMunicipalities')}}",{DepId: dep}, function(objectMunicipality){
						var count = Object.keys(objectMunicipality).length;
						if (count > 0) {
							for (let index = 0; index < count; index++) {
								if (objectMunicipality[index]['munid'] == mun) {
									$('select[name=ClMun_Edit]').append("<option value='"+objectMunicipality[index]['munid']+"' selected>"+objectMunicipality[index]['munname']+"</option>");
								} else {
									$('select[name=ClMun_Edit]').append("<option value='"+objectMunicipality[index]['munid']+"'>"+objectMunicipality[index]['munname']+"</option>");
								}
							}
						}
					});
                    $('input[name=ClComi_Edit]').val(comi);
                    $('input[name=ClComi_Edit]').focus();
                    $('input[name=ClDir_Edit]').val(adr);
                    $('input[name=ClTel_Edit]').val(pho);
                    $('input[name=ClWhat_Edit]').val(what);
                    $('input[name=ClEma_Edit]').val(ema);
                    $('select[name=CltypeCli_Edit]').val(tc);
                    $('select[name=ClDoc_Edit]').val(td);
                    $('input[name=ClNumero_Edit]').val(nd);
                    $('input[name=ClRepresentante_Edit]').val(rep);
                    $('select[name=ClDocRepre_Edit]').val(tdrep);
                    $('input[name=ClNumeroRepre_Edit]').val(ndrep);
                    $('select[name=ClCola_Edit]').val(cola);
                    $('input[name=id_Edit]').val(cid);
					$('#newCreationEdit-modal').modal();
				}
			})
		});

        // llama al formulario de eliminacion
        $('.deleteCreation-link').click(function (e) {
            e.preventDefault();
            var lid,rsocial,docrepre,repre, tyrepre;
            lid = $(this).find('span:nth-child(2)').text();
            rsocial = $(this).find('span:nth-child(3)').text();
            docrepre = $(this).find('span:nth-child(6)').text();
            repre = $(this).find('span:nth-child(5)').text();
            tyrepre = $(this).find('span:nth-child(4)').text();
            $('input[name=LegalCli_Delete]').val(lid);
            $.get("{{route('getRazonSocialActive')}}", {data: rsocial},
                function (objectSocial) {
                    for (let index = 0; index < objectSocial.length; index++) {
                        if(objectSocial[index]['lead_id'] == rsocial){
                            $('b.rsocialDelete').text(objectSocial[0].bt_social);
                        }
                    }
                }
            );
            $('b.DocDelete').text(docrepre);
            $('b.repreDelete').text(repre);
            $('b.typeCDelete').text(tyrepre);
            $('#newCreationDelete-modal').modal();
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
			text: '¡ha ocurrido un error!',
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
				text: 'Legalización cliente no encontrado',
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
