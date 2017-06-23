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
            <label for="carta_autorizacion">Carta Autorización</label><br>
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