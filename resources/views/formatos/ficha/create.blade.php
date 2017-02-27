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
                        
                        @include('formatos.ficha.seccion.info_basica')

                        @if (!empty ($ficha_curso->id))
                            @include('formatos.ficha.seccion.contactos')

                            @include('formatos.ficha.seccion.fechas')

                            @include('formatos.ficha.seccion.resumen')

                            @include('formatos.ficha.seccion.graficos')
                            
                            @include('formatos.ficha.seccion.staff')
                        
                            @include('formatos.ficha.seccion.asesores')

                            @include('formatos.ficha.seccion.temario')

                            @include('formatos.ficha.seccion.areas')

                            @include('formatos.ficha.seccion.cartas')

                            @include('formatos.ficha.seccion.revision')
                        
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



