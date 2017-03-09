<div class="form-group {{ $errors->has('url_imagen') ? 'has-error' : ''}}">
    {!! Form::label('url_imagen', 'Url Imagen', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('url_imagen', null, ['class' => 'form-control']) !!}
        {!! $errors->first('url_imagen', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    {!! Form::label('activo', 'Activo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('activo', null, ['class' => 'form-control']) !!}
        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Agregar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>