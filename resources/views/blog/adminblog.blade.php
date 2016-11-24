<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Administración Blog</title>

  <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
  <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script></script>

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

<br>
<center><h3>Crear entrada en el Blog de MéxicoX</h3></center>
<br>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <form class="container-fluid"  action="{{url('saveblog')}}" method="POST"  enctype="multipart/form-data">

    {{csrf_field ()}}

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <label for="inputTitulo">Título de la entrada</label>
        <input type="text" class="form-control" id="inputTitulo" name="inputTitulo" placeholder="Título">
      </div>
      <div class="col-md-2"></div>
    </div>

    <br>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <label for="inputAutor">Autor</label>
        <input type="text" class="form-control" id="inputAutor" name="inputAutor" placeholder="Apellido, Nombre">
      </div>
      <div class="col-md-2"></div>
    </div>

    <br>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <label for="inputCuerpo">Cuerpo</label>
        <textarea class="form-control" id="inputCuerpo" name="inputCuerpo" rows="1" placeholder="Escribe aquí tu mensaje..."></textarea>
      </div>
      <div class="col-md-2">  </div>
    </div>

    <br>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <label for="inputDate">Fecha de la publicación</label>
        <input type="text" class="form-control" id="inputDate" name="inputDate" placeholder="aaaa-mm-dd">
      </div>
      <div class="col-md-2"></div>
    </div>

    <br>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <label for="inputRef">Referencias</label>
        <input type="text" class="form-control" id="inputRef" name="inputRef" placeholder="Bibliografía">
      </div>
      <div class="col-md-2"></div>
    </div>

    <br>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <center>
        <label for="inputImagen">Imagen de la entrada</label>
        <input type="file" id="inputImagen" name="inputImagen" >
      </center>
      </div>
      <div class="col-md-2"></div>
    </div>

    <br><br>

    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
          <center><button type="submit" class="btn btn-danger">Subir</button></center>
      </div>

      <div class="col-md-3"></div>
    </div>
    <br><br>

</form>
</body>
</html>