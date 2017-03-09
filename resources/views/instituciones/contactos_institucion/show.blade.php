@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Contacto {{ $contactos_institucion->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('instituciones/contactos_institucion/' . $contactos_institucion->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Contacto"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['instituciones/contactos_institucion', $contactos_institucion->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Eliminar Contacto',
                                    'onclick'=>'return confirm("¿Confirma la eliminación del contacto?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>                                                
                                    <tr><th> Institucion </th>
                                        <td> {{ $contactos_institucion->institucion->siglas }} </td>
                                    </tr>
                                    <tr><th> Nombre </th>
                                        <td> {{ $contactos_institucion->nombre }} </td>
                                    </tr>
                                    <tr><th> Nivel Académico </th>
                                        <td> {{ $contactos_institucion->nivel_academico }} </td>
                                    </tr>
                                    <tr><th> Área de Investigación </th>
                                        <td> {{ $contactos_institucion->area_investigacion }} </td>
                                    </tr>
                                    <tr><th> Biografía Breve </th>
                                        <td> {{ $contactos_institucion->biografia_breve }} </td>
                                    </tr>                                    
                                    <tr><th> Correo Institucional </th>
                                        <td> {{ $contactos_institucion->correo_institucional }} </td>
                                    </tr>
                                    <tr><th> Teléfono Institucional </th>
                                        <td> {{ $contactos_institucion->telefono_institucional }} </td>
                                    </tr>      
                                    <tr><th> Cargo Contacto </th>
                                        <td> {{ $contactos_institucion->cargo_contacto }} </td>
                                    </tr>                                    
                                    <tr><th> Activo </th>
                                        <td>@if ( $contactos_institucion->activo ) <i class="fa fa-check" aria-hidden="true"></i>                                            
                                            @else <i class="fa fa-times" aria-hidden="true"></i>
                                            @endif 
                                        </td>
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