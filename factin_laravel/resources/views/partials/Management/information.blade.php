
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
