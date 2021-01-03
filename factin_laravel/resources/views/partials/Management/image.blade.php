
@extends('modules.settingCompanyinfo')

@section('info')
    <div>
        <div class="row border-bottom">
            <div class="col-md-4">
                <h6 class="navbar-brand">IMAGEN CORPORATIVA</h6>
            </div>
            <div class="col-md-6">
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
        @if ($urls->isNotEmpty())
        <div class="row container-fluid my-2 margin-auto ">
            <div class="column border-personalice padding-config">
                <label class="text-muted text-center">Codigo QR</label>
                <div>
                    @foreach ($urls as $item)
                    {!! QrCode::size(300)->color(0,93,175)->generate($item->ico_qr); !!}
                    @endforeach
                </div>
                <div class="row my-3" style="margin: 22%">
                    <a href="#" class="btn btn-edit editIconqr_link">EDITAR CODIGO QR
                        <span hidden>{{$item->ico_id}}</span>
                        <span hidden>{{$item->ico_qr}}</span>
                    </a>
                </div>
            </div>
            <div class="padding-config">
                <label class="text-muted text-center">Logo Corporativo</label>
                <div>
                    @foreach ($urls as $item)    
                    <img src="public_images/images/{{$item->ico_name}}" height="300px" width="300px" alt="{{$item->ico_name}}">
                    @endforeach
                </div>
                <div class="row my-3" style="margin: 22%">
                    <a href="#" class="btn btn-edit editLogo_link">EDITAR LOGO CORPORATIVO
                        <span hidden>{{$item->ico_id}}</span>
                        <span hidden>{{$item->ico_name}}</span>
                    </a>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-left:-93px">
            <a href="#" class="btn btn-delete deleteIcon-link">ELIMINAR
                <span hidden>{{$item->ico_id}}</span>
                <span hidden>{{$item->ico_qr}}</span>
                <span hidden>{{$item->ico_name}}</span>
            </a>
        </div>
        @else
            <div class="row">
                <div class="col-md-12 text-center my-5">
                    <h6> NO EXISTE CODIGO-QR Y LOGO ASOCIADO</h6>
                    <br>
                    <button type="button" title="Logos Corporativos" class="btn-delete my-4 form-control-sm newIcon-link"><span class="icon-cloud-upload"></span> <b>AÑADIR IMAGENES</b></button>
                </div>
            </div>
        @endif
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

    {{-- formulario creacion --}}
    <div class="modal fade" id="newIcon-modal">
        <div class="modal-dialog modal-md" style="font-size: 12px;">
            <div class="modal-content">
                <div class="modal-header text-center my-3">
                    <h4 class="margin-auto">CODIGO-QR Y LOGO CORPORATIVO</h4>
                </div>
                <div class="modal-body">
                    <form class="form-group" action="{{route('image.save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row flex-justified">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <small>INFORMACION DEL CODIGO QR</small>
                                            <input type="url" name="url" class="form-control form-control-sm" placeholder="Codigo-QR" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <small>IMAGEN CORPORATIVA</small>
                                            <input type="file" name="avatar" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <div class="form-group text-center border-top">
                                <button type="submit" class="btn-success my-3"><b>GUARDAR</b></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- formulario edicion información codigo qr --}}
    <div class="modal fade" id="ediIconqr-modal">
        <div class="modal-dialog modal-md" style="font-size: 15px">
            <div class="modal-content">
                <div class="modal-header text-center my-3">
                    <h4 class="margin-auto">CODIGO QR</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('image.update.code')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row flex-justified">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <small>INFORMACION DEL CODIGO QR</small>
                                            <input type="url" name="url_Edit" class="form-control form-control-sm" placeholder="Codigo-QR" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top mt-3 text-center">
                            <div class="col-md-6">
                                <input type="hidden" class="form-control form-control-sm" name="icon_id_Edit" readonly required>
                                <button type="submit" class="btn btn-edit form-control-sm my-3">GUARDAR CAMBIOS</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-delete form-control-sm my-3">CANCELAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- formulario edicion Logo --}}
    <div class="modal fade" id="editLogo-modal">
        <div class="modal-dialog modal-md" style="font-size: 15px">
            <div class="modal-content">
                <div class="modal-header text-center my-3">
                    <h4 class="margin-auto">LOGO CORPORATIVO</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('image.update.image')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row flex-justified">
                                    <div class="col-md-8">
                                        <div class="form-group" style="margin: 2% 30%">
                                            <small class="text-center">LOGO ACTUAL</small>
                                            <div>
                                                @foreach ($urls as $item)    
                                                <img src="public_images/images/{{$item->ico_name}}" height="100px" width="100px" alt="{{$item->ico_name}}">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <select id="LogoNumber" name="Logo_name" class="form-control form-control-sm" required>
												<option value="">Seleccione un logo</option>
												@foreach ($Logos as $item)
												<option value="{{$item->icon_name}}">{{$item->icon_name}}</option>
                                                @endforeach                                                
											</select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top mt-3 text-center">
                            <div class="col-md-6">
                                <input type="hidden" class="form-control form-control-sm" name="icon_id_Edit" readonly required>
                                <button type="submit" class="btn btn-edit form-control-sm my-3">GUARDAR CAMBIOS</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-delete form-control-sm my-3">CANCELAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- formulario de eliminación --}}
    <div class="modal fade" id="deleteform-modal">
        <div class="modal-dialog" style="font-size: 18px">
            <div class="modal-content">
                <div class="modal-header text-center my-3">
                    <h6 class="margin-auto">ELIMINACION DE QR Y LOGO</h6>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <small class="text-muted">INFORMACION CODIGO-QR</small><br>
                            <span class="text-muted"><b class="code_Delete"></b></span><br>
                            <small class="text-muted">NOMBRE DEL LOGO</small><br>
							<span class="text-muted"><b class="logo_Delete"></b></span><br>
                        </div>
                    </div>
                    <div class="row mt-3 border-top text-center">
                        <form action="{{route('image.delete')}}" method="POST" class="col-md-6 DeleteSend">
                            @csrf
                            <input type="hidden" class="form-control form-control-sm" name="ico_id_Delete" readonly required>
                            <button type="submit" class="btn btn-edit form-control-sm my-3">ELIMINAR</button>
                        </form>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-delete mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('ScriptZone')
    <script>
        $('.newIcon-link').on('click',function(){
            $('#newIcon-modal').modal();
        })
        // edita el codigo qr
        $('.editIconqr_link').on('click',function(e){
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
                    var codeqr, icoid;
                    codeqr = $(this).find('span:nth-child(2)').text();
                    codeid = $(this).find('span:nth-child(1)').text();
                    $('input[name=url_Edit]').val(codeqr);
                    $('input[name=icon_id_Edit]').val(codeid);
					$('#ediIconqr-modal').modal();
                    }
                })			
        });
        // edita el logo
        $('.editLogo_link').on('click',function(e){
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
                    var icoid;
                    codeid = $(this).find('span:nth-child(1)').text();
                    $('input[name=icon_id_Edit]').val(codeid);
					$('#editLogo-modal').modal();
                    }
                })			
        });
        //eliminación Qr y Logo
        $('.deleteIcon-link').on('click',function(e){
			e.preventDefault();
            var code,logo,id;
            id = $(this).find('span:nth-child(1)').text();
            code = $(this).find('span:nth-child(2)').text();
            logo = $(this).find('span:nth-child(3)').text();
            $('input[name=ico_id_Delete]').val(id);
            $('.code_Delete').text(code);
            $('.logo_Delete').text(logo);
			$('#deleteform-modal').modal();
        });

        // envio del formulario de eliminación
		$('.DeleteSend').submit('click', function(e){
			e.preventDefault();
			Swal.fire({
				title: '¡¡Eliminación!!',
				text: "Desea continuar con la eliminación",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#f58f4d',
				confirmButtonText: 'Si, Eliminar',
				cancelButtonText: 'No',
				showClass: {
				popup: 'animate__animated animate__flipInX'
				},
				hideClass: {
				popup: 'animate__animated animate__flipOutX'
				},
			}).then((result) => {
				if (result.isConfirmed) {
					this.submit();
				}
			})
		})
        
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
			text: '¡Información corporativa no encontrada!',
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
				text: 'Información corporativa no encontrado',
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
				title: '¡eliminado con exito!',
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
@endsection