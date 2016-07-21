@extends('app') @section('content')
<div class="container">
    <div class="row">
        <br>
        <center> <h4>Buscar Folio</h4></center>        
        <div class="form-group col-md-offset-5 col-md-4">
            <form action="constancias" method="get">     
                <input name="folio">    
                <button class="btn btn-large btn-success">Buscar</button>
            </form>
        </div>        
        @if (isset($constan))
        
        <div class="col-md-offset-2 col-md-8">
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
        @endif
    </div>
</div>
@endsection
