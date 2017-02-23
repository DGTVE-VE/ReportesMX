@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-12">
                <h2 class="text-center">Fichas técnicas</h2>
                <a href="{{url ('formatos/ficha_tecnica/create')}}">
                        <button class='btn btn-primary'><i class="fa fa-plus-circle " aria-hidden="true"> </i> Nueva Ficha 
                            </button>
                    </a>
                <div class="panel-body">
                    <table class='table table-responsive table-striped'>
                        <thead>
                            <tr>
                                <th>Institucion</th>
                                <th>Nombre</th>
                                <th>Periodo Emisión</th>
                                <th>Course ID</th>
                                <th>Estado</th>
                                <th>Creo</th>
                                <th>Edito</th>
                                <th>Aprobo</th>
                            </tr>
                        </thead>
                    @foreach ($fichas as $ficha)
                    @if ($ficha->estado == 'aprobada')
                    <tr class='success'>
                    @endif
                    @if ($ficha->estado == 'revision')
                    <tr class='warning'>
                    @endif
                    @if ($ficha->estado == 'edicion')
                    <tr class='active'>
                    @endif
                        <td>
                            {{$ficha->institucion->siglas }}
                        </td>
                        <td>
                            <a href="{{url ('formatos/ficha_tecnica/'.$ficha->id)}}" >{{$ficha->nombre_curso}}</a>
                        </td>
                        <td>
                            {{$ficha->periodo_emision }}
                        </td>
                        <td>
                            {{$ficha->codigo_curso }}
                        </td>
                        <td>
                            {{$ficha->estado }}
                        </td>
                        <td>
                            {{$ficha->creo->name}}
                        </td>
                        <td>
                            @if ($ficha->edito)
                                {{$ficha->edito->name}}
                            @endif
                        </td>
                        <td>
                            @if ($ficha->aprobo)
                                {{$ficha->aprobo->name}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection