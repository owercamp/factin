
@extends('modules.settingCompanyinfo')

@section('info')
    <div>
        <div class="row border-bottom">
            <div class="col-md-4">
                <h6 class="navbar-brand">INFORMACION CORPORATIVA</h6>
            </div>
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
