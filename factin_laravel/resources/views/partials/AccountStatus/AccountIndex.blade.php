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
                    <select name="YearSelect" class="form-control form-control-sm h-100 text-center text-md-center">
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
                }
            @endphp            
            <div class="w-100 p-sm-2 text-center mt-3 text-bold text-info font-weight-bold MyMonth">{{ __('Cuentas Mes: ').$mount.__(' de ').$yearnow }}</div>
            <div class="loader"></div>            
            <div class="mt-3 carga">
                <table id="tableDatatable" class="w-100 table table-bordered text-center tcount" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th># CONTRATO</th>
                            <th>IDENTIFICACION</th>
                            <th>RAZON SOCIAL</th>
                            <th>VALOR CUOTA</th>
                            <th>COLABORADOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Dinamics --}}
                    </tbody>
                </table>
                <div class="w-100"><input class="form-control form-control-sm font-weight-bold text-danger m-auto w-25" type="text" name="subtotal" value="0"></div>
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
                        var Valueegress = 0;
                        objectDataMonth.forEach(element => {
                            let {con_final, conNumber, con_typeiderepre, bt_social, con_valueqouta, col_name} = element; let yearDate = new Date(con_final); let yearSearch = yearDate.getFullYear(); let monthSearch = yearDate.getMonth();                            
                            if (yearSearch == year && index <= monthSearch) {                                
                                $('.tcount tbody').append(
                                    "<tr>"+
                                        "<td>"+('0000'+conNumber).slice(-4)+"</td>"+
                                        "<td>"+con_typeiderepre+"</td>"+
                                        "<td>"+bt_social+"</td>"+
                                        "<td>"+con_valueqouta+"</td>"+
                                        "<td>"+col_name+"</td>"+
                                    "</tr>"
                                    );
                                    Valueegress += con_valueqouta;
                            }
                        });
                        $('input[name=subtotal]').val(Valueegress);
                        $('input[name=subtotal]').maskMoney();
                        $('input[name=subtotal]').focus();
                    }
                );
                $('.loader').fadeOut(2200);
                $('.carga').fadeIn(2200);
            });            
        });
    </script>
@endsection
