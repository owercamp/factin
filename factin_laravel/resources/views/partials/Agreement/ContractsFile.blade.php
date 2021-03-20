

@extends('modules.settingAgreement')

@section('info')
    <div>
        <div class="row border-bottom">
            <div class="col-md-8">
                <h6 class="navbar-brand">ARCHIVO CONTRATACIONES</h6>
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
                    <th>CONTRATO</th>
                    <th>RAZON SOCIAL</th>
                    <th>DOCUMENTO</th>
                    <th>VALOR CONTRATO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $row=1;
                @endphp
                @foreach ($contract as $item)
                    @if ($item->con_final < date("Y-m-d"))
                        <tr>
                            <td>{{$row++}}</td>
                            <td>{{sprintf("%'.04d\n",$item->conNumber)}}</td>
                            <td>{{$item->bt_social}}</td>
                            <td>{{$item->con_typeiderepre}}</td>
                            <td><b class="expiration-color">{{number_format($item->con_price,0,',','.')}}</b></td>
                            <td>
                                <a href="#" title="Imprimir" class="btn-edit form-control-sm Imprimir-PDF">
                                    <span class="icon-arrow-circle-down"></span>
                                    <span hidden>{{$item->con_id}}</span>
                                </a>
                            </td>
                        </tr>
                    @endif
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

    <form action="{{route('contract.fail')}}" method="post" class="invisible fail">
        @csrf
        <input type="text" name="id_fail">
    </form>
@endsection

@section('ScriptZone')
	<script>
		$('.Imprimir-PDF').click(function () {
            let id = $(this).find('span:nth-child(2)').text();
            $('input[name=id_fail]').val(id);
            $('.fail').submit();
        });
	</script>
@endsection
