<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link rel="Icon" href="{{asset('img/logofactin.png')}}">
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/mtstyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.bootstrap.min.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.js')}}"></script>
    <script src="{{asset('js/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/DataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/DataTables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/DataTables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/greensockjs.js')}}"></script>
    <script src="{{asset('js/application.js')}}"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600;700&family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    <style>body{font-family: 'Raleway'}</style>
</head>
<body>
    <div id="app"> 
        @auth            
        <div class="container-fluid logout-final">
            <div class="btn btn-default offset-05 logout-text-color" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><em>{{auth::User()->name}}</em> | <b>Salir</b><span class="icon-plex"></span>       
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endauth
        <header class="container-fluid">        
            <div class="flex-direction flex-justified">
                <div class="figure icon1">
                    <a href="#">
                        <img src="{{asset('img/logofactin.png')}}" alt="img-factin" class="size-img">
                    </a>
                </div>
                <div class=" navbar nav-justified flex-justified bg-menu">
                    <div class="text-center version-color blockquote" style="margin: 1%">
                        <strong class="legend">Factin Online Service versión 21.01.01  |  <em>Copyright © Javapri</em></strong>
                    </div>
                    @auth                        
                    <div class="navbar-collapse flex-justified marge-list">
                        <div class="navbar">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">CONFIGURACION
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu row-cols-1 text-center list-padding">
                                    <li><a href="{{route('access.roles')}}">ACCESO</a></li>
                                    <li><a href="{{route('location.located')}}">UBICACIONES</a></li>
                                    <li><a href="{{route('company.information')}}">EMPRESA</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">ADMINISTRACION
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu row-cols-1 text-center">
                                    <li><a href="{{route('collaborator.index')}}">RECURSOS HUMANOS</a></li>
                                    <li><a href="{{route('product.index')}}">TIPO DE PRODUCTOS</a></li>
                                    <li><a href="{{route('services.index')}}">TIPO DE SERVICIOS</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">COMERCIAL
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu row-cols-1 text-center">
                                    <li><a href="{{route('factin.index')}}">PORTAFOLIO</a></li>
                                    <li><a href="#">PLAN DE MERCADEO</a></li>
                                    <li><a href="#">CLIENTES POTENCIALES</a></li>
                                    <li><a href="#">CONTRATACIÓN</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">SOPORTE
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu row-cols-1 text-center">
                                    <li><a href="#">SOLICITUDES</a></li>
                                    <li><a href="#">PROGRAMACION</a></li>
                                    <li><a href="#">SEGUIMIENTO</a></li>
                                    <li><a href="#">CALIFICACION</a></li>
                                    <li><a href="#">ARCHIVO</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">FINANCIERA
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu row-cols-1 text-center">
                                    <li><a href="#">ESTADO DE CUENTA</a></li>
                                    <li><a href="#">MOVIMIENTOS COMERCIALES</a></li>
                                    <li><a href="#">INFORMES</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>          
                    @endauth
                </div>
                <div class="figure icon2">
                    <a href="#">
                        <img src="{{asset('img/Logojavapri.png')}}" alt="img-javapri" class="size-img">
                    </a>                
                </div>
            </div>
        </header>
        <main class="row"  style="margin-top: .5%">
            @yield('content')
        </main>
    </div>
    
    @yield('ScriptZone')
</body>
</html>
