@extends('app') @section('content')
<div class="col-md-12" style="padding:15px;"></div>
<center>
    <h4 class="text-center">REPORTE DE EVALUACIÓN POR PARES</h4>
    <div class="col-md-12" style="padding:10px;"></div>
    <img src="logo_large.png" border=0>
</center>
<div class="col-md-12" style="padding:10px;"></div>
<h4 class="text-center">Selecciona un curso para mostrarte reporte.</h4>
<div class="col-md-12" style="padding:15px;"></div>

<form action="{{url('muestraRepEvalPares')}}" method="POST" class="text-center">
{!! csrf_field() !!}
<?php $j = 0; ?>
  <select id="select_curso" name="course_id">
    <?php
    $user = \Illuminate\Support\Facades\Auth::user();
    $auth_user = \App\Model\Auth_user::where('email', $user->email)->first();

    if (isset($auth_user->is_superuser)) {
        if ($auth_user->is_superuser == 1) {
    ?>
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
