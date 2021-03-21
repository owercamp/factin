
@extends('home')

@section('title', 'Archivo')

@section('modules')
    <div class="container-fluid" style="margin: 0.2% 10%">
        <div class="row">
            <div class="col-md-8">
                <h6 class="navbar-brand">CALIFICACION</h6>
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
                    <th>CLIENTE</th>
                    <th>USUARIO</th>
                    <th>CALIFICACION</th>
                    <th>FECHA SOLUCION</th>
                    <th>COLABORADOR</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $row = 1;
                @endphp
                @foreach ($user_rating as $item)
                        <tr>
                            <th>{{$row++}}</th>
                            <th>{{$item->bt_social}}</th>
                            <th>{{$item->ur_user}}</th>
                            <th>{{$item->ur_cali}}</th>
                            <th>{{$item->foll_date}}</th>
                            @if ($item->foll_cola != null)
                                <th>
                                    @foreach ($collaborator as $col)
                                        @if($col->id = $item->foll_cola)
                                            {{$col->col_name}}
                                        @endif
                                    @endforeach
                                </th>
                            @else
                                <th>{{__('AUN NO ASIGNADO')}}</th>
                            @endif
                            <th>
                                <a href="#" title="Imprimir" class="btn-edit form-control-sm Imprimir-PDF">
                                    <span class="icon-arrow-circle-down"></span>
                                    <span hidden>{{$item->foll_id}}</span>
                                </a>
                            </th>
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

    <form action="{{route('archive.print')}}" method="post" class="invisible archive">
        @csrf
        <input type="text" name="archivepdf">
    </form>
@endsection

@section('ScriptZone')
	<script>
		$('.Imprimir-PDF').click(function () {
            let pdf = $(this).find('span:nth-child(2)').text();
            $('input[name=archivepdf]').val(pdf);
            $('.archive').submit();
        });
	</script>
@endsection
