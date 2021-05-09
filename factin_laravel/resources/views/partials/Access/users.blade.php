
@extends('modules.settingAccess')

@section('info')
	<div class="w-100 d-flex p-2">
		<div class="col-md-6">
			<h5 class="text-left ml-4 mt-2 text-bold text-black-50">USUARIOS</h5>
		</div>
		<div class="col-md-6">
			<a href="{{route('register')}}" class="btn btn-outline-secondary">Nuevo Usuario</a>
		</div>
	</div>
	<div class="container-fluid">
		<table class="table table-striped text-center">
			<thead>
				<tr>
					<th>#</th>
					<th>COLABORADOR</th>
					<th>ROL</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php
					$row = 1;
				@endphp
				@foreach ($users as $item)
					@if ($item->name != 'ower armando campos alfonso' && $item->name != 'javier vargas prieto')
						<tr>
							<td>{{$row++}}</td>
							<td>{{$item->name}}</td>
							<td></td>
							<td></td>
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){

		});
	</script>
@endsection