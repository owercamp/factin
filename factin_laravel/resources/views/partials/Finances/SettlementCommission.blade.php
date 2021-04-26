
@extends('modules.settingFinance')

@section('info')
    <form action="{{route('commission.save')}}" method="POST" class="container table-bordered border m-auto p-1 pt-3">
        @csrf
        <div class="col-sm-12 row m-auto">
            <div class="form-group col-sm-4">
                <label class="text-muted mb-n3">COLABORADOR</label>
                <select name="ColaSelected" class="form-control form-control-sm mt-1">
                    <option value="">Seleccione...</option>
                    @foreach ($collaborators as $item)
                        <option value="{{$item->id}}">{{$item->col_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="text-muted mb-n3">MES</label>
                <select name="MonthSelected" class="form-control form-control-sm mt-1">
                    <option value="">Seleccione...</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
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
                <label class="text-muted mb-n3">AÑO</label>
                <select name="YearSelected" class="form-control form-control-sm mt-1">
                    <option value="">Seleccione...</option>
                    <option value="{{$yearnow}}">{{$yearnow}}</option>
                    <option value="{{$yearfutureOne}}">{{$yearfutureOne}}</option>
                    <option value="{{$yearfutureTwo}}">{{$yearfutureTwo}}</option>
                    <option value="{{$yearfutureThree}}">{{$yearfutureThree}}</option>
                    <option value="{{$yearfutureFour}}">{{$yearfutureFour}}</option>
                    <option value="{{$yearfutureFive}}">{{$yearfutureFive}}</option>
                </select>
            </div>
        </div>        
        <div class="w-100 mt-n2 mb-3">
            <button type="submit" class="btn btn-outline-success d-block m-auto">GENERAR</button>
        </div>
    </form>
    <div class="container-fluid mt-4">
        <table id="tableDatatable" class="table-bordered table text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>COLABORADOR</th>
                    <th>MES</th>
                    <th>AÑO</th>
                    <th>COMISION</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            @php
                $row = 1;
            @endphp
            <tbody>
                @foreach ($facturations as $item)
                    <tr>
                        <th>{{$row++}}</th>
                        <th>{{$item->col_name}}</th>
                        <th>{{$item->co_month}}</th>
                        <th>{{$item->co_year}}</th>
                        <th class="version-color">{{number_format($item->co_comi,0,',','.')}}</th>
                        <th><a href="#" title="Imprimir" class="btn-edit form-control-sm Imprimir-PDF">
                            <span class="icon-arrow-circle-down"></span>
                            <span hidden>{{$item->co_id}}</span>
                        </a></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="invisible">
            <form action="{{route('commission.pdf')}}" method="post" class="pdfcommission">
                @csrf
                <input type="text" name="commissionPDF">
            </form>
        </div>
    </div>
@endsection
@section('ScriptZone')
    <script>
        // envio lo que deseo imprimir
        $('.Imprimir-PDF').click(function (e) { 
            e.preventDefault();
            var printer;
            printer = $(this).find('span:nth-child(2)').text();
            $('input[name=commissionPDF]').val(printer);
            $('.pdfcommission').submit();
        });
    </script>
    @if (session('Success') == 'Success')
    <script>
		Swal.fire({
			icon: 'success',
			title: '<h3 class="text-info text-center">PDF generado correctamente</h3>',
			html: '<strong class="text-dark text-monospace">consulte el archivo generado en la tabla</strong>',
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
    @if (session('SecondaryCreation') == 'Duplicate')
    <script>
		Swal.fire({
			icon: 'warning',
			title: '<h3 class="text-info text-center">error al generar el PDF</h3>',
			html: '<strong class="text-dark text-monospace">ya hay un archivo existente puede consultarlo en el listado de la tabla</strong>',
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