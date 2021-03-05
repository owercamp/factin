<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            .font-header{
                background: radial-gradient(circle 160px at 100% 50%, transparent 50%,rgba(0,123,255,0.4) 45%),radial-gradient(circle 160px at 70% 100%, transparent 50%,rgba(0,123,255,0.6) 45%),radial-gradient(circle 160px at 40% 50%, transparent 50%,rgba(0,123,255,0.5) 45%);
                border-radius: 15px;
            }.row {
                display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;
            }.version-color {
                color: #f5f5f5;text-shadow: #343a40 0.5px 0.5px 0.5px;
            }.mt-4,.my-4 {
                margin-top: 1.5rem !important;
            }.ml-3,.mx-3 {
                margin-left: 1rem !important;
            }.text-primary {
                color: #007bff !important;
            }a.text-primary:hover, a.text-primary:focus {
                color: #0056b3 !important;
            }
            @media screen (max-width: 993px){
                img{width: 100%;}
            }
        </style>
    </head>
    <body>
        <header class="">
            <div class="font-header">
                <img src="{{asset('img/logofactin.png')}}" alt="img-factin">
                <strong style="margin-left: 5%" class="version-color">Factin Online Service versión 21.01.01  |  <em>Copyright © Javapri</em></strong>
            </div>
        </header>
        <section class="my-4 mx-3">
            <h6 class="text-primary">Apreciado usuario</h6>
            <div>
                <p>Nuestro equipo de trabajo a recibido con exito su solicitud. Y estamos trabajaremos para darte una solución lo mas pronto posible.</p>
                <p>porque para nosotros nuestros clientes son primero!</p>
                <p>fecha estimada para la solución: {{$dates}}</p>
            </div>
        </section>
    </body>
</html>
