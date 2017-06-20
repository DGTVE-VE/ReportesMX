@extends('layouts.clean')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1> Personal por institución </h1>
    </div>    
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">        
        <form action="{{url('instituciones/personal')}}" method="POST" class="form-inline">
            {{csrf_field()}}
            <label for="email"> Institución </label>
            {!!Form::select ('institucion_id', $instituciones, null, ['class' => 'form-control'])!!}
            <input type="submit" value="Mostrar personal" class="btn btn-info">
        </form>                        
    </div>            
</div>
<hr>
<div class="row">
    <div class="col-md-6 col-md-offset-3"> 
        <h1>
            @if (empty ($institucion))
                Sin institución
            @else
                {{$institucion->siglas}}
            @endif
        </h1>
        <table class='table table-bordered'>
            <thead>
            <th> Usuario </th><th> Correo</th>
            </thead>
        @foreach ($personal as $persona)
            <tr>
                <td>{{$persona->name }}</td> <td>{{$persona->email}}</td>
            </tr>
        @endforeach 
        </table>
        
        <table class='table table-bordered'>
            <thead>
            <th> Contacto </th><th> Correo </th><th> Teléfono </th>
            </thead>
        @foreach ($contactos as $contacto)
            <tr>
                <td>{{$contacto->cargo_contacto}}</td>
                <td>{{$contacto->nivel_academico}}</td>
                <td>{{$contacto->nombre }}</td> 
                <td>{{$contacto->correo_institucional}}</td>
                <td>{{$contacto->telefono_institucional}}</td>                
            </tr>
        @endforeach 
        </table>
    </div>                   
</div>
@endsection