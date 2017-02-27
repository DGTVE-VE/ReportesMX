<div class="tab-pane fade" id="fechas"> <!--bloque fechas-->
    {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store']) !!}
    <input type='hidden' name='seccion' value='fechas'>
    <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
    {{csrf_field()}}
    <div class="form-group col-md-8 col-md-offset-2"><br>
        <h3>Fechas del Curso</h3>
        <hr>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <div class="col-md-4">
            <label for="fecha_inicio">Inicio del Curso</label><br>
            <input name="fecha_inicio" id='fecha_inicio' type="date" required value="{{$ficha_curso->fecha_inicio}}">
            <div class="help-tip posicion">
                <p>- Sugerimos empezar un día entre semana(martes, miércoles o jueves) 
                    <br/>- Especificar si el curso es a ritmo propio (self-paced)
                    <br/>- Evitar días feriados
                </p>
            </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <label for="fecha_fin">Fin del Curso</label><br>
            <input name="fecha_fin" id="fecha_fin" type="date" value="{{$ficha_curso->fecha_fin}}" required>
            <div class="help-tip posicion">
                <p>- Especificar la fecha en que termina el Curso
                    <br/>- Evitar cualquier cambio de fecha
                </p>
            </div>
        </div>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <div class="col-md-5">
            <label for="fecha_inicio_inscripcion">Inicio de Inscripciones</label><br>                                                    
            <input name="fecha_inicio_inscripcion" id="fecha_inicio_inscripcion" type="date" value="{{$ficha_curso->fecha_inicio_inscripcion}}" required>
            <div class="help-tip posicion">
                <p>- Se recomiendan tres meses de inscripciones como mínimo.</p>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <label for="fecha_fin_inscripcion">Fin de inscripciones</label><br>
            <input name="fecha_fin_inscripcion" id="fecha_fin_inscripcion" type="date" value="{{$ficha_curso->fecha_fin_inscripcion}}" required>
            <div class="help-tip posicion">
                <p>- Se sugiere cerrar inscripciones 8 días después de iniciado el curso.</p>
            </div>
        </div>
    </div><br>
    <div class="form-group col-md-8 col-md-offset-2"><br><br>
        <h3>Idioma del Curso</h3>
        <hr>
    </div>
    <div class="form-group col-md-5 col-md-offset-2">
        <div class="col-md-6">
            <label for="idioma">Idioma del curso</label>
            <select name="idioma" id="idioma">
                <option value="español" @if($ficha_curso->idioma == 'español') selected @endif>Español</option>
                <option value="ingles" @if($ficha_curso->idioma == 'ingles') selected @endif>Inglés</option>
                <option value="italiano" @if($ficha_curso->idioma == 'italiano') selected @endif>Italiano</option>
                <option value="japones" @if($ficha_curso->idioma == 'japones') selected @endif>Japones</option>
                <option value="aleman"  @if($ficha_curso->idioma == 'aleman') selected @endif>Aleman</option>
                <option value="chino" @if($ficha_curso->idioma == 'chino') selected @endif>Chino</option>
                <option value="portugues" @if($ficha_curso->idioma == 'portugues') selected @endif>Portugues</option>
                <option value="otro" @if($ficha_curso->idioma == 'otro') selected @endif>Otro</option>
            </select>
        </div>
        <div class="help-tip posicion">
            <p>- El lenguaje aplica para el contenido, vídeo y transcripciones</p>
        </div>
    </div>
    <br>
    <div class="form-group col-md-8 col-md-offset-2">
        <hr>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <div class="col-md-12 col-md-offset-5">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>
</form>
</div> <!--fin bloque fechas-->