

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
                            </a>
                            <a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
                                <span class="icon-proxmox"></span>
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
                    <form action="#" method="POST">
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
                                                <input type="text" id="ClDir_Edit" name="ClDir" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm">
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
                    var rs,dep,mun,adr,pho,what,ema,tc,td,nd,rep,tdrep,ndrep;
                    rs = $(this).find('span:nth-child(2)').text();
                    dep = $(this).find('span:nth-child(3)').text();
                    mun = $(this).find('span:nth-child(4)').text();
                    adr = $(this).find('span:nth-child(5)').text();
                    pho = $(this).find('span:nth-child(6)').text();
                    what = $(this).find('span:nth-child(7)').text();
                    ema = $(this).find('span:nth-child(8)').text();
                    tc = $(this).find('span:nth-child(9)').text();
                    td = $(this).find('span:nth-child(10)').text();
                    nd = $(this).find('span:nth-child(11)')text();
                    rep = $(this).find('span:nth-child(12)').text();
                    tdrep = $(this).find('span:nth-child(13)').text();
                    ndrep = $(this).find('span:nth-child(14)').text();
					$('#newCreationEdit-modal').modal();
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
			text: '¡registro ya existente!',
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
