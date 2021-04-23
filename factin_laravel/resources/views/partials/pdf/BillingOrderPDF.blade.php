<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="Icon" href="{{asset('img/logofactin.png')}}">
    <style>
        header{
            display: block;
            height: 15%;
            width: 100%;
            background: rgba(0,123,255,0.4);
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
        }
        section{
            height: 72%;
        }
        .ima{
            float: left;
            margin-top: 17px;
            margin-left: 12px;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
        }
        .one {
            width: 120px; height: 120px; background: rgba(255,255,255,0.2); border-radius: 320%; -webkit-border-radius: 320%; -moz-border-radius: 320%; -ms-border-radius: 320%; -o-border-radius: 320%; position: relative; margin-left: 33%; margin-top: -5%;
        }
        .two {
            width: 150px; height: 150px; background:  rgba(255,255,255,0.3); border-radius: 500%; -webkit-border-radius: 500%; -moz-border-radius: 500%; -ms-border-radius: 500%; -o-border-radius: 500%; position: relative; margin-left: 90%; margin-top: -15%;
        }
        .three {
            width: 210px; height: 210px; background: rgba(255,255,255,0.4); border-radius: 620%; -webkit-border-radius: 620%; -moz-border-radius: 620%; -ms-border-radius: 620%; -o-border-radius: 620%; position: relative; margin-left: 55%; margin-top: -10%;
        }
        .pdf-footer{
            border-top-color: rgba(0,123,255,.5);
            border-top-style: groove;
            border-top-width: 1.5px;
            height: 20px !important;
            text-align: center;
        }
        .text{
            float: left;
            margin-top: 20px;
            margin-left: 21%;
            color:#0050a7;
        }
        .container{            
            padding: 1px;            
            width: 690px !important;
            margin: 1.5px;
            height: 830px !important;
        }
        .w-100{
            width: 100% !important;
        }
        .border th{
            border: 1px solid #dee2e6 !important;
        }
        .border-secondary th{
            border-color: #6c757d !important;
        }
        .m-1 {
            margin: 0.25rem !important;
        }
        .text-primary {
            color: #0050a7 !important;
        }
        .text-dark {
            color: #343a40 !important;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
    </style>
    <title>Contrato</title>
</head>
<body height="100%">
    <header class="pdf-header"><img class="ima" src="{{asset('img/logofactin.png')}}" alt="img-factin">
    <div class="one"></div><div class="two"></div><div class="three"></div></header>
    <div class="container">
        <h3 class="w-100 text-center text-dark">{{$month}} - {{$year}}</h3>
        <table class="w-100 border border-secondary m-1">
            <thead>
                <tr>
                    <th>N° CONTRATO</th>
                    <th>IDENTIFICACION</th>
                    <th>RAZON SOCIAL</th>
                    <th>COLABORADOR</th>
                    <th>VALOR CUOTA</th>
                </tr>
            </thead>
            <tbody style="height: 1150px">
                @foreach ($JsonData as $item)
                <tr>
                    <th>{{sprintf("%'.04d\n",$item->conNumber)}}</th>
                    <th>{{$item->con_typeiderepre}}</th>
                    <th>{{$item->bt_social}}</th>
                    <th>{{$item->col_name}}</th>
                    <th class="text-dark">{{number_format($item->con_valueqouta,0,',','.')}}</th>
                </tr>                    
                @endforeach 
            </tbody>
            <tfoot>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-dark">{{__('TOTAL FACTURADO: ')}}</td>
                <td class="text-center text-primary"><strong>{{number_format($sale_month,0,',','.')}}</strong></td>
            </tfoot>
        </table>
    </div>
    <footer class="pdf-footer">
        <strong class="text">Factin Online Service versión 21.01.01  |  <em>Copyright © Javapri</em></strong>
    </footer>
</body>
</html>