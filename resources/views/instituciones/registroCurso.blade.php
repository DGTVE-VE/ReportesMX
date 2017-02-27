@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-12">
                <h2 class="text-center">Registro de Curso para MéxicoX</h2>
            </div>
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#info_basica" data-toggle="tab">Información Básica</a></li>
                        @if (!empty ($ficha_curso->id))
                        <li><a href="#contactos" data-toggle="tab">Contactos</a></li>
                        <li><a href="#fechas" data-toggle="tab">Calendario</a></li>
                        <li><a href="#resumen" data-toggle="tab">Resumen</a></li>
                        <li><a href="#graficos" data-toggle="tab">Gráficos</a></li>
                        <li><a href="#staff" data-toggle="tab">Staff</a></li>
                        <li><a href="#asesores" data-toggle="tab">Asesores</a></li>
                        <li><a href="#temario" data-toggle="tab">Contenido</a></li>
                        <li><a href="#areas" data-toggle="tab">Áreas</a></li>
                        <li><a href="#cartas" data-toggle="tab">Carta Autorización</a></li>
                        <li><a href="#revision" data-toggle="tab">Revision</a></li>
                        @endif
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="info_basica"> <!--bloque información inicial-->
                            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
                            <input type='hidden' name='seccion' value='info_basica'>
                                {{csrf_field()}}                                  
                                <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <h3>Crear Curso</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="orgazacionName">Nombre de la Institución</label>
                                    <input name="nombre_institucion" type="text" class="form-control" 
                                           placeholder="Escribe el nombre completo de la institución" 
                                           value='{{$institucion->nombre_institucion}}'
                                           readonly>
                                    <input type='hidden' name='id_institucion' value="{{Auth::user()->institucion_id}}">
                                    
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="nombre_curso">Nombre del curso</label>
                                    <input name="nombre_curso" type="text"  max="70" class="form-control" 
                                           id="nombre_curso" placeholder="Escribe el nombre del Curso" 
                                           value='{{$ficha_curso->nombre_curso}}'
                                           required onchange='updateCodigoCurso()'>
                                    <div class="help-tip posicion">
                                        <p>- Longitud: 70 caracteres máximo (con espacios)
                                    </div>
                                </div>  

                                <div class="col-md-3 col-md-offset-2">
                                    <label for="tipo_curso">Tipo de Curso: </label>
                                    {!! Form::select('tipo_curso', $tipo_curso, $ficha_curso->tipo_curso, ['class' => 'form-control'] ) !!}
                                    
                                    <div class="help-tip posicion">
                                        <p>- Curso: Público en general  
                                            <br/>- SPOC: Por invitación 
                                            <br/>- Diplomado  
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="num_edicion">Número de Edición</label>
                                    {!! Form::select('num_edicion', ['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'], $ficha_curso->num_edicion, ['class' => 'form-control', 'id'=>'num_edicion'] ) !!}
                                    
                                    <div class="help-tip posicion">
                                        <p>- Número consecutivo de la emisión del curso en el año </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="periodo_emision">Periodo de emisión</label>
                                    <!--<input name="periodoEmi" type="text" class="form-control" placeholder="Escribe el periodo de emisión" required>-->
                                    <input name='periodo_emision' id='periodo_emision' type="month" onchange='updateCodigoCurso()' class="form-control"
                                           value='{{$ficha_curso->periodo_emision}}'>
                                    <div class="help-tip posicion">
                                        <p>- Mes de inicio del curso </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-md-offset-2">
                                    <label for="codigo_curso">Código del curso</label><br>
                                    <input type='text'  class="text-success text-uppercase form-control"  id='codigo_curso' 
                                           value='{{$ficha_curso->codigo_curso}}'
                                           name='codigo_curso'  readonly>
                                </div>  
                                <div class="col-md-6 col-md-offset-2">                                        
                                        <label for="carta_compromiso">Carta compromiso</label>
                                        <a href="{{asset('download/carta_com.docx')}}"> (Formato para Carta Compromiso) </a>
                                        <label class="file">
                                            <input class="form-control" name="carta_compromiso" type="file" accept="application/pdf" id="carta_compromiso">
                                            <span class="file-custom"></span>                
                                        </label>
                                        <div class="help-tip posicion">
                                            <p>- Sube la carta conmpromiso debidamente requisitada y firmada</p>
                                        </div>                                                                                    
                                    </div>
                                <div class="col-md-2">
                                    @if(File::exists (public_path() .'/cartas/'.$ficha_curso->id.'_compromiso.pdf'))
                                            <a href='{{asset('cartas/'.$ficha_curso->id.'_compromiso.pdf?'.time())}}'> <i class="fa fa-download fa-3x" aria-hidden="true"></i> </a>
                                            @endif
                                </div>
                                @if (!empty ($ficha_curso->id))
                                <input type="hidden" name='id' id='id' value='{{$ficha_curso->id}}'>
                                @endif
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <div class="col-md-12 col-md-offset-5">
                                        <button type="submit" class="btn btn-success ">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!--fin bloque información inicial-->

                        @if (!empty ($ficha_curso->id))
                        <div class="tab-pane fade" id="contactos"> <!--bloque contactos-->
                            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store']) !!}
                                <input type='hidden' name='seccion' value='contactos'>
                                <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br><br>
                                    <div class="help-tip posicion">
                                        <p>- Usuarios que servirán de contacto a los usuarios para soporte </p>
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
                                    <label for="descripcion_corta">Descripción breve del curso</label>
                                    <textarea name="descripcion_corta" class="form-control" 
                                              id="descripcion_corta" 
                                              placeholder="Escribe la descripción breve del Curso">{{$ficha_curso->descripcion_corta}}</textarea>
                                    <div class="help-tip posicion">
                                        <p>- Objetivo específico del Curso
                                            <br/>- Limitado a 160 caracteres incluyendo espacios</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="acerca_del_curso">Acerca del Curso</label>
                                    <textarea name="acerca_del_curso" rows="6" cols="40" class="form-control" 
                                              id="acerca_del_curso" placeholder="Escribe la descripción general del Curso">{{$ficha_curso->acerca_del_curso}}</textarea>
                                    <div class="help-tip posicion">
                                        <p>- Descripción general del curso.
                                            <br/>- Conforma la página de presentación del Curso (About)
                                            <br/>- Se sugieren 2,000 caracteres como máximo</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="conocimientos_previos">Conocimientos previos</label>
                                    <textarea name="conocimientos_previos" class="form-control" 
                                              id="conocimientos_previos" placeholder="Especificar si se requieren conocimientos previos del tema">{{$ficha_curso->conocimientos_previos}}</textarea>
                                    <div class="help-tip posicion">
                                        <p>- Especificar si se require de algún conocimiento previo relacionado al Curso</p>                
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="aprendizaje_esperado">Aprendizaje esperado</label>
                                    <textarea name="aprendizaje_esperado" rows="3" cols="40" class="form-control" 
                                              id="aprendizaje_esperado" placeholder="Describe el resultado esperado al finalizar el Curso">{{$ficha_curso->aprendizaje_esperado}}</textarea>   
                                    <div class="help-tip posicion">
                                        <p>- Respóndete a esta pregunta: ¿qué aprenderé con este curso? 
                                            <br/>- Breve y conciso </p>
                                    </div><br>
                                </div>
                                <div class="form-group col-md-6 col-md-offset-2">
                                    <label for="nivel_curso">Nivel del Curso</label>
                                    <div class="help-tip posicion">
                                        <p>- Básico: participantes con formación académica básica
                                            <br/>- Intermedio: participantes con formación académica media superior
                                            <br/>- Avanzado: participantes con formación académica universitaria</p>
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
                                        <p>- Número total de horas que el alumno debe dedicar al curso</p>
                                    </div>
                                </div>                                
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="calificacion_minima">Calificación mínima aprobatoria</label>
                                    <input name="calificacion_minima" max="10" min="0" type="number" class="form-control" 
                                           value='{{$ficha_curso->calificacion_minima}}'
                                           id='calificacion_minima' placeholder="Especifica la calificación mínima aprobatoria para el Curso">   
                                    <div class="help-tip posicion">
                                        <p>- Especificar la calificación mínima aprobatoria para obtener constancia 
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

                        <div class="tab-pane fade" id="graficos"> <!--bloque gráficos-->
                            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
                            <input type='hidden' name='seccion' value='graficos'>
                            <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
                             <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <div class="col-md-6">
                                        <label for="imagen_cuadrada">Imagen cuadrada del curso (150x150 px)</label><br><br>
                                        <label class="file" class='form-control'>
                                            <input name="imagen_cuadrada" type="file" 
                                                   id='imagen_cuadrada'
                                                   class='form-control'>
                                            <output id="imagen_cuadrada_preview">                                                
                                                @if(File::exists (public_path() .'/imagenes/cursos/'.$ficha_curso->id.'_c.jpg'))                                                    
                                                    <img class='thumbnail-image' width='100px' src='{{asset('imagenes/cursos/'.$ficha_curso->id.'_c.jpg?'.time())}}'/>
                                                @endif
                                            </output>
                                            
                                        </label><br>
                                        <div class="help-tip posicion" style="align: left;">
                                            <p>- Imagen que describa el curso.
                                                <br/>- La imagen debe ser diseñada expresamente para el curso o tener derechos como ( Flickr creative commons, Stock Vault, Stock XCHNG, iStock Photo)
                                                <br/>- Cursos secuenciados deberán tener una sola imagen
                                                <br/>- Tamaño: 378 x 225 pixeles
                                                <br/>- Tipo de arhivo: *.jpg</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="imagen_rectangular">Imagen rectangular del curso (378x225 px)</label><br><br>
                                        <label class="file" class='form-control'>
                                            <input name="imagen_rectangular" type="file" 
                                                   id="imagen_rectangular" class='form-control'>
                                            <output id="imagen_rectangular_preview">
                                                @if(File::exists (public_path() .'/imagenes/cursos/'.$ficha_curso->id.'_r.jpg'))                                                    
                                                    <img class='thumbnail-image' width='100px' src='{{asset('imagenes/cursos/'.$ficha_curso->id.'_r.jpg?'.time())}}'/>
                                                @endif
                                            </output>
                                        </label><br>
                                        <div class="help-tip posicion" style="align: left;">
                                            <p>- Imagen que describa el curso.
                                                <br/>- La imagen debe ser diseñada expresamente para el curso o tener derechos como ( Flickr creative commons, Stock Vault, Stock XCHNG, iStock Photo)
                                                <br/>- Cursos secuenciados deberán tener una sola imagen
                                                <br/>- Tamaño: 378 x 225 pixeles
                                                <br/>- Tipo de arhivo: *.jpg</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="imagen_promocional">Banner promocional del curso (1900x400 px)</label><br><br>
                                        <label class="file" class='form-control'>
                                            <input name="imagen_promocional" type="file" 
                                                   id="imagen_promocional" class='form-control'>
                                            <output id="imagen_promocional_preview">
                                                @if(File::exists (public_path() .'/imagenes/cursos/'.$ficha_curso->id.'_p.jpg'))                                                    
                                                    <img class='thumbnail-image' width='100px' src='{{asset('imagenes/cursos/'.$ficha_curso->id.'_p.jpg?'.time())}}'/>
                                                @endif
                                            </output>
                                        </label><br>
                                        <div class="help-tip posicion" style="align: left;">
                                            <p>- Imagen que describa el curso.
                                                <br/>- La imagen debe ser diseñada expresamente para el curso o tener derechos como ( Flickr creative commons, Stock Vault, Stock XCHNG, iStock Photo)
                                                <br/>- Cursos secuenciados deberán tener una sola imagen
                                                <br/>- Tamaño: 378 x 225 pixeles
                                                <br/>- Tipo de arhivo: *.jpg</p>
                                        </div>
                                    </div>
                                 <button class="btn btn-primary" type="submit">
                                     Guardar
                                 </button>
                                </div>
                            {!! Form::close() !!}
                         </div>    
                        
                        <div class="tab-pane fade" id="staff"> <!--bloque staff-->
                            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
                            <input type='hidden' name='seccion' value='staff'>
                            <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br><br>
                                    <h3>STAFF del curso</h3>
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
                                                        @if($ficha_curso->staff->contains ($contacto->id))
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
                        </div> <!--fin  bloque staff-->

                        <div class="tab-pane fade" id="asesores"> <!--bloque asesores-->
                            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
                            <input type='hidden' name='seccion' value='asesores'>
                            <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br><br>
                                    <h3>Seleccione las personas que aparecerán en las constancias</h3>
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
                                        <p>- Ordenar el contenido por semanas, unidades, módulos o temas.
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

                        <div class="tab-pane fade" id="cartas"> <!--bloque archivos-->
                            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
                            <input type='hidden' name='seccion' value='cartas'>
                            <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <h3>Descargar archivos</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <div class="col-md-5">
                                        <div class="help-tip posicion">
                                            <p>- Descarga la carta de autorización para la emisión del Curso en la plataforma MéxicoX</p>
                                        </div>
                                        <a href="{{asset('download/carta_aut.docx')}}"><button type="button" class="btn btn-primary btn-md">Carta Autorización</button></a>
                                    </div>                                    
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <h3>Subir archivos firmados</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <div class="col-md-4">
                                        <div class="help-tip posicion">
                                            <p>- Sube la carta de autorización debidamente requisitada y firmada</p>
                                        </div>
                                        <label for="carta_autorizacion">Carta Autorización</label><br><br>
                                            <label class="file">
                                            <input class="form-control" name="carta_autorizacion" type="file" accept="application/pdf" id="carta_autorizacion">
                                            </label><br>
                                            @if(File::exists (public_path() .'/cartas/'.$ficha_curso->id.'_autorizacion.pdf'))
                                            <a href='{{asset('cartas/'.$ficha_curso->id.'_autorizacion.pdf?'.time())}}'> <i class="fa fa-download fa-3x" aria-hidden="true"></i></a>
                                            @endif
                                            
                                        
                                    </div>
                                    
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <div class="col-md-10 ">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>                                    
                                </div>
                            </form>    
                        </div><!--fin bloque archivos-->
                        <div class="tab-pane fade" id="revision"> <!--bloque archivos-->
                            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
                            <input type='hidden' name='seccion' value='revision'>
                            <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
                            <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <h3>Enviar a revisión</h3>
                                    <hr>
                                    <strong> Una vez enviada a revisión la ficha ya no podrá ser editada. </strong> <br>
                                    Toma en cuenta esto antes de enviarla.
                                </div>
                            <div class="form-group col-md-8 col-md-offset-2">
                            
                                <div class="col-md-10 ">
                                    <button type="submit" class="btn btn-success">Enviar a revisión</button>
                                </div>
                            </div>
                            </form>
                            @if (Auth::user()->is_superuser)
                            <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <h3>Aprobar para apertura</h3>
                                    <hr>
                                    
                                </div>
                            <div class="form-group col-md-8 col-md-offset-2">
                            
                            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
                            <input type='hidden' name='seccion' value='aprobar'>
                            <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
                                <div class="col-md-10 ">
                                    <button type="submit" class="btn btn-primary">Aprobar para apertura</button>
                                </div>
                            </form>
                            </div>
                            @endif
                            
                        </div>
                        @endif
                    </div> <!--cierra tab-content-->                    
                </div> <!--cierra panel-body-->
            </div><!--cierra panel-info-->
        </div> <!--cierra col 12-->
    </div> <!--cierra row-->
</div> <!--cierra div container-->

@endsection


@section ('scripts')
<script>
    /**
     * Previsualiza las imágenes antes de mandarlas al formulario
     * 
     * @param {Event} evt Evento change del <input file>
     * @param {String} id_preview id del componente que visualizará la imagen
     * @returns {function} regresa la visualización de la imagen
     */
    function preview (evt, id_preview) {      
        var files = evt.target.files; // FileList object
               
        for (var i = 0, f; f = files[i]; i++) {                    
            if (f.type.match('image.*')) {           
                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {                    
                           document.getElementById(id_preview).innerHTML = 
                                    ['<img class="thumb" width="100px" src="', 
                                    e.target.result,
                                    '" title="', escape(theFile.name), '"/>'].join('');
                    };
                })(f);

                reader.readAsDataURL(f);
            }
       }
    }
             
      
    function updateCodigoCurso (){
        var iniciales = getIniciales ().toUpperCase();
        var periodo = getPeriodo ();
        var edicion = $("#num_edicion").val();
        console.log ("edicion:"+edicion);
        $("#codigo_curso").val (iniciales+periodo+edicion+'x');
        
    }
    
    function getPeriodo (){
        var periodo = $('#periodo_emision').val ();
        var tokens = periodo.split('-');
        console.log (tokens);
        console.log (tokens[0].toString().substr(2,2));
        return (tokens[0].toString().substr(2,2) + tokens[1]);
    }
    
    function getIniciales (){
        var nombre = $('#nombre_curso').val ();
        var palabras = nombre.split (' ');
        console.log (palabras.length);
        if (palabras.length === 1){
            return palabras[0].substring (0, 4);
        }
        if (palabras.length === 2){
            return palabras[0].substring (0, 2)+palabras[1].substring (0, 2);
        }
        if (palabras.length === 3){
            return palabras[0].substring (0, 2)+palabras[1].substring (0, 1)
            +palabras[2].substring (0, 1);
        }
        if (palabras.length > 3){
            return palabras[0].substring (0, 1)+palabras[1].substring (0, 1)
            +palabras[2].substring (0, 1)+palabras[3].substring (0, 1);
        }
    }
    
    
    $(document).ready(function () {
        document.getElementById('imagen_cuadrada').addEventListener('change', function(evt){
            preview (evt, 'imagen_cuadrada_preview');
        }, false);
        
        document.getElementById('imagen_rectangular').addEventListener('change', function(evt){
            preview (evt, 'imagen_rectangular_preview');
        }, false);
        
        document.getElementById('imagen_promocional').addEventListener('change', function(evt){
            preview (evt, 'imagen_promocional_preview');
        }, false);
        //('.nav-tabs a[href="#{{$seccion}}"]').tab('show');
        
        // Si la ficha es nueva, el mes inicia en el actual
        @if (empty ($ficha_curso->id)) 
        var today = new Date();
        
        var guion = '-';
        if (today.getMonth() < 10)
            guion += '0';
        var fecha = today.getFullYear()+guion+(today.getMonth()+1);
        
        $('#periodo_emision').val (fecha);
        @endif
        
        @if ($ficha_curso->estado != 'edicion' && ! Auth::user()->is_superuser)
            $(':button').prop('disabled', true); 
        @endif
//        inst = 1;
//        num = 1;
//        $("#quitaInst" + num).click(function () {
//            event.preventDefault();
//            alert("Al menos debe haber un instructor para el curso");
//        });
//        $("#otroIns").click(function () {
//            num++;
//            event.preventDefault();
//            $("#instructor").clone().prop('id', 'inst' + num).appendTo("#instructores");
//            $("#inst" + num).find("#quitaInst1").prop('id', 'quitaInst' + num);
//
//            $("#quitaInst" + num).click(function () {
//                event.preventDefault();
//                alert(this.id);
//                $("#inst" + num).remove();
//                num--;
//            });
//        });
    });
</script>
<script>
    //arrastrar elementos               
//    function dragStart(event) {
//        event.dataTransfer.setData("Text", event.target.id);
//
//    }
//
//    //    function dragging(event) {
//    //        document.getElementById("demo").innerHTML = "The p element is being dragged";
//    //    }
//
//    function allowDrop(event) {
//        event.preventDefault();
//    }
//
//    var categorias = new Array();
//    categorias['Programas y certificaciones génericos'] = 1;
//    categorias['Educación'] = 2;
//    categorias['Artes y humanidades'] = 3;
//    categorias['Ciencias sociales, periodismo e información'] = 4;
//    categorias['Administración de empresas y derecho'] = 5;
//    categorias['Ciencias naturales, matemáticas y estadística'] = 6;
//    categorias['Tecnologías de la información y la comunicación'] = 7;
//    categorias['Ingeniería,industría y construcción'] = 8;
//    categorias['Agricultura, silvicultura, pesca y veterinaria'] = 9;
//    categorias['Salud y bienestar'] = 10;
//    categorias['Servicios'] = 11;
//
//
//    function drop(event) {
//        numero = $('#cont2').children().length;
//        if (numero < 3 || event.target === document.getElementById('cont1')) {
//            event.preventDefault();
//            var data = event.dataTransfer.getData("Text");
//            event.target.appendChild(document.getElementById(data));
//        }
//
//        count = $('#cont2').children().length;
//        //alert("el div2 tiene: " + count);
//        var values = [];
//        $('#cont2').children().each(function () {
//
//            if (numero === 2) {
//                //                console.log($(this).html()); 
//                values.push($(this).html());
//            }
//
//        });
//
//        if (numero === 2) {
//            $('#categoria1').attr('value', '' + categorias[values[0]]);
//            console.log(categorias[values[0]]);
//            $('#categoria2').attr('value', '' + categorias[values[1]]);
//            console.log(categorias[values[1]]);
//            $('#categoria3').attr('value', '' + categorias[values[2]]);
//            console.log(categorias[values[2]]);
//        }
//    }

</script>

@endsection



