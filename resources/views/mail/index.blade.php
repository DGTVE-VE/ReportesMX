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

        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

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
                    <ul class="nav navbar-nav">
                        <li><a href="{{url ('/')}}" class="bg-active" title="Selección de un curso">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            </a></li>
                        <li><a href="{{url ('home')}}" class="bg-active">Listado Cursos</a></li>
                        <li><a href="{{url ('totales')}}" class="bg-active">Información usuarios</a></li>
                        <li><a href="{{url ('infocurso')}}" class="bg-active">Estadísticas curso</a></li>
                        <li><a href="{{url('inscritost')}}" class="bgactive">Inscritos a cursos</a><li>
                        <li><a href="{{url ('videos')}}" class="bg-active">Videos</a></li>
                        <li><a href="{{url ('logout')}}" class="bg-close" title="Salir">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                            </a></li>
                        <li></li>

                    </ul>

                </div>
            </div>
        </nav>

        <div class="container">
            <div class='row'>
                <div class='col-md-2'></div>
                <div class='col-md-7'>
                    <form class="form-horizontal" role="form" method="POST" action='{{url('mail/show')}}'>
                        {{csrf_field ()}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Asunto: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="asunto" name='asunto'
                                       placeholder="Asunto del correo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Correos: </label>
                            <div class="col-sm-10">

                                <select class='form-control' id="select_curso" name="course_name">
                                    <option value='0'> Seleccione un curso </option>
                                    <!-- <option value="{{$courses_names}}"> Todos mis cursos </option> -->

                                    <!-- @foreach($courses_names as $i){
                                        <option value="{{$i}}">{{$i}}</option>
                                    }
                                     @endforeach -->

                                </select>

                            </div>
                        </div>
                        <textarea name='mensaje' rows="8">Mensaje...</textarea>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-offset-10 col-sm-2">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Scripts -->

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
    </body>
</html>
