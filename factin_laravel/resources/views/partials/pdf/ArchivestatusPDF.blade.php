<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="Icon" href="{{asset('img/logofactin.png')}}">
        <style>
            header, section {
                display: block;
            }
            body {
                margin: 0;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
            }
            .card-body {
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                min-height: 1px;
                padding: 1.25rem;
            }
            .border {
                border: 1px solid #dee2e6 !important;
            }
            .p-4 {
                padding: 1.5rem !important;
            }
            .text-muted {
                color: #6c757d !important;
            }
            .text-primary {
                color: #007bff !important;
            }
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group {
            display: -ms-flexbox;
            display: flex;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 0;
        }
        .header-pdf{
            position: relative;
            background: rgba(0, 123, 255, 0.11);
            border-radius: 25px;
            height: 170px;
        }
        .header-pdf::after{
            content: "";
            position: absolute;
            height: 10px;
            width: 20px;
            background-color: #fff;
            top: -1px;
            left: 26px;
            z-index: 1;
        }
        .header-pdf::before{
            content: "";
            position: absolute;
            height: 10px;
            width: 20px;
            background-color: #fff;
            top: -1px;
            left: 66px;
            z-index: 1;
        }
        .image-pdf{
            float: left;
            top: 3%;
            position: absolute;
            margin-left: 3%;
            border-radius: 25px;
            border: #fe9a00 groove 1px;
        }
        .display-flex{
            float: right;
            margin-top: 6%;
            width: 400px;
            margin-right: 7%;
            color: #fe9a00;
            margin-bottom:-48px;
            text-align: center;
        }
        .body-pdf{
            position: absolute;
            margin-top: 10px;
            border:rgba(0, 123, 255, 0.11) solid 1.5px;
        }
        .body-pdf::after{
            content: "";
            position: absolute;
            height: 10px;
            width: 20px;
            background-color: #fff;
            top: -20px;
            right: 36px;
            z-index: 1;
        }
        .body-pdf::before{
            content: "";
            position: absolute;
            height: 10px;
            width: 20px;
            background-color: #fff;
            top: -20px;
            right: 76px;
            z-index: 1;
        }
        .labeltext2{
            float: left;
            margin-top: -1.5%;
            margin-left: 3%;
            background-color: #fff;
            padding: auto 7%;
            border: cadetblue solid 1.5px;
            border-radius: 45%;
        }
        .myborder{
            margin-top: -2.5%;
            padding-top: 2%;
            border: cadetblue solid 1.5px;
            height: 25% !important;
            border-radius: 25px;
        }
        .myborder2{
            margin-top: 2.5%;
            padding-top: 3%;
            border: cadetblue solid 1.5px;
            height: 15% !important;
            border-radius: 25px;
        }
        .status{
            float:right;
            margin-top:-90%;
            margin-right: 9%;
            padding: .1% 5%;
            font-size: 2em;
            color:#007bff;
            border: #007bff solid 1px;
            border-radius: 45%;
            z-index: 1000;
        }
        .statusApproved{
            float:right;
            margin-top:-90%;
            margin-right: 9%;
            padding: .1% 5%;
            font-size: 2em;
            color:#28a745;
            border: #28a745 solid 1px;
            border-radius: 45%;
            z-index: 1000;
        }
        .statusNonApproved{
            float:right;
            margin-top:-90%;
            margin-right: 9%;
            padding: .1% 5%;
            font-size: 2em;
            color:#BD0006;
            border: #BD0006 solid 1px;
            border-radius: 45%;
            z-index: 1000;
        }

        </style>
        <title>Descargas PDF</title>
    </head>
    <body>
        <header class="header-pdf">
            <img class="image-pdf" src="{{asset('img/logofactin.png')}}" alt="img-factin">
            <strong class="display-flex">Factin Online Service versión 21.01.01  |  <em>Copyright © Javapri</em></strong>
        </header>
        <section class="body-pdf" style="margin-top: 1%">
            <div class="row col-md-12">
                <small class="text-primary labeltext" style="font-size: 18px;margin-left: 38%;">Información Corporativa</small>
            </div>
            <div class="card-body p-4 border">
                <div class="myborder">
                    <div style="margin-left: 2%">
                        <div class="form-group">
                            <small class="text-muted">FECHA:</small>
                            <span><p>{{$commercial->lead_Date}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 34%; margin-top: -12%">
                        <div class="form-group">
                            <small class="text-muted">RAZÓN SOCIAL</small>
                            <span><p>{{$commercial->bt_social}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 62%; margin-top: -12%">
                        <div class="form-group">
                            <small class="text-muted">TIPO DE IDENTIFICACION</small>
                            <span><p>{{$commercial->lead_tide}}</p></span>
                        </div>
                    </div>
                    <div style="margin: 2%; margin-top:-2%">
                        <div class="form-group">
                            <small class="text-muted">N° IDENTIFICACION:</small>
                            <span><p>{{$commercial->lead_ide}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 28%; margin-top:-12%">
                        <div class="form-group">
                            <small class="text-muted">DEPARTAMENTO / MUNICIPIO </small>
                            <span><p>{{$commercial->depname}} / {{$commercial->munname}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 62%; margin-top:-19%">
                        <div class="form-group">
                            <small class="text-muted">DIRECCION:</small>
                            <span><p>{{$commercial->lead_adr}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 2%; margin-top:-2%">
                        <div class="form-group">
                            <small class="text-muted">CONTACTO</small>
                            <span><p>{{$commercial->lead_con}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 30%; margin-top:-12%">
                        <div class="form-group">
                            <small class="text-muted">TELEFONO - WHATSAPP</small>
                            <span><p>{{$commercial->lead_pho}} - {{$commercial->lead_what}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 62%; margin-top:-25%">
                        <div class="form-group">
                            <small class="text-muted">EMAIL:</small>
                            <span><p>{{$commercial->lead_ema}}</p></span>
                        </div>
                    </div>
                </div>
                <small class="text-primary labeltext2" style="font-size: 18px">Información Venta</small>
                <div class="myborder2">
                    <div style="margin-left: 5%">
                        <div class="form-group">
                            <small class="text-muted">PRODUCTO:</small>
                            <span><p>{{$commercial->lead_pro}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 40%; margin-top: -15%">
                        <div class="form-group">
                            <small class="text-muted">PRECIO:</small>
                            <span><p>{{number_format($commercial->lead_value,0,',','.')}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 53%; margin-top: -15%">
                        <div class="form-group">
                            <small class="text-muted">CANT:</small>
                            <span><p style="margin-left:4%">{{$commercial->lead_quantity}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 63%; margin-top: -15%">
                        <div class="form-group">
                            <small class="text-muted">VALOR IVA:</small>
                            <span><p style="margin-left:4%">{{number_format($commercial->lead_iva,0,',','.')}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 79%; margin-top: -15%">
                        <div class="form-group">
                            <small class="text-muted">SUBTOTAL:</small>
                            <span><p>{{number_format($commercial->lead_sub,0,',','.')}}</p></span>
                        </div>
                    </div>
                    <div style="margin-left: 8%; margin-top: -5%">
                        <div class="form-group">
                            <small class="text-muted">TOTAL:</small>
                            <span><p>{{number_format($commercial->lead_sub,0,',','.')}}</p></span>
                        </div>
                    </div>
                    @if ($commercial->lead_status == "APROBADO")
                        <p class="statusApproved">{{$commercial->lead_status}}</p>
                    @else
                        <p class="statusNonApproved">{{$commercial->lead_status}}</p>
                    @endif
                </div>
                <div style="margin-left: 2%; margin-top: 1%">
                    <div class="form-group">
                        <small class="text-muted">OBSERVACIONES</small>
                        <span><p>{{$commercial->lead_obs}}</p></span>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
