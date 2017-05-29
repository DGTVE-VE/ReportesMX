@extends('app') @section('content')
<br>
<center> <h4>Bienvenid {{$name_user}}</h4></center>
<br>
<center>
<h4 class="text-center">SISTEMA DE INFORMACIÓN DE USUARIOS</h4> <img src="logo_large.png" border=0>
</center>
<br>
<h4 class="text-center">Selecciona un curso para mostrarte estadísticas del mismo.</h4>
<br>
<br>

<form action="{{url('inicioCursos')}}" method="POST" class="text-center">
{!! csrf_field() !!}
<?php $j = 0; ?>
  <select id="select_curso" name="course_id">
    <?php
    $user = \Illuminate\Support\Facades\Auth::user();
    $auth_user = \App\Model\Auth_user::where('email', $user->email)->first();

    if (isset($auth_user->is_superuser)) {
        if ($auth_user->is_superuser == 1) {
    ?>
          <option value="0">Todos los cursos de MéxicoX</option>
    <?php
      }
    }
    ?>
      @foreach($course_name as $i)
        <option value="{{$cursoid[$j]}}">{{$i}}</option>
        <?php $j++; ?>
      @endforeach
    </select>
    <input type="submit">
</form>
@endsection
