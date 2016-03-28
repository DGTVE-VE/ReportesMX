@extends('app') @section('content')
<br>
<center> <h4>Hola, {{$name_user}}</h4></center>
<br>
<center>
<h4 class="text-center">Sistema de Información de usuarios de MéxicoX</h4> <img src="logo_large.png" border=0>
</center>
<br>
<h4 class="text-center">Selecciona el curso para mostrarte las estadisticas del mismo.</h4>
<br>
<br>

<form action="{{url('home')}}" method="POST" class="text-center">
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
