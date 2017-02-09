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
                        <li class="active"><a href="#infBasica" data-toggle="tab">Información Básica</a></li>
                        <li><a href="#contactos" data-toggle="tab">contactos</a></li>
                        <li><a href="#fechas" data-toggle="tab">Calendario</a></li>
                        <li><a href="#resumen" data-toggle="tab">Resumen</a></li>
                        <li><a href="#staff" data-toggle="tab">Staff</a></li>
                        <li><a href="#constancias" data-toggle="tab">Constancias</a></li>
                        <li><a href="#contenido" data-toggle="tab">Contenido</a></li>
                        <li><a href="#tematica" data-toggle="tab">Temática</a></li>
                        <li><a href="#archivos" data-toggle="tab">Archivos</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="infBasica"> <!--bloque información inicial-->
                            <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
                                {{csrf_field()}}                                  
                                <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <h3>Crear Curso</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="orgazacionName">Nombre de la Institución</label>
                                    <!--<input name="nombreOrganizacion" type="text" class="form-control" placeholder="Escribe el nombre completo de la institución" required>-->
                                    <select name="nombreOrganizacion">
                                        <option>Tecnológico de Monterrey</option>
                                    </select>
                                    <label class="text-success text-uppercase">jala de tabla</label>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="curseName">Nombre del curso</label>
                                    <input name="nombreCurso" type="text"  max="70" class="form-control" id="curseName" placeholder="Escribe el nombre del Curso" required>
                                    <div class="help-tip posicion">
                                        <p>- Longitud: 70 caracteres máximo (con espacios)
                                    </div>
                                </div>  

                                <div class="col-md-3 col-md-offset-2">
                                    <label for="typeCurso">Tipo de Curso: </label>
                                    <select name="tipoCurso">
                                        <option value="mooc">Curso</option>
                                        <option value="spoc">SPOC</option>
                                        <option value="diplomado">Diplomado</option>
                                    </select>
                                    <div class="help-tip posicion">
                                        <p>- Curso: Público en general  
                                            <br/>- SPOC: Por invitación 
                                            <br/>- Diplomado  
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="numEmision">Número de Edición</label>
                                    <select name="emisionCurso">
                                        <option value="1">1ra.</option>
                                        <option value="2">2da.</option>
                                        <option value="3">3ra.</option>
                                        <option value="4">4ta.</option>
                                        <option value="5">5ta.</option>
                                    </select>
                                    <div class="help-tip posicion">
                                        <p>- Número de emisión del Curso</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="periodoEmision">Mes de emisión</label>
                                    <!--<input name="periodoEmi" type="text" class="form-control" placeholder="Escribe el periodo de emisión" required>-->
                                    <select name="periodoEmi">
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>                                                
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-md-offset-2">
                                    <label for="codeCurse">Código del curso</label><br>
                                    <label class="text-success text-uppercase">autogenera</label>
                                </div>                                        
                                <div class="form-group col-md-4 col-md-offset-2">
                                    <label for="codeCurse">Periodo de emisión</label><br>
                                    <label class="text-success text-uppercase">autogenera</label>
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
                        </div> <!--fin bloque información inicial-->

                        <div class="tab-pane fade" id="contactos"> <!--bloque contactos-->
                            <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br><br>
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
                                                <td><input type="checkbox" name="checkbox"/></td>          
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
                            <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <h3>Fechas del Curso</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <div class="col-md-4">
                                        <label for="fechaInicio">Fecha de inicio del Curso</label><br>
                                        <input name="fechaIni" type="date" required>
                                        <div class="help-tip posicion">
                                            <p>- Sugerimos empezar un día entre semana(martes, miércoles o jueves) 
                                                <br/>- Especificar si el curso es a ritmo propio (self-paced)
                                                <br/>- Evitar días feriados
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <label for="fechaFinal">Fecha final del Curso</label><br>
                                        <input name="fechaFin" type="date" required>
                                        <div class="help-tip posicion">
                                            <p>- Especificar la fecha en que termina el Curso
                                                <br/>- Evitar cualquier cambio de fecha
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <div class="col-md-5">
                                        <label for="fechaInscripciones">Fecha de inicio de Inscripciones</label><br>
                                        <input name="fechaLan" type="date" required>
                                        <div class="help-tip posicion">
                                            <p>- Se recomiendan tres meses de inscripciones como mínimo.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <label for="fechaFinInsc">Fecha de final de inscripciones</label><br>
                                        <input name="fechaEmi" type="date" required>
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
                                        <label for="contentLanguage">Idioma del curso</label>
                                        <select name="lenguajeCont">
                                            <option value="español">Español</option>
                                            <option value="ingles">Inglés</option>
                                            <option value="italiano">Italiano</option>
                                            <option value="japones">Japones</option>
                                            <option value="aleman">Aleman</option>
                                            <option value="chino">Chino</option>
                                            <option value="portugues">Portugues</option>
                                            <option value="otro">Otro</option>
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
                            <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br><br>
                                    <h3>Resumen del Curso</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="courseDescriptionShort">Descripción breve del curso</label>
                                    <textarea name="desCorta" class="form-control" id="courseDescriptionShort" placeholder="Escribe la descripción breve del Curso"></textarea>
                                    <div class="help-tip posicion">
                                        <p>- Objetivo específico del Curso
                                            <br/>- Limitado a 160 caracteres incluyendo espacios</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="courseDescriptionLong">Acerca del Curso</label>
                                    <textarea name="desLarga" rows="6" cols="40" class="form-control" id="courseDescriptionLong" placeholder="Escribe la descripción general del Curso"></textarea>
                                    <div class="help-tip posicion">
                                        <p>- Descripción general del curso.
                                            <br/>- Conforma la página de presentación del Curso (About)
                                            <br/>- Se sugieren 2,000 caracteres como máximo</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="requirements">Conocimientos previos</label>
                                    <textarea name="requisitos" class="form-control" id="courseRequirements" placeholder="Especificar si se requieren conocimientos previos del tema"></textarea>
                                    <div class="help-tip posicion">
                                        <p>- Especificar si se require de algún conocimiento previo relacionado al Curso</p>                
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="courseResults">Aprendizaje esperado</label>
                                    <textarea name="resApren" rows="3" cols="40" class="form-control" id="courseResults" placeholder="Describe el resultado esperado al finalizar el Curso"></textarea>   
                                    <div class="help-tip posicion">
                                        <p>- Respóndete a esta pregunta: ¿qué aprenderé con este curso? 
                                            <br/>- Breve y conciso </p>
                                    </div><br>
                                </div>
                                <div class="form-group col-md-6 col-md-offset-2">
                                    <label for="nivelCourse">Nivel del Curso</label>
                                    <div class="help-tip posicion">
                                        <p>- Básico: participantes con formación académica básica
                                            <br/>- Intermedio: participantes con formación académica media superior
                                            <br/>- Avanzado: participantes con formación académica universitaria</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <div class="col-md-9">
                                        <div class="col-md-2">
                                            <input type="radio" name="level" value="basico" checked><br/>Básico     
                                        </div>
                                        <div class="col-md-2 col-md-offset-2">
                                            <input type="radio" name="level" value="intermedio">Intermedio
                                        </div>
                                        <div class="col-md-2 col-md-offset-2">
                                            <input type="radio" name="level" value="avanzado">Avanzado   
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <label for="esfuerzoRequerido">Esfuerzo total en horas </label>
                                    <input name="esfuerzoReq" type="number" class="form-control" name="quantity" min="1" max="10" placeholder="Escribe el esfuerzo estimado en horas">
                                    <div class="help-tip posicion">
                                        <p>- Número total de horas que el alumno debe dedicar al curso</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <label for="duracionSem">Duración total del Curso</label>
                                    <input name="duracionCurso" type="number" class="form-control" name="quantity" min="1" max="15" placeholder="Escribe la duración del curso en número de semanas">
                                    <div class="help-tip posicion">
                                        <p>- Número de semanas en las que se impartirá el curso</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="califConstancia">Calificación mínima aprobatoria</label>
                                    <input name="rangoCalificacion" max="10" min="0" type="number" class="form-control" placeholder="Especifica la calificación mínima aprobatoria para el Curso">   
                                    <div class="help-tip posicion">
                                        <p>- Especificar la calificación mínima aprobatoria para obtener constancia 
                                            <br/>- El número debe ser mayor o igual a 6 y menor o igual a 10  </p>
                                    </div><br>
                                </div>
                               
                                <div class="form-group col-md-8 col-md-offset-3"><br>
                                    <div class="col-md-6">
                                        <label for="addImagen">Añadir imagen del curso</label><br><br>
                                        <label class="file">
                                            <input name="imagenCurso" type="file">
                                            <span class="file-custom"></span>
                                        </label><br>
                                        <div class="help-tip posicion" style="align: left;">
                                            <p>- Imagen que describa el curso.
                                                <br/>- La imagen debe ser diseñada expresamente para el curso o tener derechos como ( Flickr creative commons, Stock Vault, Stock XCHNG, iStock Photo)
                                                <br/>- Cursos secuenciados deberán tener una sola imagen
                                                <br/>- Tamaño: 378 x 225 pixeles
                                                <br/>- Tipo de arhivo: *.jpg</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-3"><br>
                                    <div class="col-md-6">
                                        <label for="addVideo">Añadir ID del video introductorio</label>
                                        <input name="videoId" type="text" class="form-control" placeholder="Escribe los últimos 11 dígitos de la URL">
                                        <div class="help-tip posicion">
                                            <p>- Debe explicar la temática del curso y motivar al usuario 
                                                <br/>- El video tiene que estar alojado en "youtube.com" 
                                                <br/>- Colocar el ID del video (11 últimos caracteres de la URL)
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

                        <div class="tab-pane fade" id="staff"> <!--bloque staff-->
                            <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br><br>
                                    <h3>STAFF del curso</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <table id="staff" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <tbody>
                                            @foreach ($staffs as $staff)
                                            <tr>
                                                <td>{{$staff->id}}</td>
                                                <td>{{$staff->nombre}}</td>
                                                <td><input type="checkbox" name="checkbox"/></td>                                                    
                                            </tr>
                                            @endforeach                                                  
                                        </tbody>
                                    </table>
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
                        </div> <!--fin  bloque staff-->

                        <div class="tab-pane fade" id="constancias"> <!--bloque constancias-->
                            <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br><br>
                                    <h3>Seleccione las personas que aparecerán en las constancias</h3>
                                    <h5>(Hasta 4 asesores o colaboradores del Curso)</h5>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <table id="colaboradores" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <tbody>
                                            @foreach ($asesores as $asesor)
                                            <tr>
                                                <td>{{$asesor->id}}</td>
                                                <td>{{$asesor->nombre}}</td>
                                                <td><input type="checkbox" name="checkbox"/></td>                                                    
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

                        <div class="tab-pane fade" id="contenido">  <!--bloque contenido-->
                            <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <h3>Contenido Temático del Curso</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <label for="temarioCurse">Temario del curso</label>
                                    <textarea name="temario"  rows="10" cols="40" class="form-control" id="courseTemario" placeholder="Escribe el temario del Curso"></textarea>  
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

                        <div class="tab-pane fade col-md-offset-2" id="tematica"> <!--bloque temática-->
                            <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group col-md-12"><br>
                                    <h3>Áreas temáticas que cubre el curso</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-11">
                                        <p>Arrastra tres materias para clasificar el curso y ordena por jerarquía. Esto ayudará al alumno a buscar el curso por materia.</p>
                                    </div> <br>
                                    <div class="col-md-1">
                                        <div class="help-tip posicion">
                                            <p>- Elige tres materias para clasificar tu curso
                                                <br/>- Este criterio ayudará en la tarea de búsqueda del mismo</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 droptarget" style="width: 350px; height: 400px;" ondrop="drop(event)" ondragover="allowDrop(event)" id="cont1">
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget">Programas y certificaciones génericos</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget1">Educación</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget2">Artes y humanidades</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget3">Ciencias sociales, periodismo e información</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget4">Administración de empresas y derecho</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget5">Ciencias naturales, matemáticas y estadística</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget6">Tecnologías de la información y la comunicación (TIC)</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget7">Ingeniería,industría y construcción</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget8">Agricultura, silvicultura, pesca y veterinaria</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget9">Salud y bienestar</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget0">Servicios</p>
                                    </div>
                                    <div class="col-md-6  droptarget" style="width: 350px; height: 400px;" ondrop="drop(event)" ondragover="allowDrop(event)" id="cont2"></div>                
                                    <p id="demo"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <input id="categoria1" name="categoria1" type="hidden" value="" required>
                                    <input id="categoria2" name="categoria2" type="hidden" value="" required>
                                    <input id="categoria3" name="categoria3" type="hidden" value="" required>
                                    <p style="clear:both;"><strong>Nota:</strong> Los eventos de arrastre no son soportados por Internet Explorer 8 y anteriores versiones o Safari 5.1 y anteriores versiones.</p>                
                                </div>
                                <div class="form-group col-md-12"><br>
                                    <h3>Líneas estratégicas</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-11">
                                        <p>Arrastra tres líneas estratégicas para clasificar el curso y ordena por jerarquía</p>
                                    </div> <br>
                                    <div class="col-md-1">
                                        <div class="help-tip posicion">
                                            <p>- Elige tres líneas estratégicas de la Plataforma MéxicoX en las que contribuye el curso </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="droptarget" style="width: 350px; height: 400px;" ondrop="drop(event)" ondragover="allowDrop(event)" id="cont3">
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="estrategia">Capacidades académicas fundamentales</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="estrategia1">Capacitación a profesores</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="estrategia2">Capacitación especializada</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="estrategia3">Retos nacionales</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="estrategia4">Desafíos globales</p>
                                        <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="estrategia5">Divulgación de la cultura, la historia, la ciencia y el disfrute del conocimiento</p>
                                    </div>
                                    <div class="droptarget" style="width: 350px; height: 400px;" ondrop="drop(event)" ondragover="allowDrop(event)" id="cont4"></div>                
                                    <p id="demo"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <input id="estrategia1" name="estrategia1" type="hidden" value="" required>
                                    <input id="estrategia2" name="estrategia2" type="hidden" value="" required>
                                    <input id="estrategia3" name="estrategia3" type="hidden" value="" required>
                                    <p style="clear:both;"><strong>Nota:</strong> Los eventos de arrastre no son soportados por Internet Explorer 8 y anteriores versiones o Safari 5.1 y anteriores versiones.</p>                
                                </div>
                                <div class="form-group col-md-12">
                                    <hr>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </div>
                            </form>    
                        </div> <!--fin bloque temática-->

                        <div class="tab-pane fade" id="archivos"> <!--bloque archivos-->
                            <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
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
                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="help-tip posicion">
                                            <p>- Descarga la carta compromiso para ser socio estratégico de la Plataforma MéxicoX</p>
                                        </div>
                                        <a href="{{asset('download/carta_com.docx')}}"><button type="button" class="btn btn-primary btn-md">Carta Compromiso</button></a>
                                    </div>                                
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2"><br>
                                    <h3>Subir archivos</h3>
                                    <hr>
                                </div>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <div class="col-md-4">
                                        <div class="help-tip posicion">
                                            <p>- Sube la carta de autorización debidamente requisitada y firmada</p>
                                        </div>
                                        <label for="addSignature">Carta Autorización</label><br><br>
                                        <label class="file">
                                            <input name="cartaAutorizacion" type="file" id="signature">
                                            <span class="file-custom"></span>                
                                        </label><br>
                                    </div>
                                    <div class="col-md-4 col-md-offset-2">
                                        <div class="help-tip posicion">
                                            <p>- Sube la carta conmpromiso debidamente requisitada y firmada</p>
                                        </div>
                                        <label for="addSignature">Carta compromiso</label><br><br>
                                        <label class="file">
                                            <input name="cartaCompromiso" type="file" id="signature">
                                            <span class="file-custom"></span>                
                                        </label><br>
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
                        </div><!--fin bloque archivos-->
                    </div> <!--cierra tab-content-->
                </div> <!--cierra panel-body-->
            </div><!--cierra panel-info-->
        </div> <!--cierra col 12-->
    </div> <!--cierra row-->
</div> <!--cierra div container-->

@endsection

<script>
    $(document).ready(function () {
        inst = 1;
        num = 1;
        $("#quitaInst" + num).click(function () {
            event.preventDefault();
            alert("Al menos debe haber un instructor para el curso");
        });
        $("#otroIns").click(function () {
            num++;
            event.preventDefault();
            $("#instructor").clone().prop('id', 'inst' + num).appendTo("#instructores");
            $("#inst" + num).find("#quitaInst1").prop('id', 'quitaInst' + num);

            $("#quitaInst" + num).click(function () {
                event.preventDefault();
                alert(this.id);
                $("#inst" + num).remove();
                num--;
            });
        });
    });
</script>
<script>
    //arrastrar elementos               
    function dragStart(event) {
        event.dataTransfer.setData("Text", event.target.id);

    }

    //    function dragging(event) {
    //        document.getElementById("demo").innerHTML = "The p element is being dragged";
    //    }

    function allowDrop(event) {
        event.preventDefault();
    }

    var categorias = new Array();
    categorias['Programas y certificaciones génericos'] = 1;
    categorias['Educación'] = 2;
    categorias['Artes y humanidades'] = 3;
    categorias['Ciencias sociales, periodismo e información'] = 4;
    categorias['Administración de empresas y derecho'] = 5;
    categorias['Ciencias naturales, matemáticas y estadística'] = 6;
    categorias['Tecnologías de la información y la comunicación'] = 7;
    categorias['Ingeniería,industría y construcción'] = 8;
    categorias['Agricultura, silvicultura, pesca y veterinaria'] = 9;
    categorias['Salud y bienestar'] = 10;
    categorias['Servicios'] = 11;


    function drop(event) {
        numero = $('#cont2').children().length;
        if (numero < 3 || event.target === document.getElementById('cont1')) {
            event.preventDefault();
            var data = event.dataTransfer.getData("Text");
            event.target.appendChild(document.getElementById(data));
        }

        count = $('#cont2').children().length;
        //alert("el div2 tiene: " + count);
        var values = [];
        $('#cont2').children().each(function () {

            if (numero === 2) {
                //                console.log($(this).html()); 
                values.push($(this).html());
            }

        });

        if (numero === 2) {
            $('#categoria1').attr('value', '' + categorias[values[0]]);
            console.log(categorias[values[0]]);
            $('#categoria2').attr('value', '' + categorias[values[1]]);
            console.log(categorias[values[1]]);
            $('#categoria3').attr('value', '' + categorias[values[2]]);
            console.log(categorias[values[2]]);
        }
    }

</script>





