
@extends('modules.settingMarketing')

@section('info')
	<div>
		<div class="row border-bottom">
			<div class="col-md-4">
				<h6 class="navbar-brand">ARCHIVO DE NEGOCIOS</h6>
			</div>
			{{-- <div  class="col-md-4 text-center">
				<button type="button" title="Historial" class="btn-success form-control-sm History-link"><b>Historiales</b></button>
			</div> --}}
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
		<table id="tableDatatable" class="table table-hover table-bordered text-center top-modal">
			<thead>
				<tr>
					<th>#</th>
					<th>RAZON SOCIAL</th>
					<th>CONTACTO</th>
					<th>MUNICIPIO</th>
					<th>TELEFONO</th>
					<th>ESTADO</th>
				</tr>
			</thead>
			<tbody>
				@php
					$row =1;
				@endphp
				@foreach ($business as $item)
					@if ($item->bt_status != null)
					<tr>
						<th>{{$row++}}</th>
						<th>{{$item->bt_social}}</th>
						<th>{{$item->bt_con}}</th>
						<th>{{$item->munname}}</th>
						<th>{{$item->bt_pho}}</th>
						@if ($item->bt_status == 'APROBADO')
						<th><span class="badge badge-success" style="font-size: 15px">{{$item->bt_status}}</span></th>
						@else
						<th><span class="badge badge-warning" style="font-size: 15px">{{$item->bt_status}}</span></th>
						@endif
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

	<div class="modal fade" id="History-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<div class="form-group col">
						<div class="col-md-12 text-center">
							<small class="text-muted" style="font-size: 22px">Bitacoras</small>
						</div>
						<div class="row" style="margin-top: 15px">
							<div class="col-md-7">
								<div class="form-group">
									<select name="social" id="rsocial" title="RAZON SOCIAL: (Oportunidades de negocio)" class="form-control form-control-sm" style="margin-top: 2px" required>
										<option value="">Seleccione...</option>
										@foreach ($business as $item)
											<option value="{{$item->bt_id}}">{{$item->bt_social}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<button class="btn btn-dark form-control-sm searck-link">CONSULTAR</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-body MyForm">
					<div class="col-ms-12">
						<table id="tableDatatable" class="table table-hover table-bordered text-center col-ms-10 tblHistory" style="font-size: 12px" >
							<thead>
								<tr>
									<th>#</th>
									<th>FECHA</th>
									<th>BITACORA</th>
								</tr>
							</thead>
							<tbody>
								{{-- Section Dinamics --}}
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('ScriptZone')
	<script>
		$('.History-link').click(function (e) {
			e.preventDefault();
			$('.MyForm').hide("slow");
			$('#History-modal').modal();
		});

		$('.searck-link').click(function (e) {
			e.preventDefault();
			$('.MyForm').hide("slow");
			$('.tblHistory tbody').empty();
			var socialSelected = $('#rsocial').val();
			$.get("{{route('getTekens')}}", {data: socialSelected},
				function (HistoryTeken) {
					var count = Object.keys(HistoryTeken).length;
					if (count > 0) {
						var counter = 1;
						for (let i = 0; i < count; i++) {
							$('.tblHistory tbody').append(
								"<tr>"+
									"<td>"+ counter++ +"</td>"+
									"<td>"+HistoryTeken[i]['tk_date']+"</td>"+
									"<td>"+HistoryTeken[i]['tk_teken']+"</td>"+
								"</tr>"
							);
						}
					}
			});
			$('.MyForm').show("slow");
		});
	</script>
@endsection
