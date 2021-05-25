@extends('home')

@section('modules')
    <div class="row col-md-12">
        <div class="col-md-2">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item btn list-group-item-action list-group-item-primary font-weight-bolder">ENERO</li><div class="dropdown-divider"></div>
                <li class="list-group-item btn list-group-item-action list-group-item-primary font-weight-bolder">FEBRERO</li><div class="dropdown-divider"></div>
                <li class="list-group-item btn list-group-item-action list-group-item-primary font-weight-bolder">MARZO</li><div class="dropdown-divider"></div>
                <li class="list-group-item btn list-group-item-action list-group-item-primary font-weight-bolder">ABRIL</li><div class="dropdown-divider"></div>
                <li class="list-group-item btn list-group-item-action list-group-item-primary font-weight-bolder">MAYO</li><div class="dropdown-divider"></div>
                <li class="list-group-item btn list-group-item-action list-group-item-primary font-weight-bolder">JUNIO</li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="justify-content-between d-flex container-fluid">
                <h4 class="text-primary">Información Cuentas</h4>
                @php
                    $yearnow = date('Y');
					$mountnow = date('m');
					// $yearbeforeThree = date('Y') - 3;
					// $yearbeforeTwo = date('Y') - 2;
					// $yearbeforeOne = date('Y') - 1;
					$yearfutureOne = date('Y') + 1;
					$yearfutureTwo = date('Y') + 2;
					$yearfutureThree = date('Y') + 3;
					$yearfutureFour = date('Y') + 4;
                    $yearfutureFive = date('Y') + 5;

                @endphp
                <div class="table-bordered w-50 d-flex">
                    <small class="text-body text-bold w-50 p-md-2 bg-primary-50 text-center">AÑO A CONSULTAR:</small>
                    <select name="YearSelect" class="form-control form-control-sm h-100 text-center text-md-center" style="margin: 0">
                        <option value="">Seleccione Año</option>
                        <option value="{{ $yearnow }}" selected>{{ $yearnow }}</option>
						<option value="{{ $yearfutureOne }}">{{ $yearfutureOne }}</option>
						<option value="{{ $yearfutureTwo }}">{{ $yearfutureTwo }}</option>
						<option value="{{ $yearfutureThree }}">{{ $yearfutureThree }}</option>
						<option value="{{ $yearfutureFour }}">{{ $yearfutureFour }}</option>
                        <option value="{{ $yearfutureFive }}">{{ $yearfutureFive }}</option>
                    </select>
                </div>
            </div>
            @php
                switch ($mountnow) {
                    case '01': $mount = 'Enero'; break;
                    case '02': $mount = 'Febrero'; break;
                    case '03': $mount = 'Marzo'; break;
                    case '04': $mount = 'Abril'; break;
                    case '05': $mount = 'Mayo'; break;
                    case '06': $mount = 'Junio'; break;
                    case '07': $mount = 'Julio'; break;
                    case '08': $mount = 'Agosto'; break;
                    case '09': $mount = 'Septiembre'; break;
                    case '10': $mount = 'Octubre'; break;
                    case '11': $mount = 'Noviembre'; break;
                    case '12': $mount = 'Diciembre'; break;
                }
            @endphp            
            <div class="w-100 p-sm-2 text-center mt-3 text-bold text-info font-weight-bold MyMonth">{{ __('Cuentas Mes: ').$mount.__(' de ').$yearnow }}</div>
            <div class="loader"></div>            
            <div class="mt-3 carga">
                <form action="{{route('account.fact')}}" method="post" class="formFact">
                    @csrf
                    <table id="tableFactura" class="w-100 table table-hover table-bordered text-center top-modal tcount" style="font-size: 15px;">
                        <thead>
                            <tr>
                                <th># CONTRATO</th>
                                <th>IDENTIFICACION</th>
                                <th>RAZON SOCIAL</th>
                                <th>VALOR CUOTA</th>
                                <th>COLABORADOR</th>                                
                                <th>FACTURAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Dinamics --}}
                        </tbody>
                    </table>
                    <div class="d-flex" style="height: 112px !important">
                        {{-- <div class="inputWithIcon inputIconBg form-group w-50">
                            <label class="text-center text-info font-weight-light" style="margin: 1.3% 2%">VENTAS DEL MES</label>
                            <input class="form-control form-control-sm font-weight-bold text-danger w-50" type="text" name="subtotal" value="0"><span class="icon-credit-card-alt" aria-hidden="true"></span>
                        </div> --}}
                        <div class="w-100 d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-info font-weight-bold btn-group-sm m-auto fact">FACTURAR</button>
                        </div>
                    </div>
                    <input type="hidden" name="Month">
                    <input type="hidden" name="Year">                    
                </form>
            </div>
        </div>
        <div class="col-md-2">
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item list-group-item-action list-group-item-primary font-weight-bolder">JULIO</li><div class="dropdown-divider"></div>
                <li class="list-group-item list-group-item-action list-group-item-primary font-weight-bolder">AGOSTO</li><div class="dropdown-divider"></div>
                <li class="list-group-item list-group-item-action list-group-item-primary font-weight-bolder">SEPTIEMBRE</li><div class="dropdown-divider"></div>
                <li class="list-group-item list-group-item-action list-group-item-primary font-weight-bolder">OCTUBRE</li><div class="dropdown-divider"></div>
                <li class="list-group-item list-group-item-action list-group-item-primary font-weight-bolder">NOVIEMBRE</li><div class="dropdown-divider"></div>
                <li class="list-group-item list-group-item-action list-group-item-primary font-weight-bolder">DICIEMBRE</li>
            </ul>
        </div>
    </div>
@endsection

@section('ScriptZone')
    <script>
        $('li').each(function (index, element) {
            $(element).click(function (e) {
                $('.carga').fadeOut();
                $('.loader').fadeIn();
                e.preventDefault();                
                let year = $('select[name=YearSelect]').val();
                switch (index) {
                    case 0: $('.MyMonth').text('Cuentas Mes: Enero de '+year); break;
                    case 1: $('.MyMonth').text('Cuentas Mes: Febrero de '+year); break;
                    case 2: $('.MyMonth').text('Cuentas Mes: Marzo de '+year); break;
                    case 3: $('.MyMonth').text('Cuentas Mes: Abril de '+year); break;
                    case 4: $('.MyMonth').text('Cuentas Mes: Mayo de '+year); break;
                    case 5: $('.MyMonth').text('Cuentas Mes: Junio de '+year); break;
                    case 6: $('.MyMonth').text('Cuentas Mes: Julio de '+year); break;
                    case 7: $('.MyMonth').text('Cuentas Mes: Agosto de '+year); break;
                    case 8: $('.MyMonth').text('Cuentas Mes: Septiembre de '+year); break;
                    case 9: $('.MyMonth').text('Cuentas Mes: Octubre de '+year); break;
                    case 10: $('.MyMonth').text('Cuentas Mes: Noviembre de '+year); break;
                    case 11: $('.MyMonth').text('Cuentas Mes: Diciembre de '+year); break;
                }                
                $.get("{{route('getCountsMonth')}}",
                    function (objectDataMonth) { 
                        $('.tcount tbody').empty();
                        var Valueegress = 0, num = 0;
                        objectDataMonth.forEach(element => {
                            let {con_final, conNumber, con_typeiderepre, bt_social, con_valueqouta, col_name, con_id} = element; let yearDate = new Date(con_final); let yearSearch = yearDate.getFullYear(); let monthSearch = yearDate.getMonth();
                            if (yearSearch == year && index <= monthSearch) {                                
                                num++;
                                switch (index) {
                                    case 0: month = 'Enero'; break;
                                    case 1: month = 'Febrero'; break;
                                    case 2: month = 'Marzo'; break;
                                    case 3: month = 'Abril'; break;
                                    case 4: month = 'Mayo'; break;
                                    case 5: month = 'Junio'; break;
                                    case 6: month = 'Julio'; break;
                                    case 7: month = 'Agosto'; break;
                                    case 8: month = 'Septiembre'; break;
                                    case 9: month = 'Octubre'; break;
                                    case 10: month = 'Noviembre'; break;
                                    case 11: month = 'Diciembre'; break;
                                }
                                $.get("{{route('getFactCheck')}}", {month: month, year: year, quota: con_valueqouta},
                                    function (objectFactCheck) {
                                        console.log(objectFactCheck);
                                        if (objectFactCheck == "") {
                                            $('.tcount tbody').append(
                                                "<tr>"+
                                                    "<td><input type='hidden' name='NContract[]' value='"+con_id+"'><input type='hidden' name='Contracts[]' value="+('0000'+conNumber).slice(-4)+">"+('0000'+conNumber).slice(-4)+"</td>"+
                                                    "<td><input type='hidden' name='typedoc[]' value='"+con_typeiderepre+"'>"+con_typeiderepre+"</td>"+
                                                    "<td><input type='hidden' name='social[]' value='"+bt_social+"'>"+bt_social+"</td>"+
                                                    "<td><input type='hidden' name='quota[]' value='"+con_valueqouta+"'>"+con_valueqouta+"</td>"+
                                                    "<td><input type='hidden' name='cola[]' value='"+col_name+"'>"+col_name+"</td>"+
                                                    "<td class='d-flex justify-content-center'><select style='width: 62px' class='form-control form-control-sm' name='selection[]'>"+
                                                    "<option value='No'>No</option>"+
                                                    "<option value='Si'>Si</option>"+
                                                    "</select></td>"+
                                                "</tr>"
                                                );
                                                Valueegress += con_valueqouta;                                    
                                        }
                                    }
                                );
                            }
                        });
                        $('input[name=subtotal]').val(Valueegress);
                        $('input[name=subtotal]').maskMoney();
                        $('input[name=subtotal]').focus();
                        $('input[name=Month]').val(index);
                        $('input[name=Year]').val(year);
                    }
                );
                $('.loader').fadeOut(2800);
                $('.carga').fadeIn(2800);
            });            
        });        

        $('input[name=subtotal]').focus(function (e) { 
            e.preventDefault();
            let MyValue = $('input[name=subtotal]').val();
            let vsub = MyValue.replace(/\./g,"");
            $('input[name=subtotal]').val(vsub);
        });
        
        $('.fact').click(function (e) { 
            e.preventDefault();
            let month = $('input[name=Month]').val();
            let body = $('.tcount tbody').text();            
            if (month  !=  "") {
                if ( body != "") {                    
                    $('.formFact').submit();
                }else{
                    const alert = Swal.mixin({
                        timer:2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        },
                        showClass: {
                        popup: 'animate__animated animate__flipInX'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__flipOutX'
                        }
                    })
                    alert.fire({
                        icon: 'warning',
                        title: '<h3 class="text-info">Sin Registros</h3>',
                        html: '<p class="text-center text-dark">No hay datos para <em class="text-danger">facturar</em></p>'
                    })
                }
            }else{
                const Month = Swal.mixin({                    
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },
                    showClass: {
					popup: 'animate__animated animate__flipInX'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__flipOutX'
                    }
                })
                Month.fire({
                    icon: 'info',
                    title: '<h3 class="text-capitalize text-info">Sin Selección</h3>',
                    html: '<p class="text-black-50 text-bold">Seleccione un mes para realizar facturación</p>'
                })
            }
        });
    </script>
    @if (session('Success') == 'Success')
        <script>
            const fact = Swal.mixin({
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: false,
                didOpen: (mouse)=>{
                    mouse.addEventListener('mouseenter',Swal.stopTimer)
                    mouse.addEventListener('mouseleave',Swal.resumeTimer)
                },
                showClass: {
                    popup: 'animate__animated animate__flipInX'
                },
                hideClass: {
                    popup: 'animate__animated animate__flipOutX'
                }
            })
            fact.fire({
                icon: 'success',
                title: '<h3 class="text-capitalize text-md-center text-monospace text-secondary">Facturación Almacenada</h3>'
            })
        </script>
    @endif
@endsection
