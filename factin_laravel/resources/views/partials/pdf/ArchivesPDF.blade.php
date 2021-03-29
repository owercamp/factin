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
        .text-capitalize {
            text-transform: capitalize !important;
        }
        .col-md-6{
            margin: 3% 5%;
        }
        .pdf-footer{
            border-top-color: rgba(0,123,255,.5);
            border-top-style: groove;
            border-top-width: 1.5px;
            height: 5%;
            padding-top: 15px;
            text-align: center;
        }
        .text{
            color:#0050a7;
        }
        .border{border-bottom: black solid 1px; text-align: center;}
        .center{text-align: center;}
    </style>
    <title>Contrato</title>
</head>
<body>
    <header class="pdf-header"><img class="ima" src="{{asset('img/logofactin.png')}}" alt="img-factin">
    <div class="one"></div><div class="two"></div><div class="three"></div></header>
    <section class="col-md-6" style="font-size: 1.2rem">
        <table width="100%" style="padding-bottom: 2%;">
            <tbody>
                <tr>
                    <td class="center">Cliente:</td>
                    <td class="border">{{$alls[0]['bt_social']}}</td>
                    <td class="center">N° Identificación</td>
                    <td class="border">{{$alls[0]['foll_ide']}}</td>
                </tr>
                <tr>
                    <td class="center">Usuario:</td>
                    <td class="border">{{$alls[0]['foll_user']}}</td>
                    <td class="center">Contrato:</td>
                    <td class="border">{{sprintf("%'.04d\n",$alls[0]['fol_con'])}}</td>
                </tr>
                <tr>
                    <td class="center">Colaborador:</td>
                    <td class="border">{{$alls[0]['col_name']}}</td>
                    <td class="center">Calificación</td>
                    @if ($alls[0]['ur_cali'] == "EXCELENTE")
                        <td class="border" style="color: #28a745">{{$alls[0]['ur_cali']}}</td>
                    @elseif($alls[0]['ur_cali'] == "BUENO")
                        <td class="border" style="color: #17a2b8">{{$alls[0]['ur_cali']}}</td>
                    @elseif($alls[0]['ur_cali'] == "REGULAR")
                        <td class="border" style="color: #ffc107">{{$alls[0]['ur_cali']}}</td>
                    @elseif($alls[0]['ur_cali'] == "MALO")
                        <td class="border" style="color: #BD0006">{{$alls[0]['ur_cali']}}</td>
                    @endif
                </tr>
            </tbody>
        </table>
        <table width="100%" style="border: 1.5px solid gray">
            <tbody>
                <tr>
                    <td style="width: 33.3%; border: 1.5px solid gray" class="center">Solicitud N° 1</td>
                    <td style="width: 33.3%; border: 1.5px solid gray" class="center">Solicitud N° 2</td>
                    <td style="width: 33.3%; border: 1.5px solid gray" class="center">Solicitud N° 3</td>
                </tr>
                <tr>
                    <td style="width: 33.3%; vertical-align: top; border: gray solid 1px; height: 20%;">{{$alls[0]['foll_sol1']}}</td>
                    <td style="width: 33.3%; vertical-align: top; border: gray solid 1px; height: 20%;">{{$alls[0]['foll_sol2']}}</td>
                    <td style="width: 33.3%; vertical-align: top; border: gray solid 1px; height: 20%;">{{$alls[0]['foll_sol3']}}</td>
                </tr>
            </tbody>
        </table>
        <div class="center" style="padding: 2% 0%; color:#0050a7"><b>BITACORAS</b></div>
        <table width="100%" style="border: 1.5px solid gray">
            <thead>
                <tr>
                    <td class="center" style="border: 1.5px solid gray">Fecha</td>
                    <td class="center" style="border: 1.5px solid gray">Observaciones</td>
                </tr>
            </thead>
            @foreach ($teken as $item)
                <tr>
                    @php
                        $date = new DateTime($item->tkreq_date);
                        $day = $date->format('d');
                        $year = $date->format('Y');
                        $month = $date->format('m');
                        $dayl = $date->format('N');
                        switch ($month) {
                            case '01': $mon = "enero"; break; case '02': $mon = "febrero"; break; case '03': $mon = "marzo"; break; case '04': $mon = "abril"; break; case '05': $mon = "mayo"; break; case '06': $mon = "junio"; break; case '07': $mon = "julio"; break; case '08': $mon = "agosto"; break; case '09': $mon = "septiembre"; break; case '10': $mon = "octubre"; break; case '11': $mon = "noviembre"; break; case '12': $mon = "diciembre"; break;
                        }
                        switch ($dayl) {
                            case 7: $dayv = 'Domingo'; break; case 1: $dayv = 'Lunes'; break; case 2: $dayv = 'Martes'; break; case 3: $dayv = 'Miercoles'; break; case 4: $dayv = 'Jueves'; break; case 5: $dayv = 'Viernes'; break; case 6: $dayv = 'Sabado'; break;
                        }
                        $db_date = $dayv.', '.$day.'-'.$mon.'-'.$year;
                    @endphp
                    <td class="center" style="border: 1.5px solid gray">{{$db_date}}</td>
                    <td style="border: 1.5px solid gray; text-overflow: clip;" width="120">{{$item->tkreq_obs}}</td>
                </tr>
            @endforeach
        </table>
        <div style="padding: 2% 0%; color:#0050a7"><b>Observación Cliente</b></div>
        <div style="border:1.5px solid gray; height: 20%;">{{$alls[0]['ur_obs']}}</div>
    </section>
    <footer class="pdf-footer">
        <strong class="text">Factin Online Service versión 21.01.01  |  <em>Copyright © Javapri</em></strong>
    </footer>
</body>
</html>
