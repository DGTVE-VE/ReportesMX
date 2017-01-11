@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Course_name</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/course_name/create') }}" class="btn btn-primary btn-xs" title="Add New Course_name"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Id </th><th> Course Id </th><th> Course Name </th><th> Inicio </th><th> Fin </th><th> Inicio Inscripcion </th><th> Fin Inscripcion </th><th> Institución </th><th> Activo </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($course_name as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->course_id }}</td><td>{{ $item->course_name }}</td><td>{{ $item->inicio }}</td><td>{{ $item->fin }}</td><td>{{ $item->inicio_inscripcion }}</td><td>{{ $item->fin_inscripcion }}</td><td>{{ $item->institucion }}</td><td>{{ $item->activo }}</td>
                                        <td>
                                            <a href="{{ url('/admin/course_name/' . $item->id) }}" class="btn btn-success btn-xs" title="View Course_name"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/course_name/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Course_name"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/course_name', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Course_name" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Course_name',
                                                        'onclick'=>'return confirm("Confirm delete?")'
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