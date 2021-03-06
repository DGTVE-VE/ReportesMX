<div class="tab-pane fade" id="contactos"> <!--bloque contactos-->
    {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store']) !!}
    <input type='hidden' name='seccion' value='contactos'>
    <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
    {{csrf_field()}}
    <div class="form-group col-md-8 col-md-offset-2"><br><br>
        <div class="help-tip posicion">
            <p>- Personas que hacen la gestión con los directivos de la Plataforma MéxicoX </p>
        </div>
        <h3>Contacto de la institución</h3>
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
                               @if($ficha_curso->contactos->contains ($contacto->id))
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
</div> <!--fin bloque contactos-->