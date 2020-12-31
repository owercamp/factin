
@extends('modules.settingCompanyinfo')

@section('info')
    <div>
        <div class="row border-bottom">
            <div class="col-md-4">
                <h6 class="navbar-brand">INFORMACION CORPORATIVA</h6>
            </div>
            <div class="col-md-6">
				@if(session('SuccessLegal'))
					<div class="alert alert-success">
						{{ session('SuccessLegal') }}
					</div>
				@endif
				@if(session('PrimaryLegal'))
					<div class="alert alert-primary">
						{{ session('PrimaryLegal') }}
					</div>
				@endif
				@if(session('WarningLegal'))
					<div class="alert alert-warning">
						{{ session('WarningLegal') }}
					</div>
				@endif
				@if(session('SecondaryLegal'))
					<div class="alert alert-secondary">
						{{ session('SecondaryLegal') }}
					</div>
				@endif
			</div>
        </div>
        @if (isset($company))
		<div class="container-fluid my-3">
			<div class="row text-warning">
				<div class="col-md-6">
					<small class="text-muted">RAZON SOCIAL: </small><br>
					<span class="text-muted blockquote text-uppercase">
						<b class="text-info">
							{{ $company->comsocial }}
						</b>
					</span><br>
					<small class="text-muted">DEPARTAMENTO - MUNICIPIO: </small><br>
					<span class="text-muted blockquote text-uppercase">
						<b>
							{{$company->departament->depname}}
						</b>
						<b>{{' - '}}</b>
						<b>
							{{$company->municipality->munname}}
						</b>
					</span><br>
					<small class="text-muted">EMAIL:</small><br>
					<span class="text-muted blockquote text-uppercase">
						<b>
							{{$company->comemail}}
						</b>
					</span><br>
					<div class="row my-5">
						<a href="#" class="btn btn-delete"><span class="icon-trash"></span> ELIMINACION DE INFORMACION</a>
						<span hidden>{{$company->comid}}</span>
						<span hidden>{{$company->comsocial}}</span>
					</div>
				</div>
				<div class="col-md-6">
					<small class="text-muted">NIT: </small><br>
					<span class="text-muted blockquote text-uppercase">
						<b class="text-primary">
							{{ $company->comnit }}
						</b>
					</span><br>
					<small class="text-muted">DIRECCION: </small><br>
					<span class="text-muted blockquote text-uppercase">
						<b>
							{{ $company->comaddress }}
						</b>
					</span><br>
					<small class="text-muted">TELEFONOS: </small><br>
					<span class="text-muted blockquote text-uppercase">
						<b>
							{{$company->comphone1}}
						</b>
						<b>{{' - '}}</b>
						<b>
							{{$company->comphone2}}
						</b>
					</span><br>
					<div class="row my-5">
						<a href="#" class="btn btn-edit"><span class="icon-pencil"></span> MODIFICACION DE LA INFORMACION</a>
						<span hidden>{{$company->comid}}</span>
						<span hidden>{{$company->comsocial}}</span>
						<span hidden>{{$company->comnit}}</span>
						<span hidden>{{$company->comdepid}}</span>
						<span hidden>{{$company->communid}}</span>
						<span hidden>{{$company->comaddress}}</span>
						<span hidden>{{$company->comphone1}}</span>
						<span hidden>{{$company->comphone2}}</span>
						<span hidden>{{$company->comemail}}</span>
					</div>
				</div>			
			</div>
		</div>
        @else
            <div class="row">
				<div class="col-md-12 text-center">
					<h6>NO EXISTE INFORMACION CORPORATIVA</h6>
					<br>
					<button type="button" title="Registrar Información Corporativa" class="btn-edit form-control-sm newLegal-link"><b>GUARDAR INFORMACION</b></button>
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
@endsection
