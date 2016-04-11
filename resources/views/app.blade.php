<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Información de usuarios de MéxicoX</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

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
				<a class="navbar-brand" href="http://mx.televisioneducativa.gob.mx/" target="_blank">MéxicoX</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{url ('/')}}" class="bg-danger">Inicio</a></li>
          <li><a href="{{url ('home')}}" class="bg-danger">Estadisticas Cursos</a></li>
          <li><a href="{{url ('totales')}}" class="bg-danger">Registrados en la plataforma</a></li>
					<li><a href="{{url ('edad')}}" class="bg-danger">Por edades</a></li>
					<li><a href="{{url ('genero')}}" class="bg-danger">Por genero</a></li>
					<li><a href="{{url ('nivel')}}" class="bg-danger">Por Nivel de Estudios</a></li>
					<!--li><a href="{{url ('geo')}}" class="bg-danger">Por Entidad Federativa</a></li>-->
          <li><a href="{{url ('desercion')}}" class="bg-danger">Deserción por curso</a></li>
					<li><a href="{{url ('videos')}}" class="bg-danger">Videos</a></li>
          <li><a href="{{url ('logout')}}" class="bg-success">Cerrar Sesión</a></li>

				</ul>

			</div>
		</div>
	</nav>

	@yield('content')


	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
