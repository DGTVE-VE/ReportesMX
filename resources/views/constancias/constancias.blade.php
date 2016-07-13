@extends('app') @section('content')
<div class="container">
    <div class="row">
        <br>
        <center> <h4>Buscar Folio</h4></center>
        <div class="col-md-5"></div>
        <div class="form-group col-md-4">
            <form action="constancias" method="get">     
                <input name="folio">    
                <button class="btn btn-large btn-success">Buscar</button>
            </form>
        </div>
        <div class="col-md-3"></div>
        @if (isset($constan))
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
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
        @else
        <h3>Folio no encontrado</h3>
        @endif
    </div>
</div>
@endsection
