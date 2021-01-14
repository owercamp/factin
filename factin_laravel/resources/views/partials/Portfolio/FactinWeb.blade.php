
@extends('modules.settingPortfolio')

@section('info')
	<div>
		<div class="row border-bottom">
			<div class="col-md-4">
				<h6 class="navbar-brand">Factin Web</h6>
			</div>
			<div  class="col-md-4 text-center">
				<button type="button" title="Registrar" class="btn-success form-control-sm newProductWeb-link"><b>Nuevo</b></button>
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
					<th>PRODUCTO</th>
					<th>VALOR</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row=1; @endphp
				@foreach ($factin as $item)	
				<tr>
					<td>{{$row++}}</td>
					<td>{{$item->pro_name}}</td>
					<td><b>{{number_format($item->price,2,',','.')}}</b></td>
					<td>
						<a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
							<span class="icon-magic"></span>
							<span hidden>{{ $item->por_id }}</span>
							<span hidden>{{ $item->pro_name }}</span>
						</a>
						<a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
							<span class="icon-proxmox"></span>
							<span hidden>{{ $item->por_id }}</span>
							<span hidden>{{ $item->pro_name }}</span>
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
	{{-- creación de mi formulario de creación documento --}}
	<div class="modal fade" id="newCreationWeb-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>NUEVO PORTAFOLIO WEB</h6>
				</div>
				<div class="modal-body">
					<form action="#" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12 container-sm">
								<div class="row justify-content-center">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL PRODUCTO WEB:</small>											
											<select name="porweb" class="form-control form-control-sm" required>
												<option value="">Seleccione Producto</option>
												
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<button type="submit" class="btn-success form-control-sm btn-saveDefinitive"><b>GUARDAR</b></button>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>
@endsection

@section('scripts')
	<script>
		// Llama al formulario modal de creación
		$('.newProductWeb-link').on('click',function(){
			$('#newCreationWeb-modal').modal();
        });
	</script>
@endsection