<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

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
				<a class="navbar-brand" href="http://mx.televisioneducativa.gob.mx/" target="_blank">México X</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/" class="bg-success">Iniciar Sesión</a></li>
					</ul>

			</div>
		</div>
	</nav>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<br>
<br>

<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div class="form-group">
        <label for="exampleInputName2" class="col-sm-2 control-label">Nombre: </label>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
      <label for="exampleInputName2" class="col-sm-2 control-label">Correo: </label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label for="exampleInputName2" class="col-sm-2 control-label">Contraseña: </label>
        <input type="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="exampleInputName2" class="col-sm-2 control-label">Confirmar contraseña: </label>
        <input type="password" name="password_confirmation" required>
    </div>

    <div class="form-group">
       <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-danger">Registrarse</button>
    </div>
    </div>
</form>

</body>
</html>
