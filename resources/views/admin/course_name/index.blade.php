@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-8 pull-right">
            <form action="{{url('curso/busqueda')}}" method="GET" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="curso"
                           placeholder="Buscar cursos"> 
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>

        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Course_name
                </div>
                <div class="panel-body">
                    <a href="{{ url('/admin/course_name/create') }}" class="btn btn-primary btn-md" title="Agregar nuevo Course_name"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                    <div class="table-responsive">
                        <table class="table table-borderless" id="tableBusqueda">
                            <thead>
                                <tr>
                                    <th>ID</th><th> Course Id </th><th> Siglas </th><th>Activo</th><th>Constancias</th><th>Reedición</th><th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($course_name as $item)
                                <tr>
                                    <!--<td>{{ $item->id }}</td>-->
                                    <td>{{ $item->id }}</td><td>{{ $item->course_id }}</td><td>{{ $item->institucion }}</td><td>{{ $item->activo }}</td><td>{{ $item->constancias }}</td><td>{{ $item->reedicion }}</td>
                                    <td>
                                        <a href="{{ url('/admin/course_name/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Course_name"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/course_name/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Course_name"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/course_name', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Course_name" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Eliminar Course_name',
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
