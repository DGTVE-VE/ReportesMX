@extends('app') @section('content')
<div class="container">
    <div class="row">
        <br>
        <center> <h4>Buscar por Folio</h4></center>
        <div class="form-group col-md-offset-5 col-md-4">
            <form action="constancias" method="get">
                <input name="folio">
                <button class="btn btn-large btn-success">Buscar</button>
            </form>
        </div>
        <br>
        <br>
        <center> <h4>Buscar por Correo</h4></center>
        <div class="form-group col-md-offset-5 col-md-4">
            <form action="constancias" method="get">
                <input name="email">
                <button class="btn btn-large btn-warning">Buscar</button>
            </form>
        </div>
        <br>
        <br>
        <br>
        @if (isset($constan))

        <div class="col-md-offset-2 col-md-8">
            <table class="table table-bordered">
                <tr class="success" style="font-size: medium">
                    <td>Folio</td>
                    <td>Nombre</td>
                    <td>Correo</td>
                    <td>Curso</td>
                </tr>
                <tr>
                    <td>{!!$constan['folio']!!}</td>
                    <td>{!!$constan['nombre']!!}</td>
                    <td>{!!$constan['correo']!!}</td>
                    <td>{!!$constan['curso']!!}</td>
                </tr>
            </table>
        </div>
        @endif

        @if (isset($correo))
        <br>
        <div class="col-md-offset-2 col-md-10">
            <table class="table table-bordered">
                <tr class="warning" style="font-size: medium">
                    <td>Nombre</td>
                    <td>Correo</td>
                    <td>Institución</td>
                    <td>Curso</td>
                </tr>
                <?php foreach ($correo as $key => $value): ?>
                <tr>
                  <td>{{$value->nombre}}</td>
                  <td>{{$value->correo}}</td>
                  <td>{{$value->institucion}}</td>
                  <td>{{$value->curso}}</td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
