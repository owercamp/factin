
@extends('modules.settingCompanyinfo')

@section('info')
    <div>
        <div class="row border-bottom">
            <div class="col-md-4">
                <h6 class="navbar-brand">IMAGEN CORPORATIVA</h6>
            </div>
        </div>
        @if (isset($urls))
        <div class="row container-fluid my-2 margin-auto ">
            <div class="column border-personalice padding-config">
                <label class="text-muted">Codigo QR</label>
                <div>
                    @foreach ($urls as $item)
                    {!! QrCode::size(300)->color(0,93,175)->generate($item->ico_qr); !!}
                    @endforeach
                </div>                
            </div>
            <div class="padding-config">
                <label class="text-muted">Logo Corporativo</label>
                <div>
                    @foreach ($urls as $item)    
                    <img src="images/{{$item->ico_name}}" height="300px" width="300px" alt="">
                    @endforeach
                </div>
            </div>
        </div>
        @else
            {{-- <input type="file" name="icon" id=""> --}}
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
@endsection