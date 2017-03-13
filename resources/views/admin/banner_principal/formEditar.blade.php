<div class="form-group {{ $errors->has('url_imagen') ? 'has-error' : ''}}">
    {!! Form::label('url_imagen', 'Url Imagen', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('url_imagen', null, ['class' => 'form-control', 'disabled']) !!}
        {!! $errors->first('url_imagen', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('url_imagen') ? 'has-error' : ''}}">
    {!! Form::label('ligaHref', 'Liga', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('ligaHref', null, ['class' => 'form-control']) !!}
        {!! $errors->first('ligaHref', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    <div class="col-md-4 text-right"><strong>Activo</strong></div>
    <div class="col-md-2 text-right">
    <select name="activo" class="form-control">        
        <option value="1" @if($banner_principal->activo) selected @endif>Activo</option>        
        <option value="0" @if(!$banner_principal->activo) selected @endif>Inactivo</option>
    </select>
    </div>

</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Agregar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>