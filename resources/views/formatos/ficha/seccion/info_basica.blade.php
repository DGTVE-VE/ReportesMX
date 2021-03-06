<div class="tab-pane fade in active" id="info_basica"> <!--bloque información inicial-->
    {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
    <input type='hidden' name='seccion' value='info_basica'>
    
    {{csrf_field()}}                                  
    <div class="form-group col-md-8 col-md-offset-2"><br>
        <h3>Crear Curso</h3>
        <hr>
    </div>
    <div class="form-group col-md-7 col-md-offset-2">
        <label for="orgazacionName">Nombre de la Institución:</label>
        <input name="nombre_institucion" type="text" class="form-control" 
               placeholder="Escribe el nombre completo de la institución" 
               value='{{$institucion->nombre_institucion}}'
               readonly>
        
        @if (!empty ($ficha_curso->id_institucion))
        <input type='hidden' name='id_institucion' value="{{$ficha_curso->id_institucion}}">
        @else
        <input type='hidden' name='id_institucion' value="{{Auth::user()->institucion_id}}">
        @endif
        
    </div>

    <div class="form-group col-md-2">
        <label for="siglas_institucion">Siglas:</label>
        <input name="siglas_institucion" type="text" class="form-control" 
               placeholder="Siglas de la institución" 
               value='{{$institucion->siglas}}'
               readonly>        
    </div>
   
    <div class="form-group col-md-9 col-md-offset-2">
        <label for="nombre_curso">Nombre del curso:</label>
        <input name="nombre_curso" type="text"  max="70" class="form-control" 
               id="nombre_curso" placeholder="Escribe el nombre del Curso" 
               value='{{$ficha_curso->nombre_curso}}'
               required onchange='updateCodigoCurso()'>
        <div class="help-tip posicion">
            <p>- El nombre del curso debe tener una longitud de 70 caracteres como máximo (incluyen espacios).
        </div>
    </div>  

    <div class="col-md-3 col-md-offset-2">
        <label for="tipo_curso">Tipo de Curso: </label>
        {!! Form::select('tipo_curso', $tipo_curso, $ficha_curso->tipo_curso, ['class' => 'form-control'] ) !!}

        <div class="help-tip posicion">
            <p>- Espeificar el tipo de curso. 
                <br/>- MOOC: Público en general  
                <br/>- SPOC: Por invitación 
                <br/>- Diplomado  
            </p>
        </div>
    </div>
    <div class="col-md-3">
        <label for="num_edicion">Número de Edición:</label>
        {!! Form::select('num_edicion', ['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'], $ficha_curso->num_edicion, ['class' => 'form-control', 'id'=>'num_edicion'] ) !!}

        <div class="help-tip posicion">
            <p>- Número consecutivo de la emisión del curso.</p>
        </div>
    </div>
    <div class="form-group col-md-3">
        <label for="periodo_emision">Periodo de emisión:</label>
        <!--<input name="periodoEmi" type="text" class="form-control" placeholder="Escribe el periodo de emisión" required>-->
        <input name='periodo_emision' id='periodo_emision' type="month" onchange='updateCodigoCurso()' class="form-control"
               value='{{$ficha_curso->periodo_emision}}' required="required">
        <div class="help-tip posicion">
            <p>- Mes y año en que da inicio el curso.
                <br/>- El componente solo se visualiza en google chrome.            
            </p>
        </div>
    </div>
    <div class="form-group col-md-4 col-md-offset-2">
        <label for="codigo_curso">Código del curso:</label><br>
        <input type='text'  class="text-success text-uppercase form-control"  id='codigo_curso' 
               value='{{$ficha_curso->codigo_curso}}'
               name='codigo_curso'  readonly>
    </div>  
    <div class="col-md-6 col-md-offset-2">                                        
        <label for="carta_compromiso">Carta compromiso:</label>
        <a href="{{asset('download/carta_com.docx')}}"> (Formato para Carta Compromiso) </a>
        <label class="file">
            <input class="form-control" name="carta_compromiso" type="file" accept="application/pdf" id="carta_compromiso" 
                   @if(!File::exists (public_path() .'/cartas/'.$ficha_curso->id.'_compromiso.pdf'))
                   required
                   @endif >
            <span class="file-custom"></span>                
        </label>
        <div class="help-tip posicion">
            <p>- Subir la carta compromiso debidamente requisitada y firmada</p>
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
            <br/>
            <button type="submit" class="btn btn-success ">Guardar</button>
        </div>
    </div>
</form>
</div> <!--fin bloque información inicial-->