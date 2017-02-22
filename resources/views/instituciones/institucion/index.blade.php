@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Institución</div>
                    <div class="panel-body">

                        <a href="{{ url('/instituciones/institucion/create') }}" class="btn btn-primary btn-xs" title="Add New institucion"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Id </th><th> Nombre Institución </th><th> Siglas </th><th>Correo MéxicoX</th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($institucion as $item)
                                    <tr>                                       
                                        <td>{{ $item->id }}</td><td>{{ $item->nombre_institucion }}</td><td>{{ $item->siglas }}</td><td>{{ $item->correo_mexicox}}</td>
                                        <td>
                                            <a href="{{ url('/instituciones/institucion/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver institución"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/instituciones/institucion/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar institución"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/instituciones/institucion', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar institución" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Borrar Institución',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}                                          
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $institucion->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection