<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
    {!! Form::label('id', 'Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('course_id') ? 'has-error' : ''}}">
    {!! Form::label('course_id', 'Course Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('course_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('institucion') ? 'has-error' : ''}}">
    {!! Form::label('institucion', 'Institucion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('institucion', null,['class' => 'form-control']) !!}
        {!! $errors->first('institucion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nombre_institucion') ? 'has-error' : ''}}">
    {!! Form::label('nombre_institucion', 'Nombre Institucion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre_institucion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre_institucion', '<p class="help-block">:message</p>') !!}
    </div>    
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    {!! Form::label('activo', 'Activo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::checkbox('activo', null, ['class' => 'form-control']) !!}
        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('constancias') ? 'has-error' : ''}}">
    {!! Form::label('constancias', 'Constancias', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('constancias', null, ['class' => 'form-control']) !!}
        {!! $errors->first('constancias', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>