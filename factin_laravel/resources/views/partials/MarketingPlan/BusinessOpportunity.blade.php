
@extends('modules.settingMarketing')

@section('info')
	<div>
		<div class="row border-bottom">			
		</div>
		<div class="card">
            <div class="card-header text-center">
                <h5 class="text-primary" style="margin-top: 5px"><em><b>REGISTRO OPORTUNIDAD DE NEGOCIO</b></em></h5>
            </div>
            <form action="{{route('oportunity.new')}}" method="POST">
                @csrf
                <div class="card-body p-4 border">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <small class="text-muted">FECHA:</small>
                                        <input type="text" name="OpDate" class="form-control form-control-sm datepicker" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <small class="text-muted">RAZON SOCIAL:</small>
                                        <input type="text" name="OpSocial" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">DEPARTAMENTO:</small>
                                        <select name="OpDep" id="DepName" class="form-control form-control-sm" required>
                                            <option value="">Seleccione un Departamento</option>
                                            @foreach ($departament as $item)
                                                <option value="{{ $item->depid}}">{{$item->depname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">MUNICIPIO:</small>
                                        <select name="OpMun" id="MunName" class="form-control form-control-sm" required>
                                            {{-- api de busqueda que carga los municipios segun departamento en ScriptZone ↓ --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <small class="text-muted">DIRECCION:</small>
                                        <input type="text" name="OpDir" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">CONTACTO:</small>
                                        <input type="text" name="OpCon" maxlength="100" style="text-transform: uppercase" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <small class="text-muted">TELEFONO:</small>
                                        <input type="text" name="OpTel" maxlength="10" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">WHATSAPP:</small>
                                        <input type="text" name="OpWhat" maxlength="10" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <small class="text-muted">CORREO ELECTRONICO</small>
                                        <input type="email" name="OpEma" maxlength="100" placeholder="example@correo.com.co" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-edit" style="margin: 5% 35%">ALMACENAR</button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <small class="text-muted">OBSERVACIONES:</small>
                                        <textarea name="OpObs" cols="30" rows="10" maxlength="1000" class="form-control form-control-sm">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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

@section('ScriptZone')
    <script>
        $('#DepName').change(function (e) { 
            var departament = e.target.value;
            $('#MunName').empty();
            $('#MunName').append("<option value=''>Seleccione un Municipio</option>");
            if (departament != '') {
                $.get("{{route('getMunicipalities')}}",{DepId: departament},function(objectMunicipality){
					for(var i=0; i<objectMunicipality.length;i++){
						$('#MunName').append("<option value='"+objectMunicipality[i]['munid']+"'>"+objectMunicipality[i]['munname']+"</option>");
					}
				})
            }
        });


    </script>
    @if(session('SuccessCreation') == 'Almacenado')
	<script>
        Swal.fire({
            icon: 'success',
            title: 'registro exitoso',
            text: '¿Desea ver los registros en la tabla seguimiento del negocio?',
            showDenyButton: true,
            showCancelButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#f58f4d',
            confirmButtonText: `Si`,
            denyButtonText: `No`,
            showClass: {
			popup: 'animate__animated animate__flipInX'
			},
			hideClass: {
			popup: 'animate__animated animate__flipOutX'
			}
        }).then((result) => {  
        if (result.isConfirmed) {
            location.href = ('https://factin-online.com/factin/Business-Tracking');
        } else if (result.isDenied) {
        }
        });
	</script>
	@endif	
	@if (session('SecondCreation') == "NoEncontrado")
		<script>
			Swal.fire({
				icon: 'error',
				title: 'Oops..',
				text: 'no se pudo almacenar',
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