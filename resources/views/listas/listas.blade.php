@extends('app') @section('content')
<br>
<h3> <p style="text-align: center";>Lista de usuarios de "{{$course_name}}"</p> </h3>
<p style="text-align: center";><a class="btn btn-warning" href="{{url ('/download/listas.csv')}}" role="button">Descargar lista de usuarios.csv</a></p>
@endsection
