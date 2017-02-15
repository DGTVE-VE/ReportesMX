@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-12">
                <h2 class="text-center">Fichas técnicas</h2>
                <div class="panel-body">
                    <table class='table table-responsive table-striped'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Periodo Emisión</th>
                            </tr>
                        </thead>
                    @foreach ($fichas as $ficha)
                    <tr>
                        <td>
                            <a href="{{url ('formatos/ficha_tecnica/'.$ficha->id)}}" >{{$ficha->nombre_curso}}</a>
                        </td>
                        <td>
                            {{$ficha->periodo_emision }}
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    <a href="{{url ('formatos/ficha_tecnica/create')}}">
                        <button class='btn btn-primary'><i class="fa fa-plus-circle " aria-hidden="true"> </i> Nueva Ficha 
                            </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection