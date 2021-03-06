@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Ver Banner {{ $banner_principal->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/banner_principal/' . $banner_principal->id . '/edit') }}" class="btn btn-primary btn-xs" title="Modificar Banner"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/banner_principal', $banner_principal->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Eliminar Banner',
                                    'onclick'=>'return confirm("Eliminar Elemento")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th> Id </th><td> {{ $banner_principal->id }} </td></tr><tr><th> Url Imagen </th><td> {{ $banner_principal->url_imagen }} </td></tr><tr><th> Liga </th><td> {{ $banner_principal->ligaHref }} </td></tr><tr><th> Activo </th><td> {{ $banner_principal->activo }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection