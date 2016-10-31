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
            right: -5px;
        }
        .b{
            border-style: solid;
        }
    </style>
    <form  action="{{url('nuevoRegistro')}}" method="POST" id="body" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group col-md-6 col-md-offset-4">
            <h2>Registro de MOOC para MéxicoX</h2>
        </div>
        <div class="form-group col-md-8 col-md-offset-2"><br>
            <h3>Información para crear un MOOC</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="orgazacionName">Nombre de la Organización</label>
            <input name="nombreOrganizacion" type="text" class="form-control" placeholder="Escribe el nombre de la organización" required>
            <div class="help-tip posicion">
                <p>- Nombre oficial de la organización</p>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="curseName">Nombre del curso</label>
            <input name="nombreCurso" type="text" class="form-control" id="curseName" placeholder="Escribe el nombre del MOOC" required>
            <div class="help-tip posicion">
                <p>- Longitud 70 caracteres máximo (con espacios)
                    <br/>- Si el curso es una secuencia especificar las partes.</p>  
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="siglasOrganizacion">Siglas de la organización</label>
            <input name="siglasOrg" type="text" class="form-control" id="siglasOrg" placeholder="Escribe las siglas de la organización" required>
            <div class="help-tip posicion">
                <p>- Las siglas oficiales de la organización, aparecen de forma automática en la constancia de participación.  
                    <br/>- No utilizar espacios en blanco o caracteres especiales, las siglas son parte de la URL del curso.
                </p>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="codeCurse">Código del curso</label>
            <input name="idCurso" type="text" class="form-control" placeholder="Escribe el código del curso" required>
            <div class="help-tip posicion">
                <p> - Longitud 10 caracteres máximo
                    <br/>- Incluir una x al final (la x significa que es un curso extensivo)
                    <br/>- No se aceptan caracteres especiales, espacios en blanco, acentos, guiones
                </p>            
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="periodoEmision">Periodo de emision</label>
            <input name="periodoEmi" type="text" class="form-control" placeholder="Escribe el periodo de emisión" required>
            <div class="help-tip posicion">
                <p>- Se compone del año seguido de un guión bajo y el semestre, trimestre o cuadrimestre que corresponda. 
                    <br/>- Ejemplo: 2016_S1
                </p>
            </div>
        </div>

        <div class="form-group col-md-8 col-md-offset-2"><br>
            <h3>Contacto de la Institución</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="contactoInstitucion">Nombre de contacto</label>
            <input name="contactoInst" type="text" class="form-control" placeholder="Escribe el nombre de conctacto" required>
            <div class="help-tip posicion">
                <p>- Nombre de la persona a cargo del MOOC (lider de proyecto)</p>
            </div><br>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="correoInstitucion">Correo electrónico de contacto</label>
            <input name="correoInst" type="text" class="form-control" placeholder="Escribe el correo de contacto" required>
            <div class="help-tip posicion">
                <p>- Correo electrónico de la persona o institución a cargo del MOOC</p>
            </div><br>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="telefonoInstitucion">Número telefónico </label>
            <input name="telefonoInst" type="text" class="form-control" placeholder="Escribe el número telefónico de la institución" required>
            <div class="help-tip posicion">
                <p>- Número telefónico de la institución 
                    <br/>- Incluir clave lada
                </p>
            </div><br>
        </div>

        <div class="form-group col-md-8 col-md-offset-2"><br>
            <h3>Configurar calendario</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <div class="col-md-4">
                <label for="fechaInicio">Fecha de inicio del MOOC</label><br>
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
                <label for="fechaFinal">Fecha final del MOOC</label><br>
                <input name="fechaFin" type="date" required>
                <div class="help-tip posicion">
                    <p>- Especificar la fecha en que termina el MOOC
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
                <label for="fechaFinInsc">Fecha de finalización de inscripciones</label><br>
                <input name="fechaEmi" type="date" required>
                <div class="help-tip posicion">
                    <p>- Se sugiere cerrar inscripciones 8 días después de iniciado el curso.</p>
                </div>
            </div>
        </div><br>
        <div class="form-group col-md-8 col-md-offset-2"><br><br>
            <h3>Idioma del curso</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <div class="col-md-4">
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
            <!--            <div class="col-md-4">
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
                        </div>
                        <div class="col-md-4">
                            <label for="textLanguage">Lenguaje de transcripción</label>
                            <select name="lenguajeTrans">
                                <option value="español">Español</option>
                                <option value="ingles">Inglés</option>
                                <option value="italiano">Italiano</option>
                                <option value="japones">Japones</option>
                                <option value="aleman">Aleman</option>
                                <option value="chino">Chino</option>
                                <option value="portugues">Portugues</option>
                                <option value="otro">Otro</option>
                            </select>-->
            <div class="help-tip posicion">
                <p>- El lenguaje aplica para todo el contenido, video y transcripciones</p>
            </div>
        </div>
        <!--        </div>-->
        <br>
        <div class="form-group col-md-8 col-md-offset-2"><br><br>
            <h3>Resumen del curso</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="courseDescriptionShort">Descripción breve del curso</label>
            <textarea name="desCorta" class="form-control" id="courseDescriptionShort"></textarea>
            <div class="help-tip posicion">
                <p>- Objetivo específico del MOOC
                    <br/>- Limitado a 160 caracteres incluyendo espacios</p>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="courseDescriptionLong">Acerca del Curso</label>
            <textarea name="desLarga" rows="6" cols="40" class="form-control" id="courseDescriptionLong"></textarea>
            <div class="help-tip posicion">
                <p>- Descripción general del curso.
                    <br/>- Conforma la página de presentación del MOOC (About)
                    <br/>- Se sugieren 2,000 caracteres como máximo</p>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="requirements">Conocimientos previos</label>
            <textarea name="requisitos" class="form-control" id="courseRequirements"></textarea>
            <div class="help-tip posicion">
                <p>- Especificar si se require de algún conocimiento previo relacionado al MOOC</p>                
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="courseResults">Aprendizaje esperado</label>
            <textarea name="resApren" rows="3" cols="40" class="form-control" id="courseResults"></textarea>   
            <div class="help-tip posicion">
                <p>- Respóndete a esta pregunta: ¿qué aprenderé con este curso? 
                    <br/>- Breve y conciso </p>
            </div><br>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="nivelCourse">Nivel del MOOC</label>
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
        <div class="form-group col-md-8 col-md-offset-2"><br/>
            <label for="contstancia">Tipo de Constancia</label>
            <select name="tipoConstancia">
                <option value="gratuita">Gratuita</option>
            </select>

        </div>     


        <div class="form-group col-md-8 col-md-offset-2"><br><br>
            <h3>Staff del curso</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2" id="instructores">
            <div id="instructor"> <!-- ??? -->
                <div class="form-group col-md-12">
                    <label for="curseName">Nombre del Instructor</label>
                    <input name="nombreInstructor[]" type="text" class="form-control" id="curseInstructor">    
                    <div class="help-tip">
                        <p>- Nombre completo del instructor o asesor del MOOC</p>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="biogrphia">Biografía</label>
                    <textarea name="biografia[]" class="form-control" id="instructorBiography"></textarea>   
                    <div class="help-tip">
                        <p>- Formación académica
                            <br/>- Links a blogs, sitios web personales y de colaboración
                            <br/>- Breve, 2 párrafos como máximo</p>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="specialization">Especialización</label>
                    <textarea name="especializacion[]" class="form-control" ></textarea>   
                    <div class="help-tip">
                        <p>- Principales áreas de investigación</p>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="importantWorks">Obras importantes</label>
                    <textarea name="obrasImportantes[]" class="form-control" ></textarea>    
                    <div class="help-tip">
                        <p>- Obras destacadas en las que ha colaborado
                            <br/>- Enlaces a las obras realizadas
                            <br/>- 3-5 elementos con viñetas máximo</p>
                    </div>
                </div>
                <div class="form-group col-md-7">
                    <label for="addInstructor">Agregar fotografía</label><br><br>
                    <label class="file">
                        <input name="fotoInstructor[]" type="file" id="picture">
                        <span class="file-custom"></span>
                    </label><br>
                    <div class="help-tip">
                        <p>- Alta resolución, 110 x 110 píxeles, comprimida a menos de 200 KB</p>
                    </div>
                </div>
                <div class="form-group col-md-7">
                    <label for="addSignature">Adjuntar firma</label><br><br>
                    <label class="file">
                        <input name="firmaElectronica[]" type="file" id="signature">
                        <span class="file-custom"></span>                
                    </label><br>
                    <div class="help-tip">
                        <p>Adjuntar firma en alta resolución, 300 pixeles por pulgada, firma escaneada(png, gif ó jpg) 
                            para cada instructor. Para mejor resolución, utilice tinta en negrita o negro sobre papel blanco limpio.
                            Nota: para evitar problemas de seguridad, se recomienda utilizar una firma única no estándar</p>
                    </div>
                </div>
                <div class="form-group col-md-8 col-md-offset-2" id="botonesFin"><br>
                    <button id="quitaInst1" type="submit" class="quitaInst btn btn-danger">Quitar un instructor</button>    
                    <button id="otroIns" class="btn btn-primary">Agregar otro instructor</button>  
                </div>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2"><br><br>
            <h3>Datos complementarios</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="redesSocial">Redes sociales</label>
            <textarea name="redSociales" class="form-control" id="socialesRed"></textarea>
            <div class="help-tip posicion">
                <p>Redes sociales.....</p>
            </div><br>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <div class="col-md-6">
                <label for="addImagen">Añadir imagen del curso</label><br><br>
                <label class="file">
                    <input name="imagenCurso" type="file">
                    <span class="file-custom"></span>
                </label><br>
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
        <div class="form-group col-md-8 col-md-offset-2">
            <div class="col-md-6">
                <label for="addVideo">Añadir video del curso</label><br><br>
                <label class="file">
                    <input name="videoCurso" type="file" id="picture">
                    <span class="file-custom"></span>
                </label><br>
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
        <div class="form-group col-md-8 col-md-offset-2"><br><br>   
            <h3>Especificaciones del curso</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="esfuerzoRequerido">Esfuerzo estimado</label>
            <input name="esfuerzoReq" type="number" class="form-control" name="quantity" min="1" max="10" placeholder="Escribe el esfuerzo estimado en horas">
            <div class="help-tip posicion">
                <p>Esfuerzo estimado...</p>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="duracionSem">Duración del MOOC</label>
            <input name="duracionCurso" type="number" class="form-control" name="quantity" min="1" max="15" placeholder="Escribe la duración del curso en número de semanas">
            <div class="help-tip posicion">
                <p>Duración del curso en número de semanas</p>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2"><br>
            <h3>Áreas temáticas</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <div class="col-md-11">
                <p>Arrastra las tres materias para clasificar el curso y ordena por jerarquia. Esto ayudará al alumno a buscar el curso por materia.</p>
            </div> <br>
            <div class="col-md-1">
                <div class="help-tip posicion">
                    <p>Elige tres materias para clasificar tu curso, este criterio ayudará en la tarea de busqueda del mismo</p>
                </div>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
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
        <div class="form-group col-md-8 col-md-offset-2">
            <input id="categoria1" name="categoria1" type="hidden" value="" required>
            <input id="categoria2" name="categoria2" type="hidden" value="" required>
            <input id="categoria3" name="categoria3" type="hidden" value="" required>
            <p style="clear:both;"><strong>Nota:</strong> Los eventos de arrastre no son soportados por Internet Explorer 8 y anteriores versiones o Safari 5.1 y anteriores versiones.</p>                
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <h3>Contenido Temático del MOOC</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <label for="temarioCurse">Temario del curso</label>
            <textarea name="temario"  rows="10" cols="40" class="form-control" id="courseTemario" placeholder="Escribe el temario del MOOC"></textarea>  
            <div class="help-tip posicion">
                <p>Una revisión de los contenidos tratados en el curso, organizado por semanas o módulos.
                    Centrarse en los temas y contenidos; detalles de la mecánica del curso y logística (formas de evaluación, 
                    las políticas de comunicación, listas de lectura, etc.)</p>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-2"><br>
            <h3>Descargar archivos</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
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
        <div class="form-group col-md-8 col-md-offset-2"><br>
            <h3>Subir archivos</h3>
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <div class="col-md-4">
                <div class="help-tip">
                    <p>Carga el archivo de titularidad de derechos de autor previamente descargado lleno para la plataforma MéxicoX</p>
                </div>
                <label for="addSignature">Carta Autorización</label><br><br>
                <label class="file">
                    <input name="cartaAutorizacion" type="file" id="signature">
                    <span class="file-custom"></span>                
                </label><br>
            </div>
            <div class="col-md-4 col-md-offset-2">
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
        <div class="form-group col-md-8 col-md-offset-2">
            <hr>
        </div>
        <div class="form-group col-md-8 col-md-offset-2">
            <div class="col-md-12 col-md-offset-5">
                <button type="submit" class="btn btn-success">Enviar Información</button>
            </div>
        </div>
    </form>
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
    @endsection