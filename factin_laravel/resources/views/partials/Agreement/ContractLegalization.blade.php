
@extends('modules.settingAgreement')

@section('info')
    <div>
        <div class="row border-bottom">
            <div class="col-md-4">
                <h6 class="navbar-brand">LEGALIZACION CONTRATO</h6>
            </div>
            <div class="col-md-4 text-center">
                <button type="button" title="Registrar" class="btn-success form-control-sm newCreation-link"><b>Añadir Contrato</b></button>
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
                    <th>CONTRATO</th>
                    <th>RAZON SOCIAL</th>
                    <th>DOCUMENTO</th>
                    <th>VALOR CONTRATO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $row=1;
                @endphp
                @foreach ($contract as $item)
                    @if ($item->con_final >= date("Y-m-d"))
                        <tr>
                            <td>{{$row++}}</td>
                            <td>{{sprintf("%'.04d\n",$item->conNumber)}}</td>
                            <td>{{$item->bt_social}}</td>
                            <td>{{$item->con_typeiderepre}}</td>
                            <td><b class="version-color">{{number_format($item->con_price,0,',','.')}}</b></td>
                            <td>
                                <a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
                                    <span class="icon-magic"></span>
                                    <span hidden>{{$item->con_id}}</span>
                                    <span hidden>{{$item->conNumber}}</span>
                                    <span hidden>{{$item->con_social}}</span>
                                    <span hidden>{{$item->con_typeiderepre}}</span>
                                    <span hidden>{{$item->con_repre}}</span>
                                    <span hidden>{{$item->con_numero}}</span>
                                    <span hidden>{{$item->con_ini}}</span>
                                    <span hidden>{{$item->con_final}}</span>
                                    <span hidden>{{$item->con_price}}</span>
                                    <span hidden>{{$item->con_quota}}</span>
                                    <span hidden>{{$item->con_valueqouta}}</span>
                                    <span hidden>{{$item->con_fquota}}</span>
                                </a>
                                <a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
                                    <span class="icon-proxmox"></span>
                                    <span hidden>{{$item->con_id}}</span>
                                    <span hidden>{{$item->conNumber}}</span>
                                    <span hidden>{{$item->con_social}}</span>
                                    <span hidden>{{$item->con_repre}}</span>
                                    <span hidden>{{$item->con_price}}</span>
                                </a>
                                <a href="#" title="Imprimir" class="btn-edit form-control-sm Imprimir-PDF">
                                    <span class="icon-arrow-circle-down"></span>
                                    <span hidden>{{$item->con_id}}</span>
                                </a>
                            </td>
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

    {{-- creacion de formulario para ingresar legalización cliente --}}
    <div class="modal fade" id="newCreationContract-modal">
        <div class="modal-dialog modal-lg" style="font-size: 15px">
            <div class="modal-content">
                <div class="modal-header text-justify">
                    <h5 class="text-primary" style="margin-top: 5px"><em><b>LEGALIZACION CONTRATO</b></em></h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('ContractLegalization.save')}}" method="POST">
                        @csrf
                        <div style="padding: 2%">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">NUMERO CONTRATO</small><br>
                                                <span class="text-muted" style="margin-left: 20%; font-size: 18px"><b class="ClContract text-primary"></b></span>
                                                <input type="hidden" name="ClContract" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">RAZON SOCIAL:</small>
                                                <select id="ClSocial" name="ClSocial" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                                    <option value="">Seleccione Razón Social</option>
                                                    @foreach ($legal as $item)
                                                            <option value="{{$item->legal_id}}">{{$item->bt_social}}</option>
                                                    @endforeach
                                                </select>
                                                {{-- traer la informacion de aprobados de las archivo comercial --}}
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <small class="text-muted">REPRESENTANTE</small>
                                            <input type="text" name="ClRepre" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">TIPO IDENTIFICACION</small>
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
                                                <small class="text-muted">FECHA INICIO:</small>
                                                <input type="text" name="ClFIni" class="form-control form-control-sm datepicker">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">FECHA TERMINACION:</small>
                                                <input type="text" name="ClFFinal" class="form-control form-control-sm datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">TELEFONO</small>
                                                <input type="text" name="ClTel" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">PRIMERA CUOTA</small>
                                                <input type="text" name="ClFQuota" class="form-control form-control-sm datepicker">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">VALOR CONTRATO:</small>
                                                <input type="text" name="ClValue" style="font-weight: bold" class="form-control form-control-sm text-primary" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">CANTIDAD CUOTAS:</small>
                                                <input type="text" name="ClQuota" style="text-align: center; font-weight: bold;" class="form-control form-control-sm text-primary" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">VALOR CUOTA:</small>
                                            <input type="text" name="ClQuotaValue" style="text-align: center; font-weight: bold;" class="form-control form-control-sm text-primary">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="padding-top: 3%">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-edit" style="margin: 1% 40%">GUARDAR</button>
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
                    <h5 class="text-primary" style="margin-top: 5px"><em><b>EDITAR LEGALIZACION CONTRATO</b></em></h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('ContractLegalization.update')}}" method="POST">
                        @csrf
                        <div style="padding: 2%">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">NUMERO CONTRATO</small><br>
                                                <span class="text-muted" style="margin-left: 20%; font-size: 18px"><b class="ClContract_Edit text-primary"></b></span>
                                                <input type="hidden" name="ClContract_Edit" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">RAZON SOCIAL:</small>
                                                <select id="ClSocial" name="ClSocial_Edit" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                                    <option value="">Seleccione Razón Social</option>
                                                    @foreach ($legal as $item)
                                                            <option value="{{$item->legal_id}}">{{$item->bt_social}}</option>
                                                    @endforeach
                                                </select>
                                                {{-- traer la informacion de aprobados de las archivo comercial --}}
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <small class="text-muted">REPRESENTANTE</small>
                                            <input type="text" name="ClRepre_Edit" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">TIPO IDENTIFICACION</small>
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
                                                <small class="text-muted">FECHA INICIO:</small>
                                                <input type="text" name="ClFIni_Edit" class="form-control form-control-sm datepicker">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">FECHA TERMINACION:</small>
                                                <input type="text" name="ClFFinal_Edit" class="form-control form-control-sm datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">TELEFONO</small>
                                                <input type="text" name="ClTel_Edit" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">PRIMERA CUOTA</small>
                                                <input type="text" name="ClFQuota_Edit" class="form-control form-control-sm datepicker">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">VALOR CONTRATO:</small>
                                                <input type="text" name="ClValue_Edit" style="font-weight: bold" class="form-control form-control-sm text-primary" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">CANTIDAD CUOTAS:</small>
                                                <input type="text" name="ClQuota_Edit" style="text-align: center; font-weight: bold;" class="form-control form-control-sm text-primary" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">VALOR CUOTA:</small>
                                            <input type="text" name="ClQuotaValue_Edit" style="text-align: center; font-weight: bold;" class="form-control form-control-sm text-primary">
                                        </div>
                                    </div>
                                    <div class="row border-top mt-3 text-center">
                                        <div class="col-md-6">
                                            <input type="hidden" class="form-control form-control-sm" name="Cl_id_Edit" readonly required>
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
                    <h5>ELIMINACION CONTRATO</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <small class="text-muted">N° CONTRATO</small><br>
                            <span class="text-muted"><b class="ContractDelete"></b></span><br>
                            <small class="text-muted">RAZON SOCIAL</small><br>
                            <span class="text-muted"><b class="rsocialDelete"></b></span><br>
                            <small class="text-muted">REPRESENTANTE</small><br>
                            <span class="text-muted"><b class="RepreDelete"></b></span><br>
                            <small class="text-muted">PRECIO</small><br>
                            <span class="text-muted"><b class="PriceDelete"></b></span>
                        </div>
                    </div>
                    <div class="row mt-3 border-top text-center">
                        <form action="{{route('ContractLegalization.delete')}}" method="post" class="cold-md-6 DeleteSend" style="margin: auto">
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
        // lanza formulario creación
		$('.newCreation-link').on('click',function(){
            $('b.ClContract').empty();
            $.get("{{route('getContract')}}",
            function (objectContract) {
                if (objectContract == 0) {
                    let val = 1;
                    $('b.ClContract').append(("0000"+val).slice(-4));
                    $('input[name=ClContract]').val(val);
                }else{
                    let sum = objectContract[0].conNumber + 1;
                    $('b.ClContract').append(("0000"+sum).slice(-4));
                    $('input[name=ClContract]').val(sum);
                }
            }
            );
			$('#newCreationContract-modal').modal();
		});

        $('input[name=ClValue]').change(function () {
            let value = $('input[name=ClValue]').val();
            let quota = $('input[name=ClQuota]').val();
            let valuecl = value.replace(/\./g,"");
            let strTotal = valuecl / quota;
            $('input[name=ClQuotaValue]').val(Math.round(strTotal));
            $('input[name=ClQuotaValue]').focus();
        });

        $('input[name=ClValue_Edit]').change(function () {
            let value = $('input[name=ClValue_Edit]').val();
            let quota = $('input[name=ClQuota_Edit]').val();
            let valuecl = value.replace(/\./g,"");
            let strTotal = valuecl / quota;
            $('input[name=ClQuotaValue_Edit]').val(Math.round(strTotal));
            $('input[name=ClQuotaValue_Edit]').focus();
        });

        $('input[name=ClValue]').focus(function () {
            let ClValue = $('input[name=ClValue]').val();
            let clValue = ClValue.replace(/\./g,"");
            $('input[name=ClValue]').val(clValue);
        });

        $('input[name=ClValue_Edit]').focus(function () {
            let ClValue = $('input[name=ClValue_Edit]').val();
            let clValue = ClValue.replace(/\./g,"");
            $('input[name=ClValue_Edit]').val(clValue);
        });

        $('input[name=ClQuotaValue]').focus(function () {
            let MyValue = $('input[name=ClQuotaValue]').val();
            let strMyValue = MyValue.replace(/\./g,"");
            $('input[name=ClQuotaValue]').val(strMyValue);
        });

        $('input[name=ClQuotaValue_Edit]').focus(function () {
            let MyValue = $('input[name=ClQuotaValue_Edit]').val();
            let strMyValue = MyValue.replace(/\./g,"");
            $('input[name=ClQuotaValue_Edit]').val(strMyValue);
        });

        $('input[name=ClQuota]').change(function () {
            let quota = $('input[name=ClQuota]').val();
            let ClValue = $('input[name=ClValue]').val();
            let strClValue = ClValue.replace(/\./g,"");
            let total = strClValue / quota;
            $('input[name=ClQuotaValue]').val(Math.round(total));
            $('input[name=ClQuotaValue]').focus();
        });

        $('input[name=ClQuota_Edit]').change(function () {
            let quota = $('input[name=ClQuota_Edit]').val();
            let ClValue = $('input[name=ClValue_Edit]').val();
            let strClValue = ClValue.replace(/\./g,"");
            let total = strClValue / quota;
            $('input[name=ClQuotaValue_Edit]').val(Math.round(total));
            $('input[name=ClQuotaValue_Edit]').focus();
        });

        $('select[name=ClSocial]').change(function () {
            let social = $('select[name=ClSocial]').val();
            $('input[name=ClRepre]').val('');
            $('input[name=ClTel]').val('');
            $('select[name=ClDoc]').val("");
            $.get("{{route('getLegalContract')}}", {data: social},
                function (objectSocialContract) {
                    console.log(objectSocialContract);
                    $('input[name=ClRepre]').val(objectSocialContract[0].legal_repre);
                    $('select[name=ClDoc]').val(objectSocialContract[0].legal_typeDocRepre);
                    $('input[name=ClTel]').val(objectSocialContract[0].legal_pho);
                }
            );
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
                    let id,contract,social,tiderepre,repre,number,ini,final,price,quota,vquota,fquota;
                    id = $(this).find('span:nth-child(2)').text();
                    contract = $(this).find('span:nth-child(3)').text();
                    social = $(this).find('span:nth-child(4)').text();
                    tiderepre = $(this).find('span:nth-child(5)').text();
                    repre = $(this).find('span:nth-child(6)').text();
                    number = $(this).find('span:nth-child(7)').text();
                    ini = $(this).find('span:nth-child(8)').text();
                    final = $(this).find('span:nth-child(9)').text();
                    price = $(this).find('span:nth-child(10)').text();
                    quota = $(this).find('span:nth-child(11)').text();
                    vquota = $(this).find('span:nth-child(12)').text();
                    fquota = $(this).find('span:nth-child(13)').text();
                    $('b.ClContract_Edit').empty();
                    $('b.ClContract_Edit').append(("0000"+contract).slice(-4));
                    $('input[name=ClContract_Edit]').val(contract);
                    $('input[name=ClValue_Edit]').val(price);
                    $('input[name=ClQuotaValue_Edit]').val(vquota);
                    $('select[name=ClSocial_Edit]').empty();
                    $('select[name=ClSocial_Edit]').append("<option value=''>Seleccione Razón Social</option>");
                    $.get("{{route('getLegalContractUpdate')}}", {data: social},
                    function (objectContractSocial) {
                        $('input[name=ClValue_Edit]').focus();
                        for (let index = 0; index < objectContractSocial.length; index++) {
                            if (objectContractSocial[index]['con_id'] == social) {
                                $('select[name=ClSocial_Edit]').append("<option value='"+objectContractSocial[index]['con_id']+"' selected>"+objectContractSocial[index]['bt_social']+"</option>");
                            }else{
                                $('select[name=ClSocial_Edit]').append("<option value='"+objectContractSocial[index]['con_id']+"'>"+objectContractSocial[index]['bt_social']+"</option>");
                            }
                        }
                    }
                    );
                    $('input[name=ClQuotaValue_Edit]').focus();
                    $('input[name=ClRepre_Edit]').val(repre);
                    $('select[name=ClDoc_Edit]').val(tiderepre);
                    $('input[name=ClFIni_Edit]').val(ini);
                    let fech, year,month,mon,dayl,dayv;
                    fech = new Date(final);
                    dayl = final.split('-');
                    days = fech.getDay()+1;
                    month = dayl[1];
                    num = dayl[2];
                    year = dayl[0];
                    switch (days) {
                        case 7: dayv = 'Domingo'; break; case 1: dayv = 'Lunes'; break; case 2: dayv = 'Martes'; break; case 3: dayv = 'Miercoles'; break; case 4: dayv = 'Jueves'; break; case 5: dayv = 'Viernes'; break; case 6: dayv = 'Sabado'; break;
                    }
                    switch(month){
                        case '01': mon = "enero"; break; case '02': mon = "febrero"; break; case '03': mon = "marzo"; break; case '04': mon = "abril"; break; case '05': mon = "mayo"; break; case '06': mon = "junio"; break; case '07': mon = "julio"; break; case '08': mon = "agosto"; break; case '09': mon = "septiembre"; break; case '10': mon = "octubre"; break; case '11': mon = "noviembre"; break; case '12': mon = "diciembre"; break;
                    }
                    $('input[name=ClFFinal_Edit]').val(dayv+', '+num+'-'+mon+'-'+year);
                    $('input[name=ClTel_Edit]').val(number);
                    $('input[name=ClFQuota_Edit]').val(fquota);
                    $('input[name=ClQuota_Edit]').val(quota);
                    $('input[name=Cl_id_Edit]').val(id);
					$('#newCreationEdit-modal').modal();
				}
			})
		});



        // llama al formulario de eliminacion
        $('.deleteCreation-link').click(function (e) {
            e.preventDefault();
            var cid,cnumber,rsocial,repre, price;
            cid = $(this).find('span:nth-child(2)').text();
            cnumber = $(this).find('span:nth-child(3)').text();
            rsocial = $(this).find('span:nth-child(4)').text();
            repre = $(this).find('span:nth-child(5)').text();
            price = $(this).find('span:nth-child(6)').text();
            $('input[name=LegalCli_Delete]').val(cid);
            $.get("{{route('getLegalContract')}}", {data: rsocial},
                function (objectSocial) {
                    for (let index = 0; index < objectSocial.length; index++) {
                        if(objectSocial[index]['lead_id'] == rsocial){
                            $('b.rsocialDelete').text(objectSocial[0].bt_social);
                        }
                    }
                }
            );
            $('b.ContractDelete').text(('0000'+cnumber).slice(-4));
            $('b.RepreDelete').text(repre);
            $('b.PriceDelete').text(price);
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
