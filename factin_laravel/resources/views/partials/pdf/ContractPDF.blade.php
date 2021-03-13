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
            height: 150px;
            width: 100%;
            background: rgba(0,123,255,0.4);
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
        }
        section{
            height: 710px;
        }
        .ima{
            float: left;
            height: 150px;
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
    </style>
    <title>Contrato</title>
</head>
<body>
    <header class="pdf-header"><img class="ima" src="{{asset('img/logofactin.png')}}" alt="img-factin">
    <div class="one"></div><div class="two"></div><div class="three"></div></header>
    <section></section>
    <footer class="pdf-footer"></footer>
</body>
</html>
