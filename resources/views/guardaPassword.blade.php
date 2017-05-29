@extends('layouts.clean')

@section('content')


@if(empty ($usuario))
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1> Busca el usuario en MéxicoX </h1>
    </div>    
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">        
        <form action="buscaAuthUserXCorreo" method="POST" class="form-inline">
            {{csrf_field()}}
            <label for="email"> <i class="fa fa-envelope-o" aria-hidden="true"></i> Correo electrónico</label>
            <input type="text" id="email" name="email" placeholder="Correo del usuario" class="form-control">
            <input type="submit" value="Buscar correo" class="btn btn-info">
        </form>                
    </div>        
</div>
 
<br>
@else
    @if (!empty ($password))
    <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1> Restaura el password del usuario </h1>
    </div>    
    </div>
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="restauraPassword" method="POST" class="form-inline">
                {{csrf_field()}}                                
                <input type="hidden" value="{{$password->email}}" name='email'>
                <input type="submit" value="Restaurar" class="btn btn-danger">
                <a href='{{url('/')}}' class='btn'> Cancelar </a>
            </form>                
        </div>        
    </div>        
    @else
    <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1> Guarda el password del usuario temporalmente, nuevo password: 'a234567z' </h1>
    </div>    
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="resguardaPassword" method="POST" class="form-inline">
                {{csrf_field()}}
                <h3> {{$usuario->email}} </h3>
                <input type="hidden" value="{{$usuario->id}}" name='id'>
                <input type="submit" value="Resguardar" class="btn btn-warning">
                <a href='{{url('/')}}' class='btn'> Cancelar </a>
            </form>                
        </div>        
    </div>        
    @endif
@endif 

@endsection