
@extends('modules.settingProducttype')

@section('info')
    <div>
		<div class="row border-bottom">
			<div class="col-md-4">
				<h6 class="navbar-brand">CONFIGURACION DE PRODUCTOS</h6>
			</div>
			<div  class="col-md-4 text-center">
				<button type="button" title="Registrar" class="btn-success form-control-sm newConfigProduct-link"><b>Nuevo</b></button>
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
                    <th>VERSION</th>
                    <th>TIPO DE PRODUCTO</th>
                    <th>MODULOS</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @php $row = 1; @endphp
                @foreach ($configuration as $config)
                    <tr>
                        <td>{{$row++}}</td>
                        <td>{{$config->pc_version}}</td>
                        <td>{{$config->typepro->pro_name}}</td>
                        <td>
                            @if (strlen($config->pc_content)> 50)
                                {{substr($config->pc_content,0,50).'..'}}
                            @else
                                {{$config->pc_content}}
                            @endif
                        </td>
                        <td>
                            <a href="#" title="Editar" class=" btn-edit form-control-sm editCreation-link">
                                <span class="icon-magic"></span>
                                <span hidden>{{ $config->pc_id }}</span>
                                <span hidden>{{ $config->pc_version }}</span>
                                <span hidden>{{ $config->pc_typepro}}</span>
                                <span hidden>{{ $config->pc_content}}</span>
                            </a>
                            <a href="#" title="Eliminar" class="btn-delete form-control-sm deleteCreation-link">
                                <span class="icon-proxmox"></span>
                                <span hidden>{{ $config->pc_id }}</span>
                                <span hidden>{{ $config->pc_version }}</span>
                                <span hidden>{{ $config->pc_typepro}}</span>
                                <span hidden>{{ $config->pc_content}}</span>
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
	<div class="modal fade" id="newCreationConfig-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>NUEVO CONFIGURACION PRODUCTO</h6>
				</div>
				<div class="modal-body">
					<form action="{{route('config.save')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12 container-lg">
								<div class="row justify-content-center">
									<div class="col-md-10">
										<div class="form-group">
                                            <small class="text-muted">VERSION:</small>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="ver_one" maxlength="4" pattern="[A-Za-z0-9]{1,4}" placeholder="Código 1" style="text-transform: uppercase" class="form-control form-control-sm text-center" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="ver_two" maxlength="4" pattern="[A-Za-z0-9]{1,4}" placeholder="Código 2" style="text-transform: uppercase" class="form-control form-control-sm text-center" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="ver_three" maxlength="4" pattern="[A-Za-z0-9]{1,4}" placeholder="Código 3" style="text-transform: uppercase" class="form-control form-control-sm text-center" required>
                                                    </div>
                                                </div>
                                            </div>											
                                            <div class="form-group">
                                                <small class="text-muted">TIPO DE PRODUCTO</small>
                                                <select class="form-control form-control-sm" name="TipoPro" required>
                                                    <option value="">Seleccione un Tipo de Producto</option>
                                                    @foreach ($product as $products)
                                                        <option value="{{$products->pro_id}}">{{$products->pro_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <small class="text-muted">MODULO</small>
                                                        <select name="Modules" class="form-control form-control-sm" required>
                                                            <option value="">Selección Modulo</option>
                                                            @foreach ($module as $mod)
                                                                <option value="{{$mod->mod_name}}">{{$mod->mod_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div style="padding-top: 4.3%">
                                                    <a href="#" class="btn btn-edit form-control-sm addModule" title="Agregar Modulo"><span class="icon-braille"></span></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <small class="text-muted">MODULOS AGREGADOS</small>
                                                        <textarea name="Contenido" id="Content" cols="30" rows="10" hidden></textarea>
                                                            <ol id="formlist"  style="margin-left: -5%">
                                                                <div id="cdContent"></div>
                                                            </ol>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<button type="submit" class="btn-success form-control-sm btn-saveDefinitive btnSubmit"><b>GUARDAR</b></button>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>

    {{-- creación de mi formulario de edicion --}}
	<div class="modal fade" id="newEditConfig-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header text-justify">
					<h6>MODIFICACION CONFIGURACION PRODUCTO</h6>
				</div>
				<div class="modal-body">
					<form action="{{route('config.update')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12 container-lg">
								<div class="row justify-content-center">
									<div class="col-md-10">
										<div class="form-group">
                                            <small class="text-muted">VERSION:</small>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="ver_one_Edit" maxlength="4" pattern="[A-Za-z0-9]{1,4}" placeholder="Código 1" style="text-transform: uppercase" class="form-control form-control-sm text-center" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="ver_two_Edit" maxlength="4" pattern="[A-Za-z0-9]{1,4}" placeholder="Código 2" style="text-transform: uppercase" class="form-control form-control-sm text-center" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="ver_three_Edit" maxlength="4" pattern="[A-Za-z0-9]{1,4}" placeholder="Código 3" style="text-transform: uppercase" class="form-control form-control-sm text-center" required>
                                                    </div>
                                                </div>
                                            </div>											
                                            <div class="form-group">
                                                <small class="text-muted">TIPO DE PRODUCTO</small>
                                                <select name="TipoPro_Edit" class="form-control form-control-sm" required>
                                                    <option value="">Tipo de Producto</option>
                                                    @foreach ($product as $item)
                                                        <option value="{{$item->pro_id}}">{{$item->pro_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <small class="text-muted">MODULO</small>
                                                        <select name="Modules_Edit" class="form-control form-control-sm" required>
                                                            <option value="">Selección Modulo</option>
                                                            @foreach ($module as $mod)
                                                                <option value="{{$mod->mod_name}}">{{$mod->mod_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div style="padding-top: 4.3%">
                                                    <a href="#" class="btn btn-edit form-control-sm addModule_Edit" title="Agregar Modulo"><span class="icon-braille"></span></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div>
                                                            <small class="text-muted">MODULOS EXISTENTES</small>
                                                            <textarea name="Contenido_Edit" cols="30" rows="2" class="form-control form-control-sm"></textarea>
                                                        </div>
                                                        <div class="my-2">
                                                            <small class="text-muted">MODULOS AGREGADOS</small>
                                                            <textarea name="NewContent" cols="30" rows="5" class="form-control form-control-sm ContenidoNuevo" hidden></textarea>
                                                            <ol id="formlist"  style="margin-left: -5%">
                                                                <div id="cdContentNuevo"></div>
                                                            </ol>
                                                        </div>                                                        
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="pc_id_Edit" readonly required>
								<button type="submit" class="btn btn-edit form-control-sm my-3">GUARDAR CAMBIOS</button>
							</div>
							<div class="col-md-6">
								<button type="button" class="btn btn-delete mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>

    {{-- formulario de eliminación --}}
	<div class="modal fade" id="newDeletetConfig-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE CONFIGURACION:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">VERSION</small><br>
							<span class="text-muted"><b class="pc_version_Delete"></b></span><br>							
                        </div>
                        <div class="col-md-12 text-center">
							<small class="text-muted">CONTENIDO</small><br>
							<span class="text-muted"><b class="pc_content_Delete"></b></span><br>							
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{route('config.delete')}}" method="POST" class="col-md-6 DeleteSend">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="pc_id_Delete" readonly required>
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
		// Llama al formulario modal de creación
		$('.newConfigProduct-link').on('click',function(){
			$('#newCreationConfig-modal').modal();
        });

        $('.addModule').click(function (e) { 
            e.preventDefault();
            var writed = $('select[name=Modules]').val();
            if (writed != '') {
                $('#cdContent').before("<li>"+writed+"</li>");
                $('#Content').append(writed+", ");
            }
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
                    var codigo = $(this).find('span:nth-child(3)').text();
                    var type = $(this).find('span:nth-child(4)').text();
                    var contenido = $(this).find('span:nth-child(5)').text();
                    var ident = $(this).find('span:nth-child(2)').text();
                    var separa = codigo.split('-');
                    $('input[name=ver_one_Edit]').val(separa[0]);
                    $('input[name=ver_two_Edit]').val(separa[1]);
                    $('input[name=ver_three_Edit]').val(separa[2]);
                    $('select[name=TipoPro_Edit]').val(type);
                    $('textarea[name=Contenido_Edit]').val(contenido);
                    $('input[name=pc_id_Edit]').val(ident);
					$('#newEditConfig-modal').modal();
				}
			})			
        });

        $('.addModule_Edit').click(function (e) { 
            e.preventDefault();
            var edit = $('select[name=Modules_Edit]').val();
            if (edit != '') {
                $('#cdContentNuevo').before("<li>"+edit+"</li>");
                $('.ContenidoNuevo').append(edit+", ");
            }
        });

        // Lanza el formulario de eliminación
		$('.deleteCreation-link').on('click',function(e){
			e.preventDefault();
			var pc_id = $(this).find('span:nth-child(2)').text();
			var pc_type = $(this).find('span:nth-child(3)').text();
			var pc_content = $(this).find('span:nth-child(5)').text();
			$('input[name=pc_id_Delete]').val(pc_id);
			$('b.pc_version_Delete').text(pc_type);
			// var contentFinal = showContent(cdmContent);
			$('b.pc_content_Delete').html(pc_content);
			$('#newDeletetConfig-modal').modal();
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
				text: 'configuración no encontrado',
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