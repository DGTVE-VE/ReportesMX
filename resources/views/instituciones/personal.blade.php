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
            <th> Nombre </th><th> Correo</th>
            </thead>
        @foreach ($personal as $persona)
            <tr>
                <td>{{$persona->name }}</td> <td>{{$persona->email}}</td>
            </tr>
        @endforeach 
        </table>
    </div>                   
</div>
@endsection