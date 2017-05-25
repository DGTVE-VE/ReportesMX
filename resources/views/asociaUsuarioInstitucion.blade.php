@extends('layouts.clean')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1> Asocia usuario a institucion </h1>
    </div>    
</div>
@if(empty ($usuarioAasociar))
<div class="row">
    <div class="col-md-6 col-md-offset-3">        
        <form action="buscaCorreo" method="POST" class="form-inline">
            {{csrf_field()}}
            <label for="email"> <i class="fa fa-envelope-o" aria-hidden="true"></i> Correo electrónico</label>
            <input type="text" id="email" name="email" placeholder="Correo del usuario" class="form-control">
            <input type="submit" value="Buscar correo" class="btn btn-info">
        </form>                
    </div>        
</div>
@endif 
<br>
@if(!empty ($usuarioAasociar))
<div class="row">
    <div class="col-md-6 col-md-offset-3">        
        <form action="asociaUsuario" method="POST" class="form-inline">
            {{csrf_field()}}
            <label for='institucion_id'> <strong> {{$usuarioAasociar->email}}</strong> </label>
            Pertenece a:
            {!!Form::select ('institucion_id', $instituciones, null, ['class'=>'form-control'])!!}
            <input type="hidden" value="{{$usuarioAasociar->id}}" name='usuario_id'>
            <input type="submit" value="Asocia" class="btn btn-success">
            <a href='{{url('/')}}' class='btn'> Cancelar </a>
        </form>                
    </div>        
</div>        
@endif 

@endsection