@extends('app') @section('content')
<br>

<h3 class="text-center">Sistema de reportes de la plataforma</h3>

<br>

<h3 class="text-center" style="color:red;">MéxicoX</h3>

<br>
<center> <h4>Hola, {{$name_user}}</h4></center>
<h3 class="text-center">Selecciona el curso para mostrarte las estadisticas del mismo.</h3>
<br>
<br>

<form action="home" method="POST" class="text-center">
{!! csrf_field() !!}
  <select id="select_curso" name="course_name">
        <option value="0">Seleccione un curso</option>
      @foreach($course_name as $i){
          <option value="{{$i}}">{{$i}}</option>

      }
       @endforeach

    </select>
    <input type="submit">


</form>


@endsection
