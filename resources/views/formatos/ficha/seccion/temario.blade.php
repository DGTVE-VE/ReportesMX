<div class="tab-pane fade" id="temario">  <!--bloque temario-->
    {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
    <input type='hidden' name='seccion' value='temario'>
    <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
    <div class="form-group col-md-8 col-md-offset-2"><br>
        <h3>Contenido Temático del Curso</h3>
        <hr>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <label for="temario">Temario del curso</label>
        <textarea name="temario"  rows="10" cols="40" class="form-control" 
                  id="temario" placeholder="Escribe el temario del Curso">{{$ficha_curso->temario}}</textarea>  
        <div class="help-tip posicion">
            <p>- Ordenar el contenido por secciones, subsecciones y unidades.
                <br/>- Incluir introducción, desarrollo de módulos y ejercicios o evaluaciones </p>
        </div>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <hr>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <div class="col-md-12 col-md-offset-5">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>
</form>    
</div> <!--fin bloque contenido-->