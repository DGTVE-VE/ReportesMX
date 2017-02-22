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
</div><div class="form-group {{ $errors->has('correo') ? 'has-error' : ''}}">
    {!! Form::label('correo', 'Correo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('correo', null, ['class' => 'form-control','required' => 'required']) !!}
        {!! $errors->first('correo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('telefono', 'Teléfono', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('telefono', null, ['class' => 'form-control','required' => 'required','uppercase']) !!}
        {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cargo') ? 'has-error' : ''}}">
    {!! Form::label('cargo', 'Cargo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('cargo_contacto', null, ['class' => 'form-control']) !!}
        {!! $errors->first('cargo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    {!! Form::label('activo', 'Activo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::checkbox('activo',null,null, ['class' => 'form-control']) !!}        
        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('rol') ? 'has-error' : ''}}">
    {!! Form::label('rol', 'Rol', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::checkbox('rol',null,null, ['class' => 'form-control']) !!}        
        {!! $errors->first('rol', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>