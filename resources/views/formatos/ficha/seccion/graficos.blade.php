<div class="tab-pane fade" id="graficos"> <!--bloque gráficos-->
    {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
    <input type='hidden' name='seccion' value='graficos'>
    <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
    <div class="form-group col-md-8 col-md-offset-2"><br><br>
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
                    <br/>- Tamaño: 150 x 150 pixeles
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
                <p>- Imagen para promocionar el curso.
                    <br/>- La imagen debe ser diseñada expresamente para el curso o tener derechos como ( Flickr creative commons, Stock Vault, Stock XCHNG, iStock Photo)
                    <br/>- Incluir nombre del curso y fecha de inicio.
                    <br/>- Tamaño: 1900 x 400 pixeles
                    <br/>- Tipo de arhivo: *.jpg</p>
            </div>
        </div>
        <div class="form-group col-md-8 col-md-offset-4"> 
        <br/>    
        <button class="btn btn-success" type="submit">
            Guardar
        </button>
    </div>
    </div>
    {!! Form::close() !!}
</div>    