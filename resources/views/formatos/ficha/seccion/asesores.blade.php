<div class="tab-pane fade" id="asesores"> <!--bloque asesores-->
    {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
    <input type='hidden' name='seccion' value='asesores'>
    <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
    {{csrf_field()}}
    <div class="form-group col-md-8 col-md-offset-2"><br><br>
        <div class="help-tip posicion">
            <p>- Seleccione las personas que aparecerán en las constancias.
            <br/> - Pueden ser hasta 4 personas.
            </p>
        </div>        
        <h3>Asesores que aparecerán en las constancias</h3>
        <h5>(Hasta 4 asesores o colaboradores del Curso)</h5>
        <hr>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <table id="contactos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tbody>                                            
                @foreach ($contactos as $contacto)
                <tr>
                    <td>{{$contacto->id}}</td>
                    <td>{{$contacto->nombre}}</td>
                    <td><input type="checkbox" name="contactos[]" value='{{$contacto->id}}'

                               @if($ficha_curso->asesores->contains ($contacto->id))
                               checked
                               @endif
                               /></td>          
                </tr>
                @endforeach                                                                                            
            </tbody>
        </table>
    </div>                               
    <div class="form-group col-md-8 col-md-offset-2">
        <div class="col-md-12 col-md-offset-5">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>
</form>    
</div>  <!--fin bloque constancias-->