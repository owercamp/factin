
@extends('home')

@section('title', 'Solicitudes')

@section('modules')
    <div class="container-fluid" style="margin: 0.2% 10%">
        <div class="row border-bottom">
			<div class="col-md-4 text-center">
			</div>
			<div  class="col-md-4 text-center">
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
        <div class="card">
            <div class="card-header text-center">
                <h5 class="text-primary"><b>SOLICITUDES</b></h5>
            </div>
            <form action="{{route('request.save')}}" method="post">
                @csrf
                <div class="card-body p4 border">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">IDENTIFICACION USUARIO</small>
                                        <input type="text" name="req_ide" class="form-control form-control-sm">{{-- debe consulta en la tabla de user_clients --}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">CLIENTE</small>
                                        <select name="req_cli" class="form-control form-control-sm">
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
                                        <input type="text" name="req_user" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">CONTRATO</small>
                                        <input type="text" name="req_cont" class="form-control form-control-sm">
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
                                        <textarea name="req_sol2" cols="30" rows="10" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <small class="text-muted">SOLICITUD 3</small>
                                        <textarea name="req_sol3" cols="30" rows="10" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" style="margin-left: calc(100% /2.5)" class="btn btn-outline-primary" >ENVIAR</button>
                                    <button type="button" style="margin-left: 2%" class="btn btn-outline-danger printer">IMPRIMIR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form action="{{route('request.print')}}" method="post" class="invisible requestprint">
        @csrf
        <input type="text" name="requestprinter">
        <textarea name="requestsol1" cols="30" rows="10"></textarea>
        <textarea name="requestsol2" cols="30" rows="10"></textarea>
        <textarea name="requestsol3" cols="30" rows="10"></textarea>
    </form>
    @endsection

    @section('ScriptZone')
	<script>
        // imprime mu solicitud
        $('.printer').click(function () {
            let print_id = $('input[name=requestprinter]').val();
            let sol1 = $('textarea[name=req_sol1]').val();
            let sol2 = $('textarea[name=req_sol2]').val();
            let sol3 = $('textarea[name=req_sol3]').val();
            $('textarea[name=requestsol1]').val(sol1);
            $('textarea[name=requestsol2]').val(sol2);
            $('textarea[name=requestsol3]').val(sol3);
            let ide = $('input[name=req_ide]').val();
            if (print_id > null) {
                $('.requestprint').submit();
            }else{
                const Message = Swal.mixin({
                    toast: true,
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    backdrop: `rgba(0,0,123,0.2)`,
                    showClass: {
                        popup: 'animate__animated animate__flipInX'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__flipOutX'
                    },
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Message.fire({
                    title: '<strong style="color: red;">Sin Consulta:</strong>',
                    html: '<em>no hay un registro para imprimir</em>'
                })
            }
        });
        // consulta al cliemte por la identificación
		$('input[name=req_ide]').change(function (e) {
            e.preventDefault();
            $('select[name=req_cli]').val("");
            $('input[name=req_user]').val("");
            $('input[name=req_cont]').val("");
            $('input[name=requestprinter]').val("");
            let ide = $('input[name=req_ide]').val();
            $.get("{{route('getUserIdentity')}}", {data: ide},
                function (objectUserIdentity) {
                    console.log(objectUserIdentity);
                    $('select[name=req_cli]').val(objectUserIdentity[0]['id']);
                    $('input[name=req_user]').val(objectUserIdentity[0]['uc_users']);
                    $('input[name=requestprinter]').val(objectUserIdentity[0]['id']);
                    let date = new Date(); let month = date.getMonth()+1; let year = date.getFullYear(); let day = date.getDate(); let monthfor = ('00'+month).slice(-2);
                    if (objectUserIdentity[0]['con_final'] < year+'-'+monthfor+'-'+day) {
                        const Alerta = Swal.mixin({
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
                        Alerta.fire({
                            icon: 'error',
                            title: '<h3 class="text-danger"><em>CONTRATO VENCIDO</em><h3>',
                            html: '<b class="text-dark text-capitalize">Por favor comuníquese con servicio al cliente<b>',
                        })
                    $('select[name=req_cli]').val("");
                    $('input[name=req_user]').val("");
                    $('input[name=req_cont]').val("");
                    $('input[name=requestprinter]').val("");
                    }else{
                        $('input[name=req_cont]').val(("0000"+objectUserIdentity[0]['conNumber']).slice(-4));
                    }
                }
            );
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
				title: '¡Eliminación con exito!',
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
