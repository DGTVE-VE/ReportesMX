@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Contacto {{ $contactos_instit->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($contactos_instit, [
                            'method' => 'PATCH',
                            'url' => ['/instituciones/contactos_instit', $contactos_instit->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('instituciones.contactos_instit.form', ['submitButtonText' => 'Actualizar'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection