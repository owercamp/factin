
@extends('modules.settingMarketing')

@section('info')
	<div>
		<div class="row border-bottom">			
			<div class="col-md-4">
				@if(session('SuccessCreation'))
				<div class="alert alert-success">
					{{ session('SuccessCreation') }}
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
                <h5 class="text-primary" style="margin-top: 5px"><em><b>REGISTRO OPORTUNIDAD DE NEGOCIO</b></em></h5>
            </div>
            <form action="" method="POST">
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
                                        <input type="text" name="OpSocial" maxlength="100" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">DEPARTAMENTO:</small>
                                        <select name="OpDep" id="" class="form-control form-control-sm" required>
                                            <option value="">Seleccione un Departamento</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">MUNICIPIO:</small>
                                        <select name="OpMun" id="" class="form-control form-control-sm" required>
                                            <option value="">Seleccione un Municipio</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <small class="text-muted">DIRECCION:</small>
                                        <input type="text" name="OpDir" maxlength="100" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <small class="text-muted">CONTACTO:</small>
                                        <input type="text" name="OpCon" maxlength="100" class="form-control form-control-sm" required>
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
                                        <input type="text" name="opWhat" maxlength="10" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <small class="text-muted">CORREO ELECTRONICO</small>
                                        <input type="email" name="OpEma" maxlength="100" class="form-control form-control-sm">
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