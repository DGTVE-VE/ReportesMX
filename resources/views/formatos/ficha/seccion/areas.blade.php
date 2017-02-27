<div class="tab-pane fade col-md-offset-1" id="areas"> <!--bloque temática-->
    {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
    <input type='hidden' name='seccion' value='areas'>
    <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
    {{csrf_field()}}
    <div class="form-group col-md-6"><br>
        <h3>Áreas temáticas que cubre el curso</h3>
        <div class="help-tip posicion">
            <p>- Elige tres materias para clasificar tu curso
                <br/>- Este criterio ayudará en la tarea de búsqueda del mismo</p>
        </div>
        <hr>
        @foreach ($categorias as $categoria)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="categorias[]" value='{{$categoria->id}}'
                       @if($ficha_curso->categoria_1 === $categoria->id ||
                       $ficha_curso->categoria_2 === $categoria->id ||
                       $ficha_curso->categoria_3 === $categoria->id
                       )
                       checked
                       @endif
                       /> {{$categoria->categoria}}
            </label>
        </div>
        @endforeach 
    </div>                                
    <div class="form-group col-md-6"><br>
        <h3>Líneas estratégicas</h3>
        <div class="help-tip posicion">
            <p>- Elige tres líneas estratégicas de la Plataforma MéxicoX en las que contribuye el curso </p>
        </div>
        <hr>

        <div class="form-group col-md-12">
            @foreach ($lineasEstrategicas as $linea)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="lineas[]" value='{{$linea->id}}'
                           @if($ficha_curso->linea_estrategica_1 === $linea->id ||
                           $ficha_curso->linea_estrategica_2 === $linea->id ||
                           $ficha_curso->linea_estrategica_3 === $linea->id
                           )
                           checked
                           @endif
                           /> {{$linea->linea_estrategica}}
                </label>
            </div>
            @endforeach 
        </div>

        <div class="form-group col-md-12">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
        </form>    
    </div> 
</div> <!--fin bloque temática-->