@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-12">
                <h2 class="text-center">¿Cuál es tu institución?</h2>
                <hr>
                <div class="center-block text-center">
                {!! Form::open(['url' => 'usuario/asocia/institucion']) !!}
                {!! Form::select('institucion_id', $instituciones, null, ['class'=>'form-control']) !!}
                {!! Form::submit('Aceptar', ['class'=>'btn btn-success'])!!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 