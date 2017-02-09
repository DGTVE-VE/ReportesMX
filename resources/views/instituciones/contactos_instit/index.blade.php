@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Contactos de Institución</div>
                    <div class="panel-body">

                        <a href="{{ url('/instituciones/contactos_instit/create') }}" class="btn btn-primary btn-xs" title="Agregar nuevo contacto"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Institución</th>
                                        <th> Nombre </th>
                                        <th> Correo </th>
                                        <th> Teléfono</th>
                                        <th> Cargo</th>
                                        <th> Activo</th>
                                        <th> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($contactos_instit as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->institucion_id }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>{{ $item->correo }}</td>
                                        <td>{{ $item->telefono}}</td>
                                        <td>{{ $item->cargo}}</td>
                                        <td>{{ $item->activo}}</td>
                                        <td>
                                            <a href="{{ url('/instituciones/contactos_instit/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Contacto"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/instituciones/contactos_instit/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Contacto"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/instituciones/contactos_instit', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Constacto" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete contactos_instit',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $contactos_instit->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection