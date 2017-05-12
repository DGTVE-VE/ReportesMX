<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Información de usuarios de MéxicoX</title>

        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">

        <!-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> -->

        <!-- Fonts -->
        <script src="https://use.fontawesome.com/a967cb30b3.js"></script>
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{asset ('css/estilos.css')}}">
        <!-- Css ficha-->
        <link rel="stylesheet" type="text/css" href="{{asset ('css/fichaCss.css')}}">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

    </head>
    <body>
        <nav class="navbar navbar-default">

            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://mx.televisioneducativa.gob.mx/" target="Ir a MéxicoX">
                        <img src="{{asset('logo_large.png')}}" alt="imagen" width= "85px">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav col-md-10">
                        <li><a href="{{url ('/')}}" class="bg-active" title="Inicio">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reportes <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url ('home')}}" class="bg-active">Listado Cursos</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url ('totales')}}" class="bg-active">Información usuarios</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url ('infocurso')}}" class="bg-active">Estadísticas curso</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('inscritost')}}" class="bg-active">Inscritos a cursos</a><li>
                                <li class="divider"></li>
                                <li><a href="{{url ('geo')}}" class="bg-active">Información Geográfica</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url ('videos')}}" class="bg-active">Videos</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url ('constancias')}}" class="bg-active">Buscar Folio</a></li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Administración <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url ('instituciones/contactos_institucion')}}" class="bg-active">Personal</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url ('formatos/ficha_tecnica')}}" class="bg-active">Ficha Técnica</a></li>
                            </ul>
                        </li>
                        <?php
                        $user = \Illuminate\Support\Facades\Auth::user();
                        $auth_user = \App\Model\Auth_user::where('email', $user->email)->first();

                        if (isset($auth_user->is_superuser)) {
                            if ($auth_user->is_superuser == 1) {
                                ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        Acciones de Superusuario<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{url ('mail/compose')}}" class="bg-close" title="Envío de correos">
                                                Envío de Correo
                                            </a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{url ('asociaCategoria')}}" class="bg-close" title="Categorias">
                                                Asocia curso a categorias
                                            </a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{url ('admin/banner_principal')}}" class="bg-close" title="Banner">
                                                Administrar Banners
                                            </a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{url ('admin/course_name')}}" class="bg-close" title="Agregar Cursos">
                                                Cursos</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{url ('instituciones/institucion')}}" class="bg-active">Instituciones</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{url ('adminblog')}}" class="bg-close" title="Blog">Entrada de Blog</a></li>

                                    </ul>
                                </li>

                                <?php
                            }
                        }
                        ?>
                        @if(isset($course_name))
                          <li>
                            <a href="{{url('other_course')}}" role="button" title="Seleccionar otro curso">
                              <span class="glyphicon glyphicon-retweet"></span>
                            </a>
                          </li>
                        @endif
                        <li class="pull-right"><a href="{{url ('logout')}}" class="bg-close" title="Salir">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li class="pull-right"><a>Hola {{$name_user}}</a></li>

                    </ul>

                </div>
            </div>
        </nav>

        @if(Session::has ('success_message'))
        <div class='container'>
            <div id='success_message' class='col-md-8 col-md-offset-2 alert alert-success fade in alert-dismissable '>
                <strong>
                    {{Session::get('success_message')}}
                </strong>
            </div>
        </div>
        @endif
        @yield('content')

        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

        <!--        //code.jquery.com/jquery-1.12.4.js-->
        <script>
$(document).ready(function () {
    $("#success_message").fadeTo(2000, 500).slideUp(500, function () {
        $("#success_message").slideUp(500);
    });
});
        </script>
        @yield('scripts')
    </body>
</html>
