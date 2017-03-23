@extends('app') @section('content')
<br>
<center> <h4>Bienvenido {{$name_user}}</h4></center>
<br>
<center>
<h4 class="text-center">Sistema de Información de usuarios</h4> <img src="logo_large.png" border=0>
</center>
<br>
<h4 class="text-center">Selecciona un curso para mostrarte estadisticas del mismo.</h4>
<br>
<br>

<form action="{{url('home')}}" method="POST" class="text-center">
{!! csrf_field() !!}
<?php $j = 0; ?>
  <select id="select_curso" name="course_id">
        <option value="0">Seleccione un curso</option>
      @foreach($course_name as $i)
        <option value="{{$cursoid[$j]}}">{{$i}}</option>
        <?php $j++; ?>
      @endforeach
    </select>
    <input type="submit">
</form>
@endsection
