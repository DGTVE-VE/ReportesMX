<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>1er Aniversario</title>

  <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
  <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>
  <nav class="navbar navbar-default">

    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="http://mx.televisioneducativa.gob.mx/" target="Ir a MéxicoX">
          <img src="{{asset('logo_large.png')}}" alt="imagen" width= "85px">
        </a>
      </div>
    </div>
  </nav>

  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div>
  @endif

  <div class="row">
    <form method="POST"  class="form-signin" action="{{url('savevideo')}}" accept-charset="UTF-8" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{!! csrf_token() !!}">
      <br>
      <br>
      <div class="col-md-6 col-md-offset-3">
        <h3>Felicidades
          <br><small>Puedes compartir tus experiencias en nuestro primer aniversario.</small></h3>
          <br>

          <label for="inputEmail">Correo electrónico</label>
          <input type="email" class="form-control" id="inputEmail" placeholder="correo@mail.com" name="inputEmai" required>
        </div>

        <div class="col-md-6 col-md-offset-3">
          <label for="inputText">Cuentanos tus logros, metas y demás gracias a los cursos de México X</label>
          <textarea class="form-control" id="inputText" rows="3" name="inputText" required></textarea>
        </div>

        <div class="col-md-6 col-md-offset-3">
          <label for="inputVideo">Archivo de video</label>
          <input type="file" id="inputVideo" name="inputVideo" required>
          <p class="help-block">MP4, MPG, 3GP ó WMV de máximo 20 MB</p>
        </div>

        <div class="checkbox col-md-6 col-md-offset-3">
          <label>
            <input type="checkbox" required>Acepto los términos y condiciones
          </label>
        </div>

        <button type="submit" class="btn btn-defaultcol-md-6 col-md-offset-3 btn btn-danger">Enviar</button>
      </form>

    </div>
    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
  </html>
