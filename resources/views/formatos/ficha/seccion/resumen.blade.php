<div class="tab-pane fade" id="resumen"> <!--bloque resumen-->
    {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store']) !!}
    <input type='hidden' name='seccion' value='resumen'>
    <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
    {{csrf_field()}}
    <div class="form-group col-md-8 col-md-offset-2"><br><br>
        <h3>Resumen del Curso</h3>
        <hr>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <label for="descripcion_corta">Descripción breve del curso:</label>
        <textarea name="descripcion_corta" class="form-control" 
                  id="descripcion_corta" 
                  placeholder="Escribe la descripción breve del Curso">{{$ficha_curso->descripcion_corta}}</textarea>
        <div class="help-tip posicion">
            <p>- Escribir el objetivo específico del Curso.
                <br/>- Limitado a 160 caracteres incluyendo espacios.</p>
        </div>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <label for="acerca_del_curso">Acerca del Curso:</label>
        <textarea name="acerca_del_curso" rows="6" cols="40" class="form-control" 
                  id="acerca_del_curso" placeholder="Escribe la descripción general del Curso">{{$ficha_curso->acerca_del_curso}}</textarea>
        <div class="help-tip posicion">
            <p>- Descripción general del curso.
                <br/>- Se sugieren 2,000 caracteres como máximo.
                <br/>- Forma parte de la página de presentación del Curso (About).</p>
        </div>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <label for="conocimientos_previos">Conocimientos previos:</label>
        <textarea name="conocimientos_previos" class="form-control" 
                  id="conocimientos_previos" placeholder="Especificar si se requieren conocimientos previos del tema">{{$ficha_curso->conocimientos_previos}}</textarea>
        <div class="help-tip posicion">
            <p>- Especificar si se require de algún conocimiento previo, relacionado a la temática del Curso.</p>                
        </div>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <label for="aprendizaje_esperado">Aprendizaje esperado:</label>
        <textarea name="aprendizaje_esperado" rows="3" cols="40" class="form-control" 
                  id="aprendizaje_esperado" placeholder="Describe el resultado esperado al finalizar el Curso">{{$ficha_curso->aprendizaje_esperado}}</textarea>   
        <div class="help-tip posicion">
            <p>- Respónde a la pregunta: ¿qué aprenderé con este curso? 
                <br/>- Breve y conciso. </p>
        </div><br>
    </div>
    <div class="form-group col-md-6 col-md-offset-2">
        <label for="nivel_curso">Nivel del Curso:</label>
        <div class="help-tip posicion">
            <p>- Básico: participantes con formación académica básica.
                <br/>- Intermedio: participantes con formación académica media superior.
                <br/>- Avanzado: participantes con formación académica universitaria.</p>
        </div>
    </div>
    <div class="form-group col-md-8 col-md-offset-2">
        <div class="col-md-9">
            <div class="col-md-2">
                <input type="radio" name="nivel_curso" value="basico" @if($ficha_curso->nivel_curso == 'basico') checked @endif><br/>Básico     
            </div>
            <div class="col-md-2 col-md-offset-2">
                <input type="radio" name="nivel_curso" value="intermedio" @if($ficha_curso->nivel_curso == 'intermedio') checked @endif>Intermedio
            </div>
            <div class="col-md-2 col-md-offset-2">
                <input type="radio" name="nivel_curso" value="avanzado" @if($ficha_curso->nivel_curso == 'avanzado') checked @endif>Avanzado   
            </div>
        </div>
    </div>

    <div class="form-group col-md-8 col-md-offset-2"><br>
        <label for="esfuerzo_horas">Esfuerzo total en horas </label>
        <input name="esfuerzo_horas" type="number" class="form-control" 
               value='{{$ficha_curso->esfuerzo_horas}}'
               id="esfuerzo_horas" min="1" max="10" placeholder="Escribe el esfuerzo estimado en horas">
        <div class="help-tip posicion">
            <p>- Número total de horas por semana que el alumno debe dedicar al curso.</p>
        </div>
    </div>                                
    <div class="form-group col-md-8 col-md-offset-2">
        <label for="calificacion_minima">Calificación mínima aprobatoria</label>
        <input name="calificacion_minima" max="10" min="0" type="number" class="form-control" 
               value='{{$ficha_curso->calificacion_minima}}'
               id='calificacion_minima' placeholder="Especifica la calificación mínima aprobatoria para el Curso">   
        <div class="help-tip posicion">
            <p>- Especificar la calificación mínima aprobatoria para obtener constancia. 
                <br/>- El número debe ser mayor o igual a 6 y menor o igual a 10  </p>
        </div><br>
    </div>


    <div class="form-group col-md-8 col-md-offset-3"><br>
        <div class="col-md-6">
            <label for="id_video">ID del video introductorio</label>
            <input name="id_video" type="text" class="form-control" 
                   id="id_video" placeholder="Escribe los últimos 11 dígitos de la URL"
                   value='{{$ficha_curso->id_video}}'>
            <div class="help-tip posicion">

                <p>-Debe explicar la temática del curso y motivar al usuario 
                    <br/>- El video tiene que estar alojado en "youtube.com" 
                    <br/>- Colocar el ID del video (11 últimos caracteres de la URL)
                    <br>
                    <image src="{{asset('imagenes/help_video_id.PNG')}}" class="img-responsive"> 
                    <br/>- Utilizar elementos gráficos y clips libres de derechos 
                    <br/>- Longitud 30-90 segundos
                    <br/>- Codec: H.264
                    <br/>- Contenedor: .mp4
                    <br/>- Resolución: 1920x1080
                    <br/>- Velocidad de cuadros: 29,97 fps
                    <br/>- Aspecto: 1.0
                    <br/>- Calidad: VBR 5Mbps
                    <br/>- Codec de audio: AAC 44.1KHz / 192Kbps
                    <br/>
                </p>
            </div>
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
</div> <!--fin  bloque resumen-->