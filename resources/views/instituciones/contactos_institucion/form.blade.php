
<div class="form-group {{ $errors->has('institucion_id') ? 'has-error' : ''}}">
    {!! Form::label('institucion_id', 'Institución', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <input type="hidden" name="institucion_id" value="{{Auth::user ()->institucion_id}}">
        <input type="text" value="{{Auth::user ()->institucion->siglas}}" readonly="readonly">
        {!! $errors->first('institucion_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nivel_academico') ? 'has-error' : ''}}">
    {!! Form::label('nivel_academico', 'Nivel Académico', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('nivel_academico', ['Doctorado'=>'Doctorado','Maestría'=>'Maestría','Licenciatura'=>'Licenciatura','Técnico Superior'=>'Técnico Superior'],$contactos_institucion->nivel_academico, ['class' => 'form-control']) !!}
        {!! $errors->first('nivel_academico', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('area_investigacion') ? 'has-error' : ''}}">
    {!! Form::label('area_investigacion', 'Area Investigación', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">                                  
        {!! Form::select('area_investigacion', $categorias, $contactos_institucion->area_investigacion, ['class' => 'form-control']) !!}
        {!! $errors->first('area_investigacion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('biografia_breve') ? 'has-error' : ''}}">
    {!! Form::label('biografia_breve', 'Biografía Breve', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('biografia_breve', null, ['class' => 'form-control']) !!}
        {!! $errors->first('biografia_breve', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('correo_institucional') ? 'has-error' : ''}}">
    {!! Form::label('correo_institucional', 'Correo Institucional', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('correo_institucional', null, ['class' => 'form-control']) !!}
        {!! $errors->first('correo_institucional', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('telefono_institucional') ? 'has-error' : ''}}">
    {!! Form::label('telefono_institucional', 'Teléfono Institucional', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('telefono_institucional', null, ['class' => 'form-control']) !!}
        {!! $errors->first('telefono_institucional', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cargo_contacto') ? 'has-error' : ''}}">
    {!! Form::label('cargo_contacto', 'Cargo Contacto', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('cargo_contacto', null, ['class' => 'form-control']) !!}
        {!! $errors->first('cargo_contacto', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
 <div class="col-md-4 text-right"><strong>Activo</strong></div>
    <div class="col-md-2 text-right">
    <select name="activo" class="form-control">  
        <option value="1" @if($contactos_institucion->activo) selected @endif>Activo</option>        
        <option value="0" @if(!$contactos_institucion->activo) selected @endif>Inactivo</option>
    </select>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear Contacto', ['class' => 'btn btn-primary']) !!}
    </div>
    
</div>