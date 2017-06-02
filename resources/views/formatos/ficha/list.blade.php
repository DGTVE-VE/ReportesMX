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
                                @if (Auth::user()->is_superuser)
                                <th>ID</th>
                                @endif
                                <th>Actualizada</th>
                                <th>Institución</th>
                                <th>Nombre</th>
                                <th>Periodo Emisión</th>
                                <th>Course ID</th>
                                <th>Carta Compromiso</th>
                                <th>Estado</th>
                                <th>Creó</th>
                                <th>Editó</th>
                                <th>Aprobó</th>
                            </tr>
                        </thead>
                        @foreach ($fichas as $ficha)
                        @if ($ficha->estado == 'compromiso')
                        <tr class='' style="background-color: #F2F5A9;">
                            @endif
                            @if ($ficha->estado == 'aprobada')
                        <tr class='' style="background-color: #80ff80;"><!--anterior #F5A9A9 -->
                            @endif
                            @if ($ficha->estado == 'revision')
                        <tr class='' style="background-color: #ff8080;"><!--anterior #81BEF7-->
                            @endif
                            @if ($ficha->estado == 'edicion')
                        <tr class='' style="background-color: #ffff80;"><!--anterior #81F79F-->
                            @endif
                            @if (Auth::user()->is_superuser)
                                <td>{{$ficha->id}}</td>
                            @endif
                            <td>
                                {{date_format ($ficha->updated_at, "d/m/Y") }}  
                            </td>
                            <td>
                                @if (!empty($ficha->institucion))
                                {{$ficha->institucion->siglas }}
                                @endif
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
                            <td style='text-align: center;'>
                                @if(File::exists (public_path() .'/cartas/'.$ficha->id.'_compromiso.pdf'))
                                <a href='{{asset('cartas/'.$ficha->id.'_compromiso.pdf?'.time())}}'> 
                                    <i class="fa fa-download" aria-hidden="true"></i> </a>
                                @else
                                <i class="fa fa-times" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td>
                                {{$ficha->estado }}
                            </td>
                            <td>
                                @if (!empty($ficha->creo))
                                {{$ficha->creo->name}}
                                @endif
                            </td>
                            <td>
                                @if (!empty($ficha->edito))
                                {{$ficha->edito->name}}
                                @endif
                            </td>
                            <td>
                                @if (!empty($ficha->aprobo))
                                {{$ficha->aprobo->name}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $fichas->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection