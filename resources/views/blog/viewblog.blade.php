@extends('app')

@section('content')
  <!--link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
  <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"-->

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
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><center><h2><a href="{{url('blog')}}">Blog de MéxicoX</a></h2></center></div>

    <div class="col-sm-1 col-md-1"></div>

    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-6" style="margin-bottom:20px;">
        <center class="titulo">{{$entrada[0]->titulo}}</center>
        <div class="col-md-12"><br><br></div>
        <div class="col-md-2"></div>
          <div class="col-md-8"><img src="{{asset('imagenes_entradas/'.$entrada[0]->imagen)}}" class="img-responsive center-block"></div>
          <div class="col-md-2"></div>
            <div class="col-md-12"><br><br></div>

          <div class="col-md-12">
            <h4>Por: {{$entrada[0]->autor}}</h4>

          </div>
          <div class="col-md-12"><br></div>
          <div class="col-md-12">
            Fecha: {{$entrada[0]->fecha}}
          </div>
          <div class="col-md-12"><br></div>
          <div class="col-md-12 text-justify">
            {!!$entrada[0]->cuerpo!!}
          </div>
          <div class="col-md-12"><br></div>
          <div class="col-md-12">
            Referencias:
              {{$entrada[0]->referencias}}
          </div>


    </div>

    <div class="col-xs-1 col-sm-12 col-md-1 col-lg-1"></div>
    <div class="col-sm-1 col-md-1 visible-sm visible-xs"></div>
    <div class="col-xs-12 col-xs-offset-0 col-sm-10 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0">
          <center class="titulo">Todas las publicaciones</center>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div>
          @foreach($entradas as $i)
            <div class="col-md-12 col-lg-12 hidden-sm hidden-xs" style="padding:10px;"></div>
            <div class="col-xs-1 visible-xs"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 recuadro">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    {!!$i->titulo!!}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                    Por: {!!$i->autor!!}
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                    <a href="{{url ('getblog?id='.$i->id)}}">Ver publicación</a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    Fecha: {!!$i->fecha!!}
                </div>
            </div>
            <div class="col-sm-2 visible-sm"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:15px;"></div>
          @endforeach
    </div>

      <div class="col-md-1"></div>
@endsection