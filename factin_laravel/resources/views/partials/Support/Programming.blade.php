
@extends('home')

@section('title', 'Programación')

@section('modules')
    <div class="container-fluid" style="margin: 0.2% 10%">
        <div class="row">
            <div class="col-md-8">
                <h6 class="navbar-brand">PROGRAMACION</h6>
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
                @foreach ($soli as $item)
                    <tr>
                        <th>{{$row++}}</th>
                        <th>{{$item->req_ide}}</th>
                        <th>{{$item->bt_social}}</th>
                        <th>{{$item->req_user}}</th>
                        <th>{{sprintf("%'.04d\n",$item->req_con)}}</th>
                        @if ($item->req_cola != null)
                            <th>
                                @foreach ($Collaborator as $col)
                                    @if($col->id = $item->req_cola)
                                        {{$col->col_name}}
                                    @endif
                                @endforeach
                            </th>
                        @else
                            <th>{{__('AUN NO ASIGNADO')}}</th>
                        @endif
                        <th>
                            <a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
                                <span class="icon-magic"></span>
                                <span hidden>{{$item->req_id}}</span>
                                <span hidden>{{$item->req_ide}}</span>
                                <span hidden>{{$item->req_cli}}</span>
                                <span hidden>{{$item->req_user}}</span>
                                <span hidden>{{$item->req_con}}</span>
                                <span hidden>{{$item->req_sol1}}</span>
                                <span hidden>{{$item->req_sol2}}</span>
                                <span hidden>{{$item->req_sol3}}</span>
                            </a>
                            <a href="#" title="Respuesta" class="btn-delete form-control-sm RequestCreation-link">
                                <span class="icon-telegram"></span>
                                <span hidden>{{$item->uc_email}}</span>
                                <span hidden>{{$item->req_id}}</span>
                            </a>
                            <a href="#" title="Asignación" class="btn-edit form-control-sm AssignCreation-link">
                                <span class="icon-handshake-o"></span>
                                <span hidden>{{$item->req_id}}</span>
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

    {{-- formulario de edicion --}}
    <div class="modal face" id="newEdit-modal">
        <div class="modal-dialog modal-xl" style="font-size: 16px">
            <div class="modal-content">
                <div class="modal-header text-justify">
                    <h5 class="text-primary"><em><b>EDICION PROGRAMACION SOLICITUD</b></em></h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('programming.update')}}" method="post">
                        @csrf
                        <div class="card-body p4 border">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">IDENTIFICACION USUARIO</small>
                                                <input type="text" name="req_ide" class="form-control form-control-sm" disabled>{{-- debe consulta en la tabla de user_clients --}}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">CLIENTE</small>
                                                <select name="req_cli" class="form-control form-control-sm" disabled>
                                                    <option value="">Seleccione ...</option>
                                                    @foreach ($req as $item)
                                                        <option value="{{$item->id}}">{{$item->bt_social}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">USUARIO</small>
                                                <input type="text" name="req_user" class="form-control form-control-sm" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <small class="text-muted">CONTRATO</small>
                                                <input type="text" name="req_cont" class="form-control form-control-sm" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">SOLICITUD 1</small>
                                                <textarea name="req_sol1" cols="30" rows="10" class="form-control form-control-sm" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">SOLICITUD 2</small>
                                                <textarea name="req_sol2" cols="30" rows="10" class="form-control form-control-sm" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <small class="text-muted">SOLICITUD 3</small>
                                                <textarea name="req_sol3" cols="30" rows="10" class="form-control form-control-sm" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="req_id">
                                            <button type="submit" class="btn btn-edit" style="margin: auto calc(100%/2)">GUARDAR CAMBIOS</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-dark" style="margin: auto calc(50%/2.2)" data-dismiss="modal">CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- labla con los colaboradores --}}
    <div class="modal face" id="newCollaborator-modal">
        <div class="modal-dialog modal-md" style="font-size: 16px">
            <div class="modal-content">
                <div class="modal-header text-justify">
                    <h5 class="text-primary">COLABORADOR</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('programming.assign')}}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <label class="text-muted">Asignación de colaborador</label>
                            <select name="assigncol" class="form-control form-control-sm">
                                <option value="">Seleccione...</option>
                                @foreach ($Collaborator as $item)
                                    <option value="{{$item->id}}">{{$item->col_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12" style="margin: 3% calc(100%/3)">
                            <input type="hidden" name="req_id_assign">
                            <button class="btn btn-outline-primary">ASIGNAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- formulario de respuesta  --}}
    <div class="modal face" id="newResponsetoRequest-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-justify">
                    <h5 class="text-primary">FECHA SOLUCION</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('responsetorequest.response')}}" method="post">
                    @csrf
                    <div class="col-md-12" style="padding: 1% 15%">
                        <div class="form-group">
                            <small class="text-muted">FECHA PROXIMA PARA LA SOLUCION</small>
                            <input type="text" name="soldate" class="form-control form-control-sm datepicker text-center">
                            <input type="hidden" name="solemail" class="form-control form-control-sm text-center">
                            <input type="hidden" name="solid" class="form-control form-control-sm text-center">
                        </div>
                    </div>
                    <div class="form-group text-center mt-2">
                        <button type="submit" class="btn-outline-success form-control-sm"><b>GUARDAR</b></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('ScriptZone')
	<script>

        $('.RequestCreation-link').click(function (e) {
            e.preventDefault();
            let email, id;
            email = $(this).find('span:nth-child(2)').text();
            id = $(this).find('span:nth-child(3)').text();
            $('input[name=solemail]').val(email);
            $('input[name=solid]').val(id);
            $('#newResponsetoRequest-modal').modal();
        });

        $('.AssignCreation-link').click(function (e) {
            e.preventDefault();
            let id = $(this).find('span:nth-child(2)').text();
            $('input[name=req_id_assign]').val(id);
            $('#newCollaborator-modal').modal();
        });

        $('.editCreation-link').click(function(e){
			Swal.fire({
				title: 'Desea editar este registro?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#f58f4d',
                confirmButtonText: 'Si, editar',
                cancelButtonText: 'No',
                showClass: {
                popup: 'animate__animated animate__flipInX'
			},
                hideClass: {
                popup: 'animate__animated animate__flipOutX'
                },
            }).then((result) => {
                if (result.isConfirmed) {
					e.preventDefault();
                    let reqid,reqcli,reqide,requser,reqcon,reqsol1,reqsol2,reqsol3;
                    reqid = $(this).find('span:nth-child(2)').text();
                    reqcli = $(this).find('span:nth-child(4)').text();
                    reqide = $(this).find('span:nth-child(3)').text();
                    requser = $(this).find('span:nth-child(5)').text();
                    reqcon = $(this).find('span:nth-child(6)').text();
                    reqsol1 = $(this).find('span:nth-child(7)').text();
                    reqsol2 = $(this).find('span:nth-child(8)').text();
                    reqsol3 = $(this).find('span:nth-child(9)').text();
                    $('input[name=req_id]').val(reqid);
                    $('select[name=req_cli]').val(reqcli);
                    $('input[name=req_ide]').val(reqide);
                    $('input[name=req_user]').val(requser);
                    $('input[name=req_cont]').val(('0000'+reqcon).slice(-4));
                    $('textarea[name=req_sol1]').val(reqsol1);
                    $('textarea[name=req_sol2]').val(reqsol2);
                    $('textarea[name=req_sol3]').val(reqsol3);
					$('#newEdit-modal').modal();
				}
			})
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
			text: '¡registro existente!',
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
				title: '¡eliminación con exito!',
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
    @if(session('Correct') == 'SendRequest')
	<script>
        const message =Swal.mixin({
            timer: 5000,
            timerProgressBar: true,
            showConfirmButton: false,
            allowOutsideClick: false,
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
		message.fire({
			icon: 'info',
			title: '<h4>¡Respuesta enviada!</h4>',
            html: '<p class="text-info">Respuesta enviada al correo del cliente<br>registro ahora sera encontrado en:<br> <em>Soporte >> Seguimiento</em></p>'
		})
	</script>
	@endif
@endsection
