@extends('app')

@section('content')
    <div class="container">
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
                                    <tr><th> Id </th><td> {{ $course_name->id }} </td></tr><tr><th> Course Id </th><td> {{ $course_name->course_id }} </td></tr><tr><th> Institucion </th><td> {{ $course_name->institucion }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection