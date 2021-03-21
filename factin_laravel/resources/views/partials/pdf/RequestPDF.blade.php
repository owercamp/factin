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
            text-align: center;
        }
        .text{
            float: left;
            margin-top: 40%;
            margin-left: 21%;
            color:#0050a7;
        }
        .val{border-bottom: black solid 1px;}
        .td1{width: 43%; padding-top: 1.5%;}
        .td2{width: 57%; border-bottom: black solid 1px; padding-top: 1.5%;}
        .align{vertical-align: top;}
        .titles{text-align: right;}
        .data{text-align: center;}
        tr{margin: 1px 0px }
    </style>
    <title>Contrato</title>
</head>
<body>
    <header class="pdf-header"><img class="ima" src="{{asset('img/logofactin.png')}}" alt="img-factin">
    <div class="one"></div><div class="two"></div><div class="three"></div></header>
    <section class="col-md-6" style="font-size: 1.5rem">
        <table width="100%" height="50%">
            <tbody>
                <tr>
                    <td class="titles td1">Identificación Usuario:</td>
                    <td class="data td2">{{$register[0]['uc_ide']}}</td>
                </tr>
                <tr>
                    <td class="titles td1">Cliente:</td>
                    <td class="data td2">{{$register[0]['bt_social']}}</td>
                </tr>
                <tr>
                    <td class="titles td1">Nombre Usuario:</td>
                    <td class="data td2">{{$register[0]['uc_users']}}</td>
                </tr>
                <tr>
                    <td class="titles td1">N° de Contrato:</td>
                    <td class="data td2">{{sprintf("%'.04d\n",$register[0]['conNumber'])}}</td>
                </tr>
                <tr>
                    <td class="td1">Solicitud N° 1:</td>
                </tr>
                <tr>
                    <td colspan="2" class="align" style="border: 1px solid #a9afb5; height:10%; width:100%;">{{$request1}}</td>
                </tr>
                <tr>
                    <td class="td1">Solicitud N° 2:</td>
                </tr>
                </tr>
                    <td colspan="2" class="align" style="border: 1px solid #a9afb5; height:10%; width:100%;">{{$request2}}</td>
                <tr>
                <tr>
                    <td class="td1">Solicitud N° 3:</td>
                </tr>
                <tr>
                    <td colspan="2" class="align" style="border: 1px solid #a9afb5; height:10%; width:100%;">{{$request3}}</td>
                </tr>
            </tbody>
        </table>
    </section>
    <footer class="pdf-footer">
        <strong class="text">Factin Online Service versión 21.01.01  |  <em>Copyright © Javapri</em></strong>
    </footer>
</body>
</html>
