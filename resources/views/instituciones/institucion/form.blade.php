<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
    {!! Form::label('id', 'Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('id', null, ['class' => 'form-control','disabled']) !!}
        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nombre_institucion') ? 'has-error' : ''}}">
    {!! Form::label('nombre_institucion', 'Nombre Institución', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre_institucion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre_institucion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('siglas') ? 'has-error' : ''}}">
    {!! Form::label('siglas', 'Siglas', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('siglas', null, ['class' => 'form-control']) !!}
        {!! $errors->first('siglas', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('correo_mexicox') ? 'has-error' : ''}}">
    {!! Form::label('correo_mexicox', 'Correo Mexicox', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('correo_mexicox', null, ['class' => 'form-control']) !!}
        {!! $errors->first('correo_mexicox', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>