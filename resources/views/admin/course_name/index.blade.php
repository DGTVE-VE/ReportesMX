@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Course_name</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Id </th><th> Course Id </th><th> Institución </th><th>Nombre de Institución </th><th> Activo </th><th> Constancias </th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($course_name as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->course_id }}</td><td>{{ $item->institucion }}</td><td>{{ $item->nombre_institucion }}</td><td>{{ $item->activo }}</td><td>{{ $item->constancias }}</td>
                                        <td>
                                            <a href="{{ url('/admin/course_name/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Curso"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/course_name/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Curso"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/course_name', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Inactivar Curso" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Inactivar Curso',
                                                        'onclick'=>'return confirm("¿Confirma Inactivar Curso?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $course_name->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection