
@extends('modules.settingCustomers')

@section('info')
    <div>
        <div class="row border-bottom">
            <div class="col-md-8">
                <h6 class="navbar-brand">SEGUIMIENTO COMERCIAL</h6>
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
                @foreach ($commercial as $item)
                    @if ($item->lead_status == null)
                    <tr>
                        <th>{{$row++}}</th>
                        <th>{{$item->bt_social}}</th>
                        <th>{{$item->lead_con}}</th>
                        <th>{{$item->munname}}</th>
                        <th>{{$item->lead_pho}}</th>
                        <th>
                            <a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
                                <span class="icon-magic"></span>
                                <span hidden>{{$item->lead_id}}</span>
                                <span hidden>{{$item->lead_Date}}</span>
                                <span hidden>{{$item->lead_social}}</span>
                                <span hidden>{{$item->lead_tide}}</span>
                                <span hidden>{{$item->lead_ide}}</span>
                                <span hidden>{{$item->lead_dep}}</span>
                                <span hidden>{{$item->lead_mun}}</span>
                                <span hidden>{{$item->lead_adr}}</span>
                                <span hidden>{{$item->lead_con}}</span>
                                <span hidden>{{$item->lead_pho}}</span>
                                <span hidden>{{$item->lead_what}}</span>
                                <span hidden>{{$item->lead_ema}}</span>
                                <span hidden>{{$item->lead_obs}}</span>
                                <span hidden>{{$item->lead_pro}}</span>
                                <span hidden>{{$item->lead_value}}</span>
                                <span hidden>{{$item->lead_quantity}}</span>
                                <span hidden>{{$item->lead_sub}}</span>
                                <span hidden>{{$item->lead_porcentage}}</span>
                                <span hidden>{{$item->lead_iva}}</span>
                                <span hidden>{{$item->lead_total}}</span>
                            </a>
                            <a href="#" title="Bitacora" class="btn-delete form-control-sm BitacoraCreation-link">
                                <span class="icon-list-alt"></span>
                                <span hidden>{{$item->lead_id}}</span>
                                <span hidden>{{$item->lead_Date}}</span>
                                <span hidden>{{$item->lead_social}}</span>
                                <span hidden>{{$item->lead_tide}}</span>
                                <span hidden>{{$item->lead_ide}}</span>
                                <span hidden>{{$item->lead_dep}}</span>
                                <span hidden>{{$item->lead_mun}}</span>
                                <span hidden>{{$item->lead_adr}}</span>
                                <span hidden>{{$item->lead_con}}</span>
                                <span hidden>{{$item->lead_pho}}</span>
                                <span hidden>{{$item->lead_what}}</span>
                                <span hidden>{{$item->lead_ema}}</span>
                                <span hidden>{{$item->lead_obs}}</span>
                                <span hidden>{{$item->lead_pro}}</span>
                                <span hidden>{{$item->lead_value}}</span>
                                <span hidden>{{$item->lead_quantity}}</span>
                                <span hidden>{{$item->lead_sub}}</span>
                                <span hidden>{{$item->lead_porcentage}}</span>
                                <span hidden>{{$item->lead_iva}}</span>
                                <span hidden>{{$item->lead_total}}</span>
                            </a>
                            <a  href="#" title="Aprobar" class="btn-edit form-control-sm AprobarCreation-link">
                                <span class="icon-check"></span>
                                <span hidden>{{$item->lead_id}}</span>
                            </a>
                            <a href="#" title="No Aprobar" class="btn-delete form-control-sm NoAprobarCreation-link">
                                <span class="icon-close"></span>
                                <span hidden>{{$item->lead_id}}</span>
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
                    <h5 class="text-primary" style="margin-top: 5px"><b>EDICION SEGUIMIENTO COMERCIAL</b></h5>
                </div>
                <div class="modal-body">
                    <form action="#" id="FormCommercial_Edit" method="POST">
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
                                                    @foreach ($commercial as $item)
                                                        @if($item->lead_status == "")
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
                                                <select name="CoTipo" class="form-control form-control-sm" required >
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
                                                <input type="text" name="CoNumero" maxlength="50" style="text-transform: uppercase" class="form-control form-control-sm" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">DEPARTAMENTO:</small>
                                                <select name="CoDep" id="DepName" class="form-control form-control-sm" required >
                                                    <option value="">Seleccione un departamento</option>
                                                    @foreach ($departament as $item)
                                                        <option value="{{$item->depid}}">{{$item->depname}}</option>
                                                    @endforeach
                                                    {{-- api de busqueda que carga los departamentos segun razón social en ScriptZone ↓ --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">MUNICIPIO:</small>
                                                <select name="CoMun" id="MunName" class="form-control form-control-sm" required >
                                                    <option value=''>Seleccione un Municipio</option>
                                                    {{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">DIRECCION:</small>
                                                <input type="text" id="CoDir" name="CoDir" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">CONTACTO:</small>
                                                <input type="text" name="CoCon" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <small class="text-muted">TELEFONO:</small>
                                                <input type="text" name="CoTel" maxlength="10" class="form-control form-control-sm" required >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">WHATSAPP:</small>
                                                <input type="text" name="CoWhat" maxlength="10" class="form-control form-control-sm" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <small class="text-muted">CATEGORIA:</small>
                                                <select name="CoCat" class="form-control form-control-sm" required >
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
                                                <input type="text" name="CoProText" id="CoProText" class="form-control form-control-sm">
                                                <select name="CoPro" id="CoPro" class="form-control form-control-sm" hidden>
                                                    <option value="">Seleccione Producto</option>
                                                    {{-- select dimanics --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <small class="text-muted">PRECIO:</small>
                                                <input type="text" name="CoPrice" style="font-weight: bold" class="form-control form-control-sm text-primary" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">CORREO ELECTRONICO</small>
                                                <input type="email" name="CoEma" maxlength="100" placeholder="example@correo.com.co" class="form-control form-control-sm" >
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <small class="text-muted">CANTIDAD:</small>
                                                <input type="text" name="CoCan"  maxlength="4" class="form-control form-control-sm text-dark"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <small class="text-muted">SUBTOTAL:</small>
                                                <input type="text" name="CoSub" style="font-weight: bold" class="form-control form-control-sm text-primary"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <small class="text-muted">% IVA:</small>
                                                <input type="text" name="CoIva" style="font-weight: bold" maxlength="4" class="form-control form-control-sm text-iva"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <small class="text-muted">VALOR IVA:</small>
                                                <input type="text" style="font-weight: bold" name="CoVIva" class="form-control form-control-sm text-primary"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <small class="text-muted">TOTAL:</small>
                                                <input type="text" style="font-weight: bold" name="CoTotal" class="form-control form-control-sm text-primary"  required>
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
                                                <textarea name="CoObs" cols="30" rows="10" maxlength="1000" class="form-control form-control-sm" >
                                                </textarea>
                                                <input type="hidden" class="form-control form-control-sm" name="Coid" readonly required>
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

@endsection

@section('ScriptZone')
	<script>
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
					var lid,ldate,lsocial,ldep,lmun,ladr,lcon,ltip,lide,lcat,lpho,lwhat,lema,lobs,lpro,lvalue,lquantity,lsub,lpor,liva,ltotal;
					lid = $(this).find('span:nth-child(2)').text();
					ldate = $(this).find('span:nth-child(3)').text();
                    lsocial = $(this).find('span:nth-child(4)').text();
                    ltip = $(this).find('span:nth-child(5)').text();
                    lide =$(this).find('span:nth-child(6)').text();
					ldep = $(this).find('span:nth-child(7)').text();
					lmun = $(this).find('span:nth-child(8)').text();
					ladr = $(this).find('span:nth-child(9)').text();
					lcon = $(this).find('span:nth-child(10)').text();
					lpho = $(this).find('span:nth-child(11)').text();
					lwhat = $(this).find('span:nth-child(12)').text();
					lema = $(this).find('span:nth-child(13)').text();
                    lobs = $(this).find('span:nth-child(14)').text();
                    lpro = $(this).find('span:nth-child(15)').text();
                    lvalue = $(this).find('span:nth-child(16)').text();
                    lquantity = $(this).find('span:nth-child(17)').text();
                    lsub = $(this).find('span:nth-child(18)').text();
                    lpor = $(this).find('span:nth-child(19)').text();
                    liva = $(this).find('span:nth-child(20)').text();
                    ltotal = $(this).find('span:nth-child(21)').text();
					$('input[name=CoDate]').val(ldate);
					$('select[name=CoSocial]').val(lsocial);
                    $('select[name=CoDep]').val(ldep);
                    $('select[name=CoTipo]').val(ltip);
					$('select[name=CoMun]').empty();
					$('select[name=CoMun]').append("<option value=''>Seleccione un Municipio</option>");
					$.get("{{route('getMunicipalities')}}",{DepId: ldep}, function(objectMunicipality){
                        var count = Object.keys(objectMunicipality).length;
						if (count > 0) {
                            for (let index = 0; index < count; index++) {
                                if (objectMunicipality[index]['munid'] == lmun) {
                                    $('select[name=CoMun]').append("<option value='"+objectMunicipality[index]['munid']+"' selected>"+objectMunicipality[index]['munname']+"</option>");
								} else {
                                    $('select[name=CoMun]').append("<option value='"+objectMunicipality[index]['munid']+"'>"+objectMunicipality[index]['munname']+"</option>");
								}
							}
						}
					});
                    $('input[name=CoProHidden]').val(lpro);
					$('input[name=CoDir]').val(ladr);
					$('input[name=CoCon]').val(lcon);
					$('input[name=CoTel]').val(lpho);
					$('input[name=CoWhat]').val(lwhat);
					$('input[name=CoEma]').val(lema);
                    $('input[name=Coid]').val(lid);
                    $('input[name=CoNumero]').val(lide);
                    $('input[name=CoPrice]').val(lvalue);
                    $('input[name=CoCan]').val(lquantity);
                    $('input[name=CoSub]').val(lsub);
                    $('input[name=CoIva]').val(lpor);
                    $('input[name=CoVIva]').val(liva);
                    $('input[name=CoTotal]').val(ltotal);
                    $('input[name=CoProText]').val(lpro);
					$('textarea[name=CoObs]').val(lobs);
					$('#newEditTra-modal').modal();
				}
			})
        });

        $('input[name=CoProText]').focus(function (e) {
            e.preventDefault();
            $('input[name=CoProText]').prop('disabled', true);

            const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'info',
            title: 'Para editar un producto seleccione una categoria'
            })
        });

        $('select[name=CoCat]').change(function(e) {
            var MySelect = e.target.value;
            $('input[name=CoProText]').prop('hidden',true);
            $('select[name=CoPro]').prop('hidden',false);
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
	</script>
@endsection
