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
            <div class="mt-3">
                <table id="tableDatatable" class="w-100 table table-bordered table-responsive-md text-center" style="font-size: 15px;" id="tblMonth">
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
