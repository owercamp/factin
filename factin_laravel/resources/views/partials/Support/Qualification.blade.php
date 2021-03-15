
@extends('home')

@section('title', 'Calificación')

@section('modules')
    <div class="container-fluid" style="margin: 0.2% 10%">
        <div class="row">
            <div class="col-md-8">
                <h6 class="navbar-brand">CALIFICACION</h6>
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
                    <th>IDENTIFICACION USUARIO</th>
                    <th>CLIENTE</th>
                    <th>NOMBRE USUARIO</th>
                    <th>N° CONTRATO</th>
                    <th>COLABORADOR</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $row = 1;
                @endphp
                @foreach ($follow as $item)
                    @if ($item->foll_date_close != null)
                        <tr>
                            <th>{{$row++}}</th>
                            <th>{{$item->foll_ide}}</th>
                            <th>{{$item->bt_social}}</th>
                            <th>{{$item->foll_user}}</th>
                            <th>{{sprintf("%'.04d\n",$item->fol_con)}}</th>
                            @if ($item->foll_cola != null)
                                <th>
                                    @foreach ($collaborator as $col)
                                        @if($col->id = $item->foll_cola)
                                            {{$col->col_name}}
                                        @endif
                                    @endforeach
                                </th>
                            @else
                                <th>{{__('AUN NO ASIGNADO')}}</th>
                            @endif
                            <th>
                                <a href="#" title="Calificación" class=" btn-edit form-control-sm QualityCreation-link">
                                    <span class="icon-connectdevelop"></span>
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

    {{-- formulario de calificación --}}
    <div class="modal fade" id="newQuality-modal">
        <div class="modal-dialog modal-md" style="font-size: 16px">
        <div class="modal-content">
            <div class="modal-header text-justify">
                <h5 class="text-primary"><b>CALIFICACION</b></h5>
            </div>
            <div class="modal-body">
                <form action="{{route('user.rating')}}" method="post">
                    @csrf
                    <div class="card-body p4 border">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <small class="text-muted">Cliente</small><br>
                                            <b class="qua_cli"></b>
                                            <input type="hidden" name="qua_cli">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <small class="text-muted">Usuario</small><br>
                                            <b class="qua_user"></b>
                                            <input type="hidden" name="qua_user">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <small class="text-muted">Calificación</small>
                                            <select name="qua_cal" class="form-control form-control-sm">
                                                <option value="">Seleccione...</option>
                                                <option value="EXCELENTE">EXCELENTE</option>
                                                <option value="BUENO">BUENO</option>
                                                <option value="REGULAR">REGULAR</option>
                                                <option value="MALO">MALO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="tex-muted">Observaciones</small>
                                    <textarea name="qua_obs" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-outline-danger" style="margin-left: calc(80%/2); margin-top:2%">Calificar</button>
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
		$('.QualityCreation-link').click(function (e) {
            e.preventDefault();
            $('#newQuality-modal').modal();
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
			text: '¡configuración existente!',
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
				text: 'registro no encontrado',
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
	@if (session('Message') == 'MessageError')
		<script>
			Swal.fire({
				icon: 'info',
				title: 'Area en Construcción, Pronto estara disponible!',
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
