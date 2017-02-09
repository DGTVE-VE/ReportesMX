@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">institucion {{ $institucion->id }}</div>
                <div class="panel-body">

                    <a href="{{ url('instituciones/institucion/' . $institucion->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit institucion"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                    {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['instituciones/institucion', $institucion->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete institucion',
                    'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                    {!! Form::close() !!}
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
<!--                                    <tr>
                                    <th>ID</th><td>{{ $institucion->id }}</td>
                                </tr>-->
                                <tr><th> Id </th>
                                    <td> {{ $institucion->id }} </td>
                                </tr><tr><th> Nombre Institucion </th>
                                    <td> {{ $institucion->nombre_institucion }} </td>
                                </tr>
                                <tr><th> Siglas </th>
                                    <td> {{ $institucion->siglas }} </td>
                                </tr>
                                <tr><th> Correo </th>
                                    <td> {{ $institucion->correo_mexicox }} </td>
                                </tr>                                    
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection