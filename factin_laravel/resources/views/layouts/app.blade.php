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
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.theme.min.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.js')}}"></script>
    <script src="{{asset('js/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/DataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/DataTables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/DataTables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script src="{{asset('js/jquery.maskMoney.js')}}"></script>
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
            <div class="d-flex flex-justified">
                <div class="figure icon1">
                    <a href="#">
                        <img id="log1" src="{{asset('img/logofactin.png')}}" alt="img-factin" class="size-img">
                    </a>
                </div>
                <div class=" navbar nav-justified flex-justified bg-menu">
                    <div class="text-center version-color blockquote" style="margin: 1%">
                        <strong class="legend">Factin Online Service versión 21.01.01  |  <em>Copyright © Javapri</em></strong>
                    </div>
                    @auth
                    <div class="navbar-collapse flex-justified marge-list d-flex row flex-nowrap align-items-center">
                        <div>
                            <a href="{{route('home')}}" class="btn btn-default text-center" style="font-size: 200%; width: 70px; margin-left: 20px;"><span class="icon-building-o"></span><p style="font-size: 15px;">Home</p></a>
                            
                        </div>
                        <div class="navbar w-100 justify-content-around">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" style="box-shadow: none" type="button" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">CONFIGURACION</button>
                                <ul class="dropdown-menu row-cols-1 text-center m-0 p-0" aria-labelledby="dropdownMenuButton">
                                    @can('access.roles')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('access.roles')}}">ACCESO</a>
                                    @else
                                        <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('access.roles')}}">ACCESO</a>
                                    @endcan
                                    @can('location.located')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('location.located')}}">UBICACIONES</a>
                                    @else
                                        <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('location.located')}}">UBICACIONES</a>
                                    @endcan
                                    @can('company.information')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('company.information')}}">EMPRESA</a>
                                    @else
                                        <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('company.information')}}">EMPRESA</a>
                                    @endcan
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" style="box-shadow: none" type="button" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">ADMINISTRACION</button>
                                <ul class="dropdown-menu row-cols-1 text-center m-0 p-0" aria-labelledby="dropdownMenuButton">
                                    @can('collaborator.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('collaborator.index')}}">RECURSOS HUMANOS</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('collaborator.index')}}">RECURSOS HUMANOS</a>
                                    @endcan
                                    @can('product.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('product.index')}}">TIPO DE PRODUCTOS</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('product.index')}}">TIPO DE PRODUCTOS</a>
                                    @endcan
                                    @can('services.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('services.index')}}">TIPO DE SERVICIOS</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('services.index')}}">TIPO DE SERVICIOS</a>
                                    @endcan
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" style="box-shadow: none" type="button" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">COMERCIAL</button>
                                <ul class="dropdown-menu row-cols-1 text-center m-0 p-0" aria-labelledby="dropdownMenuButton">
                                    @can('factin.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('factin.index')}}">PORTAFOLIO</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('factin.index')}}">PORTAFOLIO</a>
                                    @endcan
                                    @can('oportunity.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('oportunity.index')}}">PLAN DE MERCADEO</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('oportunity.index')}}">PLAN DE MERCADEO</a>
                                    @endcan
                                    @can('proposal.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('proposal.index')}}">CLIENTES POTENCIALES</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('proposal.index')}}">CLIENTES POTENCIALES</a>
                                    @endcan
                                    @can('ClientLegalization.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('ClientLegalization.index')}}">CONTRATACIÓN</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('ClientLegalization.index')}}">CONTRATACIÓN</a>
                                    @endcan
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" style="box-shadow: none" type="button" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">SOPORTE</button>
                                <ul class="dropdown-menu row-cols-1 text-center m-0 p-0" aria-labelledby="dropdownMenuButton">
                                    @can('request.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('request.index')}}">SOLICITUDES</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('request.index')}}">SOLICITUDES</a>
                                    @endcan
                                    @can('programming.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('programming.index')}}">PROGRAMACION</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('programming.index')}}">PROGRAMACION</a>
                                    @endcan
                                    @can('tracing.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('tracing.index')}}">SEGUIMIENTO</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('tracing.index')}}">SEGUIMIENTO</a>
                                    @endcan
                                    @can('qualification.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('qualification.index')}}">CALIFICACION</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('qualification.index')}}">CALIFICACION</a>
                                    @endcan
                                    @can('archiverequest.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('archiverequest.index')}}">ARCHIVO</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('archiverequest.index')}}">ARCHIVO</a>
                                    @endcan
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" style="box-shadow: none" type="button" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">FINANCIERA</button>
                                <ul class="dropdown-menu row-cols-1 text-center m-0 p-0" aria-labelledby="dropdownMenuButton">
                                    @can('account.index')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('account.index')}}">ESTADO DE CUENTA</a>
                                    @else
                                    <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('account.index')}}">ESTADO DE CUENTA</a>
                                    @endcan
                                    @can('billingorder.finance')
                                        <a class="btn btn-outline-primary border-left-0 border-right-0 w-100" href="{{route('billingorder.finance')}}">MOVIMIENTOS COMERCIALES</a>
                                    @else
                                        <a class="btn btn-outline-secondary border-left-0 border-right-0 w-100 disabled" href="{{route('billingorder.finance')}}">MOVIMIENTOS COMERCIALES</a>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
                <div class="figure icon2">
                    <a href="#">
                        <img id="log2" src="{{asset('img/Logojavapri.png')}}" alt="img-javapri" class="size-img">
                    </a>
                </div>
            </div>
        </header>
        <main class="row"  style="margin-top: .5%">
            @yield('content')
        </main>
    </div>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
    @yield('ScriptZone')
</body>
</html>
