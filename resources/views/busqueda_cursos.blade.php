
<!DOCTYPE html>
<html>
    <head>
        <!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="{{ asset('js/efectos.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/principal.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
        <meta charset= "utf-8">
    </head>
    <body>
        <div class = "container">
            <div class = "row">
                <div class = "col-md-2">
                    <a href="http://mx.televisioneducativa.gob.mx/"><img src="{{url('img/logo.png')}}"></a>
                </div>
                <div class = "col-md-4 padding-superior">
                    <a href="http://mx.televisioneducativa.gob.mx/register?next=%2Fdashboard"><p class = "text-left">REGISTRARSE</p></a>
                </div>
                <div class = "col-md-6 padding-superior">
                    <a href="http://mx.televisioneducativa.gob.mx/login"><img class = "pull-right" src="{{url ('img/boton_inicio_sesion.png') }}"></a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h2>Resultados encontrados</h2>
                </div>
                <div class="col-md-6 padding-superior">
                    <div class="input-group">

                        <form action="{{url('busca')}}" method="POST">
                            <input name="termino" type="text" class="form-control" placeholder="Quiero aprender de...">
                            <span class="input-group-btn boton-busca">
                                <button class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                        </form>
                    </div><!-- /input-group -->
                </div>
            </div>
            <hr>

            <div class="row">                
                <div class="col-md-10">    
                    @if(!empty($cursos))
                    <div class="row">

                        @foreach($cursos as $curso)
                        <div class="col-md-4 div-cursos div-curso">
                            <a style="text-decoration: none" href="http://mx.televisioneducativa.gob.mx/courses/{{ $curso->course_id }}/about">
                                <div class="thumbnail thumbnail-size border-thumbnail">

                                    <div class="opacity">                                
                                        <img class="thumbnail-image img-tin"src="{{ $curso->thumbnail }}" alt="...">
                                        <div class="textover1"><h2>Aprender más</h2></div>
                                    </div>
                                    <div class="caption">

                                        <div class="row"><div class="course-organization">{{ $curso->institucion }}</div></div>
                                        <div class="row"><div class="course-code">{{ $curso->course_id }}</div></div>
                                        <div class="row"><div class="course-title">{{ $curso->course_name }}</div></div>
                                        <div class="row"><div class="course-date">Empieza: {{ $curso->inicio }}</div></div>
                                    </div>
                                </div>
                            </a>
                        </div>   
                        @endforeach
                    </div>
                    @elseif(!empty($cursosCategoria))
                    <div class="row">
                        @foreach($cursosCategoria as $cursoCategoria)
                        <div class="col-md-4 div-cursos div-curso">
                            <a style="text-decoration: none" href="http://mx.televisioneducativa.gob.mx/courses/{{ $cursoCategoria->course_id }}/about">
                                <div class="thumbnail thumbnail-size border-thumbnail">
                                    <div class="opacity">
                                        <img class="thumbnail-image img-tin"src="{{ $cursoCategoria->thumbnail }}" alt="...">
                                        <div class="textover1"><h2>Aprender más</h2></div>
                                    </div>
                                    <div class="caption">

                                        <div class="row"><div class="course-organization">{{ $cursoCategoria->institucion }}</div></div>
                                        <div class="row"><div class="course-code">{{ $cursoCategoria->course_id }}</div></div>
                                        <div class="row"><div class="course-title">{{ $cursoCategoria->course_name }}</div></div>
                                        <div class="row"><div class="course-date">Empieza: {{ $cursoCategoria->inicio }}</div></div>
                                    </div>
                                </div></a>
                        </div>   
                        @endforeach
                    </div>
                    @else                    
                    <div class="row">
                        @foreach($cursosTodos as $cursoTodo)
                        <div class="col-md-4 div-cursos div-curso">
                            <a style="text-decoration: none"href="http://mx.televisioneducativa.gob.mx/courses/{{ $cursoTodo->course_id }}/about">
                                <div class="thumbnail thumbnail-size border-thumbnail">
                                    <div class="opacity">
                                        <img class="thumbnail-image img-tin"src="{{ $cursoTodo->thumbnail }}" alt="...">
                                        <div class="textover1"><h2>Aprender más</h2></div>
                                    </div>
                                    <div class="caption">
                                        <div class="row"><div class="course-organization">{{ $cursoTodo->institucion }}</div></div>
                                        <div class="row"><div class="course-code">{{ $cursoTodo->course_id }}</div></div>
                                        <div class="row"><div class="course-title">{{ $cursoTodo->course_name }}</div></div>
                                        <div class="row"><div class="course-date">Empieza: {{ $cursoTodo->inicio }}</div></div>
                                    </div>
                                </div></a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="col-md-2 div-filtra">
                    <h3>Filtra tu búsqueda</h3>
                    <ul class="list-group">
                        @foreach($cursosPorCategoria as $cursoPorCategoria)
                        <a href="{{url('categoria/')}}/{{ $cursoPorCategoria->id }}"><li class="list-group-item">
                                <span class="label label-default label-pill pull-right">{{ $cursoPorCategoria->cursos }}</span>
                                {{ $cursoPorCategoria->categoria }}
                            </li></a>
                        @endforeach
                    </ul>
                </div>
            </div>

            <hr>

            <div class = "row">
                <div class="col-md-8">
                    <ul class="lista-horizontal sin-paddingleft">
                        <li class="elemento"><a href="http://mx.televisioneducativa.gob.mx/about">Acerca de</a></li>
                        <li class="elemento"><a href="http://mx.televisioneducativa.gob.mx/blog">Aliados Estratégicos</a></li>
                        <li class="elemento"><a href="http://mx.televisioneducativa.gob.mx/faq">Preguntas frecuentes</a></li>
                        <li class="elemento"><a href="http://mx.televisioneducativa.gob.mx/contact">Contacto</a></li>
                    </ul>
                </div>
            </div>
            <div class= "row">
                <div class = "col-md-12">
                    <a href="https://open.edx.org/"><img class= "pull-right logo-edx" src="{{url ('img/openedx-logo.png') }}"></a>
                </div>
            </div>
            <div class= "row">
                <div class = "col-md-12">
                    <a href="http://mx.televisioneducativa.gob.mx/"><img class= "text-right" src="{{url ('img/logo.png')}}"></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="texto-footer">© MéxicoX. Todos los derechos reservados, excepto cuando se indique. EdX, Open edX, y los logos de edX y Open edX son marcas registradas de edX Inc.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="lista-horizontal sin-paddingleft">
                        <li><a href="http://mx.televisioneducativa.gob.mx/privacy">Política de privacidad</a></li>
                        <li><a href="http://mx.televisioneducativa.gob.mx/tos">Términos de servicio</a></li>
                        <li><a href="http://mx.televisioneducativa.gob.mx/honor">Código de honor</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>