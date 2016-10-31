@extends('app') 
@section('content')

<div class="container" >
    <style>
        .droptarget {
            float: left;
            width: 300px;
            height: 400px;
            margin: 15px;
            padding: 10px;
            border: 1px solid #aaaaaa;
        }
        .posicion{
            right: -30px;
        }
        .b{
            border-style: solid;
        }
    </style>
    <!--<form action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">-->
        
        {!!Form::open(['route'=>'nuevoRegistro', 'method' => 'POST'])!!}
        {{csrf_field()}}
        
        
        
        
        
        
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 ">
                <h2>Formulario de registro para curso en MéxicoX</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">                                    
                <h3>Información Básica</h3>
                <hr>                                                                                                                   
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
                <div class="col-md-11">
                    <label for="curseName">Nombre del Curso</label>
                </div><br/>
                <div class="col-md-1">
                    <div class="help-tip posicion">
                        <p>Conciso, 50 caracteres máximo.Descriptivo- de qué trata el curso,tipo de audiencia.
                            Si el curso es una secuencia escribir el título, favor de especificar parte 1 y
                            parte 2 seguido por un subtítulo, 70 caracteres máximo.</p>
                    </div>
                </div>
                <input name="nombreCurso" type="text" class="form-control" id="curseName" placeholder="Escribe el nombre del curso"required>
            </div>        
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-11">
                    <label>ID del curso</label>
                </div><br/>
                <div class="col-md-1">
                    <div class="help-tip posicion">
                        <p>Debe terminar en “x” minúscula. Cursos pueden separarse en módulos y denotarse añadiendo .1, .2, etc. 
                            Al final del curso y antes de la “x” no caracteres especiales de html; acentos, espacios, guion o guionbajo, 10 caracteres máximo.</p>
                    </div>
                </div>
                <input name="idCurso" type="text" class="form-control" placeholder="ID del curso(es el indicador único de cada curso)"required="">
            </div>
        </div>
        <br>       
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-11">
                    <p>Arrastra las tres materias para clasificar el curso y ordena por jerarquia. Esto ayudará al alumno a buscar el curso por materia.</p>
                </div> <br>
                <div class="col-md-1">
                    <div class="help-tip posicion">
                        <p>Elige tres materias para clasificar tu curso, este criterio ayudará en la tarea de busqueda del mismo</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)" id="cont1">
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget">Programas y certificaciones génericos</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget1">Educación</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget2">Artes y humanidades</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget3">Ciencias sociales, periodismo e información</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget4">Administración de empresas y derecho</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget5">Ciencias naturales, matemáticas y estadística</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget6">Tecnologías de la información y la comunicación</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget7">Ingeniería,industría y construcción</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget8">Agricultura, silvicultura, pesca y veterinaria</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget9">Salud y bienestar</p>
                    <p ondragstart="dragStart(event)" ondrag="dragging(event)" draggable="true" id="dragtarget0">Servicios</p>
                </div>

                <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)" id="cont2"></div>                

                <p id="demo"></p>

            </div>
            <div class="col-md-8 col-md-offset-2">
                <input id="categoria1" name="categoria1" type="hidden" value="" required>
                <input id="categoria2" name="categoria2" type="hidden" value="" required>
                <input id="categoria3" name="categoria3" type="hidden" value="" required>
                <p style="clear:both;"><strong>Nota:</strong> Los eventos de arrastre no son soportados por Internet Explorer 8 y anteriores versiones o Safari 5.1 y anteriores versiones.</p>                
            </div>
            
            
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6">
                    <label for="addInstructor">Añadir imagen del curso</label><br><br>
                    <label class="file">
                        <input name="imagenCurso" type="file">
                        <span class="file-custom"></span>
                    </label><br>
<!--                </div>
                <div class="col-md-6 b">-->
                    <div class="help-tip" style="align: left;">
                        <p>Selecciona una imagen atractiva que describa potencialmente tu curso, sin texto o encabezados.
                            Elige una imagen que tenga permiso de uso, que tenga derechos como ( Flickr creative commons, Stock Vault, Stock XCHNG, iStock Photo)
                            o alguna otra imagen diseñada especialmente para tu curso
                            Cursos secuenciados deberán tener una sola imagen
                            Tamaño: 378 x 225 pixeles
                            Nombre del arhivo: Nombre del curso_Banner.jpg</p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6">
                    <label for="addInstructor">Añadir video del curso</label><br><br>
                    <label class="file">
                        <input name="videoCurso" type="file" id="picture">
                        <span class="file-custom"></span>
                    </label><br>
<!--                </div>
                <div class="col-md-8">-->
                    <div class="help-tip">
                        <p>*El vídeo debe emocionar y atraer a potenciales estudiantes para tomar el curso. Piense en ello como un tráiler de la película o programa de televisión de promoción. 
                            El video debe ser convincente y exhibir la personalidad del instructor.
                            Longitud: longitud ideal es de 30-90 segundos (principiantes normalmente sólo ven un promedio de 30 segundos)
                            En caso de ser producidos y editados, utilice elementos como gráficos y clips libres de derechos
                            El video debe responder a estas preguntas clave:
                            ¿Por qué se debería registrar un alumno?,¿Qué temas y conceptos están cubiertos?,¿Quién está enseñando el curso?,¿Qué institución está entregando el curso?
                            Especificaciones:
                            Nombre: InstitucionX_NúmeroCurso_About.mov
                            Al cargar, seleccione "cargas anónimas".
                            Especificaciones técnicas:
                            Codec: H.264
                            Contenedor: .mp4
                            Resolución: 1920x1080
                            Velocidad de cuadros: 29,97 fps
                            Aspecto: 1.0
                            Calidad: VBR 5Mbps
                            Codec de audio: AAC 44.1KHz / 192Kbps</p>
                    </div>
                </div>
            </div>


        </div><br>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-11">
                    <label for="courseDescriptionShort">Descripción corta del curso</label>
                </div><br>
                <div class="col-md-1">
                    <div class="help-tip posicion">
                        <p>Breve descripción del curso para que enganche a los estudiantes mientras 
                            leen el listado de otros cursos.Transmite el por qué se debe tomar el curso.
                            Dirigido a una audiencia global, 140 caracteres máximo, incluyendo espacios.</p>
                    </div>
                </div>            
                <textarea name="desCorta" class="form-control" id="courseDescriptionShort"></textarea>            
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-11">
                    <label for="courseDescriptionLong">Descripción larga del curso</label>
                </div><br>
                <div class="col-md-1">
                    <div class="help-tip posicion">
                        <p>Descripción resumida del curso. Describe por qué un alumno debe tomar este curso.
                            Dirigido a una audiencia global.El texto debe ser fácilmente analizado, usando balazos para destacar en vez de párrafos largos.
                            Nota: las primeras 4 ó 5 líneas deben ser visibles para el alumno; 400 palabras como límite en 2 ó 3 párrafos</p>
                    </div>
                </div>            
                <textarea name="desLarga" class="form-control" id="courseDescriptionShort"></textarea>            
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-11">
                    <label for="courseResults">Resultados del aprendizaje</label>
                </div>
                <div class="col-md-1">
                    <div class="help-tip posicion">
                        <p>Respóndete a esta pregunta: ¿qué aprenderé con este curso? 3-5 balazos.
                            Aproximadamente de 4 a 10 palabras por balazo</p>
                    </div>
                </div>            
                <textarea name="resApren" class="form-control" id="courseResults"></textarea>                    
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-11">
                    <label for="courseResults">Temario del curso</label>
                </div>
                <div class="col-md-1">
                    <div class="help-tip posicion">
                        <p>Una revisión de los contenidos tratados en el curso, organizado por semanas o módulos.
                            Centrarse en los temas y contenidos; detalles de la mecánica del curso y logística (formas de evaluación, 
                            las políticas de comunicación, listas de lectura, etc.)</p>
                    </div>
                </div>            
                <textarea name="temario" class="form-control" id="courseResults"></textarea>                    
            </div>
        </div>
        <br>
       
        <div class="row">
            <div class="col-md-8 col-md-offset-2">              
                <h3>Fechas del curso</h3>
                <hr>
                <!--<div class="col-md-12">-->
                     <div class="col-md-6">
                        <label for="courseResults">Fecha de inicio</label><br>    
                        <input name="fechaIni" type="date" name="fecha_lan">
                        <div class="help-tip">
                            <p>Fecha de inicio: Es preferible comenzar un día entre semana(martes, miércoles o jueves) evitando días feriados.
                                Fechas aproximadas son permitidas son aceptables y se requiere notificación para que los alumnos inscritos sepan la fecha final del curso.
                                Si el curso es “a tu propio ritmo” habrá que especificarlo.
                                Nota: Si no puedes especificar una fecha exacta identifica el mes en el que se impartirá el curso.</p>
                        </div>
                    </div>               
                    <div class="col-md-6">
                        <label for="courseResults">Fecha de fin de curso</label><br>
                        <input name="fechaFin" type="date" name="fecha_lan">
                        <div class="help-tip">
                            <p>Fecha final del curso: Ésta será cuando todas las calificaciones estén listas y las constancias expedidas. 
                                Nota. Si la fecha de finalización del curso cambia, favor de dar aviso.</p>
                        </div>
                    </div>
                </div>
        </div>    <br>
                 <div class="row">
            <div class="col-md-8 col-md-offset-2">   
                <!--<div class="col-md-12">-->
                    <div class="col-md-6">
                        <label for="courseResults">Fecha de inicio de Inscripciones</label>    
                        <input name="fechaLan" type="date" name="fecha_lan">
                        <div class="help-tip">
                            <p>Fecha de lanzamiento: es recomendable lanzar el curso a inscripciones 3 meses antes de la fecha de inicio.</p>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-6">
                        <label for="courseResults">Fecha de finalización de inscripciones</label>    
                        <input name="fechaEmi" type="date" name="fecha_lan">
                        <div class="help-tip">
                            <p>Fecha de generación de constancias: La fecha en que se deben ejecutar los certificados para el curso al menos
                                deben ser 2 días después de haber finalizado el curso.</p>
                        </div>
                    </div>
                </div>
                            
            </div>
        <!--</div>-->
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">                
                <h3>Especificaciones del curso</h3>
                <hr>
                <div class="col-md-6">
                    <label for="duracionSem">Duración del curso(número de semanas)</label>
                    <input name="duracionCurso"type="number" name="quantity" min="1" max="15">
                    <div class="help-tip">
                        <p>Duración del curso en número de semanas</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="esfuerzoReq">Esfuerzo Requerido(horas por semana)</label>
                    <input name="esfuerzoReq"type="number" name="quantity" min="1" max="20">
                    <div class="help-tip">
                        <p>Número de horas por semana que el alumno invertirá en el curso para tener éxito.</p>
                    </div>
                </div>     
            </div>
        </div><br>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-md-4">
                            <label for="requirements">Requisitos</label>
                        </div>
                        <div class="col-md-8">
                            <div class="help-tip">
                                <p>Especificar al estudiante nivel del curso (básico, avanzado,pregrado, postgrado).
                                    Si no hay prerrequisitos favor de especificarlo.Máximo 200 caracteres.</p>
                            </div>   
                        </div>
                        <textarea name="requisitos" class="form-control" id="courseRequirements"></textarea><br>
                    </div>
                </div>                                    
          
        <br>
        <div class="row">            
            <div class="col-md-8 col-md-offset-2">
                <h4>Idioma del curso</h4>
            </div>               
        </div>
        <br>
        <div class="row">            
            <div class="col-md-4">
                <label for="contentLanguage">Lenguaje del contenido</label>
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
                <div class="help-tip">
                    <p>El contenido del curso(navegación y el contenido del curso excluyendo vídeos)</p>
                </div>
            </div>
            <div class="col-md-4">
                <label for="multimediaLanguage">Lenguaje multimedia</label>
                <select name="lenguajeMult">
                    <option value="español">Español</option>
                    <option value="ingles">Inglés</option>
                    <option value="italiano">Italiano</option>
                    <option value="japones">Japones</option>
                    <option value="aleman">Aleman</option>
                    <option value="chino">Chino</option>
                    <option value="portugues">Portugues</option>
                    <option value="otro">Otro</option>
                </select>
                <div class="help-tip">
                    <p>Videos (lengua hablada en los videos)</p>
                </div>
            </div>
            <div class="col-md-4">
                <label for="textLanguage">Lenguaje de las transcripciones</label>
                <select name="lenguajeTrans">
                    <option value="español">Español</option>
                    <option value="ingles">Inglés</option>
                    <option value="italiano">Italiano</option>
                    <option value="japones">Japones</option>
                    <option value="aleman">Aleman</option>
                    <option value="chino">Chino</option>
                    <option value="portugues">Portugues</option>
                    <option value="otro">Otro</option>
                </select>
                <div class="help-tip">
                    <p>Transcripción del video (idioma del subtítulo de vídeo)</p>
                </div>
            </div>               
            <hr>          
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="courseLanguage">Nivel del curso</label><br><br> 
            </div>
            <div class="col-md-8">
                <div class="help-tip">
                    <p>Elija uno de las siguientes 3 opciones para el nivel de curso:
                        Introductorio - No hay requisitos previos; una persona con educación secundaria podría completar
                        Intermedio - prerrequisitos básicos; un grado de la bachillerato así como estudios universitarios
                        Avanzado - Requisitos previos necesarios; curso orientado a estudiantes de licenciatura o maestría</p>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">                  
                <div class="col-md-9">
                    <div class="col-md-2">
                        <input type="radio" name="level" value="basico" checked>Introductorio
                    </div>
                    <div class="col-md-2 col-md-offset-2">
                        <input type="radio" name="level" value="intermedio">Intermedio
                    </div>
                    <div class="col-md-2 col-md-offset-2">
                        <input type="radio" name="level" value="avanzado">Avanzado   
                    </div>
                </div>
                <hr>
            </div>        
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">                
                <div class="col-md-4">
                    <label for="kindConstance">Tipo de constancia</label>
                    <select name="tipoConstancia">
                        <option value="gratuita">Gratuita</option>                
                    </select>
                </div>
                <div class="col-md-8">
                    <div class="help-tip">
                        <p>Tipo de constancia</p>
                    </div>
                </div>                                                                    
            </div>
        </div>
        <br>
        <div class="row">
            
            <div class="col-md-4 col-md-offset-5">
                <h4>Descargar</h4>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <hr>
            </div>
            
            <div class="col-md-10 col-md-offset-2">
                
                <div class="col-md-5">
                    <div class="help-tip">
                    <p>Descarga el archivo de titularidad de derechos de autor para la plataforma MéxicoX</p>
                </div>
                    <a href="{{asset('download/carta_aut.docx')}}"><button type="button" class="btn btn-primary btn-md">Carta Autorización</button></a>
                </div>
                <div class="col-md-5">
                    <div class="help-tip">
                    <p>Descarga el archivo de llenado para ser socio estrategico de MéxicoX</p>
                </div>
                    <a href="{{asset('download/carta_com.docx')}}"><button type="button" class="btn btn-primary btn-md">Carta Compromiso</button></a>
                </div>                                
            </div>
            <hr>
        </div>
        <div class="row">
            <hr>
            <div class="col-md-10 col-md-offset-2">
                
                <div class="col-md-5">
                    <div class="help-tip">
                    <p>Carga el archivo de titularidad de derechos de autor previamente descargado lleno para la plataforma MéxicoX</p>
                </div>
                    <label for="addSignature">Carta Autorización</label><br><br>
                        <label class="file">
                            <input name="cartaAutorizacion" type="file" id="signature">
                            <span class="file-custom"></span>                
                        </label><br>
                </div>
                <div class="col-md-5">
                    <div class="help-tip">
                    <p>Carga el archivo de llenado para ser socio estrategico de MéxicoX previamente descargado lleno</p>
                </div>
                    <label for="addSignature">Carta compromiso</label><br><br>
                        <label class="file">
                            <input name="cartaCompromiso" type="file" id="signature">
                            <span class="file-custom"></span>                
                        </label><br>
                </div>
                
                
            </div>
            <hr>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Staff del curso</h3>
                <hr>
            </div>
        </div>
        <br>
        <div id="instructores">
            <div id="instructor">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-md-4">
                            <label for="curseName">Nombre del Instructor</label>
                        </div>
                        <div class="col-md-8">
                            <div class="help-tip">
                                <p>Nombre del instructor</p>
                            </div>
                        </div>
                        <input name="nombreInstructor[]" type="text" class="form-control" id="curseInstructor">                                           
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-md-4">
                            <label for="courseDescriptionShort">Biografía</label>
                        </div>
                        <div class="col-md-8">
                            <div class="help-tip">
                                <p>Biografía: breve (1-2 párrafos como máximo)</p>
                            </div>
                        </div>
                        <textarea name="biografia[]" class="form-control" id="instructorBiography"></textarea>                                     
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-md-4">
                            <label for="specialization">Especialización</label>
                        </div>
                        <div class="col-md-8">
                            <div class="help-tip">
                                <p>Especialización: principales áreas de investigación se centran</p>
                            </div>
                        </div>
                        <textarea name="especializacion[]" class="form-control" ></textarea>                                  
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-md-4">
                            <label for="importantWorks">Obras importantes</label>
                        </div>
                        <div class="col-md-8">
                            <div class="help-tip">
                                <p>Las obras más importantes: enlaces a los trabajos pertinentes (3-5 elementos con viñetas máximo)</p>
                            </div>
                        </div>
                        <textarea name="obrasImportantes[]" class="form-control" ></textarea>                                   
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="addInstructor">Añadir fotografía</label><br><br>
                        <label class="file">
                            <input name="fotoInstructor" type="file" id="picture">
                            <span class="file-custom"></span>
                        </label><br>
                        <div class="help-tip">
                            <p>Alta resolución, 110 x 110 píxeles, comprimida a menos de 200 KB</p>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="addSignature">Adjuntar firma</label><br><br>
                        <label class="file">
                            <input name="firmaElectronica" type="file" id="signature">
                            <span class="file-custom"></span>                
                        </label><br>
                        <div class="help-tip">
                            <p>Adjuntar firma en alta resolución, 300 pixeles por pulgada, firma escaneada(png, gif ó jpg) 
                                para cada instructor. Para mejor resolución, utilice tinta en negrita o negro sobre papel blanco limpio.
                                Nota: para evitar problemas de seguridad, se recomienda utilizar una firma única no estándar</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-5">                    
                    <button id="quitaInst1" type="submit" class="quitaInst btn btn-danger">Quitar un instructor</button>                    
                </div>
            </div>
        </div>

        <div id="botonesFin">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12 col-md-offset-5">                    
                    <button id="otroIns" class="btn btn-primary">Agregar otro instructor</button>                    
                </div>               
            </div><br><br>
            <div class="row">
                <div class="col-md-12 col-md-offset-5">
                    <button type="submit" class="btn btn-success">Enviar Información</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section ('scripts')
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
<scrip>
    
</scrip>
@endsection