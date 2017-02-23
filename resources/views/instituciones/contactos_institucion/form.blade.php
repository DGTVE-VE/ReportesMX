<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
    {!! Form::label('id', 'Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('id', null, ['class' => 'form-control','disabled']) !!}
        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('institucion_id') ? 'has-error' : ''}}">
    {!! Form::label('institucion_id', 'Institución', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('institucion_id',null, ['class' => 'form-control','disabled']) !!}
        {!! $errors->first('institucion_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label','required' => 'required','uppercase']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nivel_academico') ? 'has-error' : ''}}">
    {!! Form::label('nivel_academico', 'Nivel Académico', ['class' => 'col-md-4 control-label','required' => 'required','uppercase']) !!}
    <div class="col-md-6">
        {!! Form::select('nivel_academico', array('Licenciatura' => 'Licenciatura',
                                                  'Maestría' => 'Maestría',
                                                  'Doctorado' => 'Doctorado'
                                                  ), ['class' => 'form-control']) !!}
        {!! $errors->first('nivel_academico', '<p class="help-block">:message</p>') !!}
    </div>   
</div><div class="form-group {{ $errors->has('area_investigacion') ? 'has-error' : ''}}">
    {!! Form::label('area_investigacion', 'Área de investigación', ['class' => 'col-md-4 control-label','required' => 'required','uppercase']) !!}
    <div class="col-md-6">
        {!! Form::select('area_investigacion', $categorias, ['class' => 'form-control']) !!}
        {!! $errors->first('area_investigacion', '<p class="help-block">:message</p>') !!}
    </div>   
</div><div class="form-group {{ $errors->has('biografia_breve') ? 'has-error' : ''}}">
    {!! Form::label('biografia_breve', 'Biografía breve', ['class' => 'col-md-4 control-label','required' => 'required','uppercase']) !!}
    <div class="col-md-6">
        {!! Form::textarea('biografia_breve', null, ['class' => 'form-control']) !!}
        {!! $errors->first('biografia_breve', '<p class="help-block">:message</p>') !!}
    </div>     
</div><div class="form-group {{ $errors->has('correo_institucional') ? 'has-error' : ''}}">
    {!! Form::label('correo_institucional', 'Correo institucional', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('correo_institucional', null, ['class' => 'form-control','required' => 'required']) !!}
        {!! $errors->first('correo_institucional', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('telefono_institucional') ? 'has-error' : ''}}">
    {!! Form::label('telefono_institucional', 'Teléfono institucional', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('telefono_institucional', null, ['class' => 'form-control','required' => 'required','uppercase']) !!}
        {!! $errors->first('telefono_institucional', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cargo_contacto') ? 'has-error' : ''}}">
    {!! Form::label('cargo_contacto', 'Cargo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('cargo_contacto', null, ['class' => 'form-control']) !!}
        {!! $errors->first('cargo_contacto', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    {!! Form::label('activo', 'Activo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::checkbox('activo',null, ['class' => 'form-control']) !!}        
        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>