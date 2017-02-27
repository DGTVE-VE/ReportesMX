@extends('app')

@section('content')
  <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
  <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <style>
    .titulo{
      border-radius: 10px 10px 0px 0px;
      border: 2px solid #614371;
      font-size: 16px;
      padding: 8px;
      font-style: italic;
      font-weight: bold;
      color: white;
      background-color: #614371;
    }
    .recuadro{
      border-radius: 10px 10px 10px 10px;
      border: 2px solid black;
      font-size: 14px;
      padding: 15px;
    }

  </style>
  
<center><h2><a href="{{url('blog')}}">Blog de MéxicoX</a></h2></center>
<br>

  <div class="row">
    <div class="col-md-1"></div>

    <div class="col-md-6">
      <center class="titulo">Publicaciones recientes</center>
      <div class="col-md-12"><br></div>
      <?php $j = 0; ?>
      @foreach($entradas as $i)
      @if($j < 3)

      <div class="col-md-12"><br></div>

      <div class="col-md-12 recuadro">

        <div class="col-md-4"><img src="{{asset('imagenes_entradas/'.$i->imagen)}}" class="img-responsive center-block"></div>

        <div class="col-md-8">
          <b>{!!$i->titulo!!}</b>
          <br>
          <br>
        {!! (substr($i->cuerpo, 0, 150)) !!}

        <a href="{{url ('getblog?id='.$i->id)}}">Seguir leyendo...</a>

      </div>

      </div>

      <div class="col-md-12"><br></div>
      <?php $j++; ?>
      @endif
      @endforeach

    </div>

    <div class="col-md-1"></div>

    <div class="col-md-3">
      <center class="titulo">Todas las publicaciones</center>

        <div class="col-md-12"><br></div>

      @foreach($entradas as $i)

      <div class="col-md-12"><br></div>

      <div class="col-md-12 recuadro">
        {!!$i->titulo!!}
        <br>
        Por: {!!$i->autor!!}
        <br>
        Fecha: {!!$i->fecha!!}
        <br>
        <a href="{{url ('getblog?id='.$i->id)}}">Ver publicación</a>

      </div>

      <div class="col-md-12"><br></div>
      @endforeach



    </div>

    <div class="col-md-1"></div>
  </div>
@endsection
