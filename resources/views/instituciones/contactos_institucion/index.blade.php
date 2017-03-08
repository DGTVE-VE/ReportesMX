@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Contactos Institución</div>
                    <div class="panel-body">

                        <a href="{{ url('/instituciones/contactos_institucion/create') }}" class="btn btn-primary btn-xs" title="Add New Contactos_institucion"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Institución Id </th><th> Nombre </th><th>Correo</th><th>Teléfono</th><th>Cargo</th><th>Activo</th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($contactos_institucion as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->institucion_id }}</td><td>{{ $item->nombre }}</td><td>{{ $item->correo_institucional }}</td><td>{{ $item->telefono_institucional }}</td><td>{{ $item->cargo_contacto }}</td><td>{{ $item->activo }}</td>
                                        <td>
                                            <a href="{{ url('/instituciones/contactos_institucion/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Contacto"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/instituciones/contactos_institucion/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Contacto"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/instituciones/contactos_institucion', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Contactos_institucion" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Eliminar Contacto',
                                                        'onclick'=>'return confirm("Confirma Eliminar el Contacto?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $contactos_institucion->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection