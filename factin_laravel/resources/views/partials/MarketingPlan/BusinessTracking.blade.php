
@extends('modules.settingMarketing')

@section('info')
	<div>
		<div class="row border-bottom">
			<div class="col-md-4">
				<h6 class="navbar-brand">SEGUIMIENTO DE NEGOCIOS</h6>
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
				@foreach ($business as $item)
					<tr>
						<th>{{$row++}}</th>
						<th>{{$item->bt_social}}</th>
						<th>{{$item->bt_con}}</th>
						<th>{{$item->munname}}</th>
						<th id="OpPhono">{{0}}{{$item->bt_pho}}</th>
						<th>
							<a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
								<span class="icon-magic"></span>
								{{-- <span hidden>{{ $item->por_id }}</span>
								<span hidden>{{ $item->pro_name }}</span>
								<span hidden>{{ $item->price }}</span>
								<span hidden>{{ $item->cpro_id}}</span> --}}
							</a>
							<a href="#" title="Bitacora" class="btn-delete form-control-sm deleteCreation-link">
								<span class="icon-list-alt"></span>
								{{-- <span hidden>{{ $item->por_id }}</span>
								<span hidden>{{ $item->pro_name }}</span>
								<span hidden>{{ $item->price }}</span>
								<span hidden>{{ $item->cpro_id}}</span> --}}
							</a>
							<a href="#" title="Aprobar" class="btn-edit form-control-sm deleteCreation-link">
								<span class="icon-check"></span>
								{{-- <span hidden>{{ $item->por_id }}</span>
								<span hidden>{{ $item->pro_name }}</span>
								<span hidden>{{ $item->price }}</span>
								<span hidden>{{ $item->cpro_id}}</span> --}}
							</a>
							<a href="#" title="No Aprobar" class="btn-delete form-control-sm deleteCreation-link">
								<span class="icon-close"></span>
								{{-- <span hidden>{{ $item->por_id }}</span>
								<span hidden>{{ $item->pro_name }}</span>
								<span hidden>{{ $item->price }}</span>
								<span hidden>{{ $item->cpro_id}}</span> --}}
							</a>
						</th>
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
	
@endsection