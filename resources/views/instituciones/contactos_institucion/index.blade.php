@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Contactos de Institución</div>
                    <div class="panel-body">

                        <a href="{{ url('/instituciones/contactos_institucion/create') }}" class="btn btn-primary btn-xs" title="Agregar nuevo contacto"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
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
                                        <th> Rol </th>                                        
                                        <th> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($contactos_institucion as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->institucion_id }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>{{ $item->correo }}</td>
                                        <td>{{ $item->telefono}}</td>
                                        <td>{{ $item->cargo_contacto}}</td>
                                        <td>{{ $item->activo}}</td>
                                        <td>{{ $item->rol}}</td>                                        
                                        <td>
                                            
                                            <a href="{{ url('/instituciones/contactos_institucion/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Contacto"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/instituciones/contactos_institucion', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Constacto" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete contactos_institucion',
                                                        'onclick'=>'return confirm("Confirm delete?")'
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
