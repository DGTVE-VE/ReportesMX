@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Course_name {{ $course_name->id }}</div>
                <div class="panel-body">

                    <a href="{{ url('admin/course_name/' . $course_name->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Course_name"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                    {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/course_name', $course_name->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Course_name',
                    'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                    {!! Form::close() !!}
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $course_name->id }}</td>
                                </tr>
                                <tr>
                                    <th> Id </th>
                                    <td> {{ $course_name->id }} </td>
                                </tr>
                                <tr>
                                    <th> Course Id </th>
                                    <td> {{ $course_name->course_id }} </td>
                                </tr>
                                <tr>
                                    <th> Course Name </th>
                                    <td> {{ $course_name->course_name }} </td>
                                </tr>
                                <tr>
                                    <th>Inicio</th>
                                    <td>{{ $course_name->inicio}}</td>
                                </tr>
                                <tr>
                                    <th>Fin</th>
                                    <td>{{ $course_name->fin}}</td>
                                </tr>
                                <tr>
                                    <th>Inicio Inscripción</th>
                                    <td>{{ $course_name->inicio_inscripcion}}</td>
                                </tr>
                                <tr>
                                    <th>FIn Inscripción</th>
                                    <td>{{ $course_name->fin_inscripcion}}</td>
                                </tr>
                                <tr>
                                    <th>Descripcion</th>
                                    <td>{{ $course_name->descripcion}}</td>
                                </tr>
                                <tr>
                                    <th>Thumbnail</th>
                                    <td>{{ $course_name->thumbnail}}</td>
                                </tr>
                                                                <tr>
                                    <th>Institucion</th>
                                    <td>{{ $course_name->institucion}}</td>
                                </tr>
                                <tr>
                                    <th>Activo</th>
                                    <td>{{ $course_name->activo}}</td>
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