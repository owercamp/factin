
@extends('modules.settingFinance')

@section('info')
    <table id="tableDatatable" class="w-100 table table-hover table-bordered text-center top-modal">
        <thead>
            <tr>
                <th>VENTAS DEL MES</th>
                <th>AÑO</th>
                <th>MES</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($billingOrder as $item)
                <tr>
                    <th class="version-color">{{number_format($item->bo_sale_month,0,',','.')}}</th>
                    <th>{{$item->bo_year}}</th>
                    <th>{{$item->bo_month}}</th>
                    <th>{{__('boton PDF')}}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection