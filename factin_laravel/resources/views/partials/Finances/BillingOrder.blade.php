
@extends('modules.settingFinance')

@section('info')
    <table id="tableDatatable" class="w-100 table table-hover table-bordered text-center top-modal">
        <thead>
            <tr>
                <th>#</th>
                <th>VENTAS DEL MES</th>
                <th>AÑO</th>
                <th>MES</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @php
                $row = 1;
            @endphp
            @foreach ($billingOrder as $item)
                <tr>
                    <th>{{$row++}}</th>
                    <th class="version-color">{{number_format($item->bo_sale_month,0,',','.')}}</th>
                    <th>{{$item->bo_year}}</th>
                    <th>{{$item->bo_month}}</th>
                    <th><a href="#" title="Imprimir" class="btn-edit form-control-sm Imprimir-PDF">
                        <span class="icon-arrow-circle-down"></span>
                        <span hidden>{{$item->bo_id}}</span>
                    </a></th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="invisible">
        <form action="{{route('billing.order')}}" method="post" class="pdforder">
        @csrf
            <input type="text" name="OrderPrinter">
        </form>
    </div>
@endsection

@section('ScriptZone')
    <script>
        // envio lo que deseo imprimir
        $('.Imprimir-PDF').click(function (e) { 
            e.preventDefault();
            var printer;
            printer = $(this).find('span:nth-child(2)').text();
            $('input[name=OrderPrinter]').val(printer);
            $('.pdforder').submit();
        });
    </script>
@endsection