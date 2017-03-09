@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Banner</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/banner_principal/create') }}" class="btn btn-primary btn-xs" title="Agregar"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Id </th><th> Url Imagen </th><th> Activo </th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banner_principal as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td><td>{{ $item->url_imagen }}</td><td>{{ $item->activo }}</td>
                                        <td>
                                            <a href="{{ url('/admin/banner_principal/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/banner_principal/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/banner_principal', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete banner_principal',
                                                        'onclick'=>'return confirm("Eliminar Elemento")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $banner_principal->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection