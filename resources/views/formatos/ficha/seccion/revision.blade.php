

<div class="tab-pane fade" id="revision"> <!--bloque archivos-->
    @if ($ficha_curso->estado == 'edicion' && Auth::user()->institucion_id == $ficha_curso->id_institucion)
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
    @endif
    
@if (Auth::user()->is_superuser)    
    
        <div class="row">
        @if ($ficha_curso->estado == 'compromiso')
        <div class="row">
        <div class="form-group col-md-4 col-md-offset-2"><br>
            <h3>Aprobar carta compromiso</h3>            
        </div>
        <hr>
    </div>
        <div class="form-group col-md-4 col-md-offset-2">
            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
                <input type='hidden' name='seccion' value='aprobar'>
                <input type='hidden' name='que_aprueba' value='carta'>
                <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
                <div class="col-md-10 ">
                    <button type="submit" class="btn btn-info">Aprobar carta compromiso</button>
                </div>
            </form>
        </div>
@endif
<!--        <div class="form-group col-md-4 col-md-offset-2"><br>
            <h3>Aprobar para apertura</h3>
            <hr>
        </div>-->
        @if ($ficha_curso->estado == 'revision')
        <div class="row">
            <div class="form-group col-md-4 col-md-offset-2"><br>
                <h3>Aprobar curso para apertura</h3>            
            </div>
            <hr>
        </div>
        <div class="form-group col-md-4  col-md-offset-2">
            {!! Form::model($ficha_curso, ['action'=> 'FichaTecnicaController@store', 'files'=>true]) !!}
                <input type='hidden' name='seccion' value='aprobar'>
                <input type='hidden' name='que_aprueba' value='curso'>
                <input type='hidden' name='id' value='{{$ficha_curso->id}}'>
                <div class="col-md-10 ">
                    <button type="submit" class="btn btn-primary">Aprobar para apertura</button>
                </div>
            </form>
        </div>
        @endif
    </div>    
@endif

</div>
