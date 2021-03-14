
@extends('home')

@section('title', 'Seguimiento')

@section('modules')
    <div class="container-fluid" style="margin: 0.2% 10%">
        <div class="row">
            <div class="col-md-8">
                <h6 class="navbar-brand">SEGUIMIENTO</h6>
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
                            <a href="#" title="Bitacora" class=" btn-edit form-control-sm BitacoraCreation-link">
                                <span class="icon-list-alt"></span>
                                <span hidden>{{$item->foll_id}}</span>
                                <span hidden>{{$item->bt_social}}</span>
                            </a>
                            <a href="#" title="Cierre" class="btn-delete form-control-sm RequestCreation-link">
                                <span class="icon-check-square-o"></span>
                                <span hidden>{{$item->foll_cli}}</span>
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

    {{-- bitacora --}}
    <div class="modal fade" id="newBitacora-modal">
        <div class="modal-dialog modal-lg" style="font-size: 16px">
            <div class="modal-content">
                <div class="modal-header text-justify">
                    <h5 class="text-primary"><em><b>BITACORA</b></em></h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('tracing.save')}}" method="post">
                        @csrf
                        <div class="card-body p4 border">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">Bitacora Cliente</small><br>
                                                <b class="Client"></b>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">Fecha</small><br>
                                                <b class="dat"></b>
                                                <input type="hidden" name="tkreq_date">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" style="margin-top: 11px; margin-left: 31px">
                                                <button class="btn btn-outline-danger Newregister">Nuevo Registro</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 row bloq" style="display: none">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <small class="text-muted">Observaciones</small>
                                            <textarea name="tkreq_obs" id="" cols="30" rows="5" class="form-control form-control-sm" required></textarea>
                                            <input type="hidden" name="tkreq_foll_id">
                                            <input type="hidden" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="margin-top: 8%">
                                        <button class="btn btn-outline-success" style="margin-left: 32%">GUARDAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table id="tableDatatable" class="table table-hover table-bordered text-center top-modal tblhistorial" witdh="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FECHA BITACORA</th>
                                <th>OBSERVACIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- dinamics --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="invisible">
        <form action="{{route('tracing.close')}}" method="post" class="tracingClose">
        @csrf
        <input type="hidden" name="tkreq_folls_id">
        </form>
    </div>

    @endsection

    @section('ScriptZone')
	<script>
        $('.RequestCreation-link').click(function (e) {
            e.preventDefault();
            let cli = $(this).find('span:nth-child(2)').text();
            $('input[name=tkreq_folls_id]').val(cli);
            $('.tracingClose').submit();
        });

		$('.BitacoraCreation-link').click(function (e) {
            e.preventDefault();
            let days = new Date();
            let day = days.getDate();
            let dayl = days.getDay();
            let mont = days.getMonth();
            let year = days.getFullYear();
            let myid = $(this).find('span:nth-child(2)').text();
            let cli = $(this).find('span:nth-child(3)').text();
            $('.Client').text(cli);
            $('input[name=name]').val(cli);
            switch (dayl) {
                case 0: dayv = 'Domingo'; break; case 1: dayv = 'Lunes'; break; case 2: dayv = 'Martes'; break; case 3: dayv = 'Miercoles'; break; case 4: dayv = 'Jueves'; break; case 5: dayv = 'Viernes'; break; case 6: dayv = 'Sabado'; break;
            }
            switch(mont){
                case 0: mon = "enero"; break; case 1: mon = "febrero"; break; case 2: mon = "marzo"; break; case 3: mon = "abril"; break; case 4: mon = "mayo"; break; case 5: mon = "junio"; break; case 6: mon = "julio"; break; case 7: mon = "agosto"; break; case 8: mon = "septiembre"; break; case 9: mon = "octubre"; break; case 10: mon = "noviembre"; break; case 11: mon = "diciembre"; break;
            }
            $('.dat').text(dayv+', '+day+'-'+mon+'-'+year);
            $('input[name=tkreq_date]').val(dayv+', '+day+'-'+mon+'-'+year);
            $('input[name=tkreq_foll_id]').val(myid);
            $.get("{{route('getFollow')}}", {data: myid},
            function (objectFollow) {
                $('.tblhistorial tbody').empty();
                console.log(objectFollow);
                let counter = 1;
                for (let i =0; i < objectFollow.length; i++) {
                    $('.tblhistorial tbody').append(
                        "<tr>"+
                            "<td>"+ counter++ +"</td>"+
                            "<td>"+objectFollow[i]['tkreq_date']+"</td>"+
                            "<td>"+objectFollow[i]['tkreq_obs']+"</td>"+
                        "</tr>"
                    );
                }
            });
            $('#newBitacora-modal').modal();
        });

        $('.Newregister').click(function (e) {
            e.preventDefault();
            $('.bloq').toggle(2000);
            $('.Newregister').text(($(this).text() == 'Nuevo Registro') ? 'Ocultar Obs' : 'Nuevo Registro');
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
