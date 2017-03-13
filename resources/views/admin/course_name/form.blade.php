<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
    {!! Form::label('id', 'Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('id', null, ['class' => 'form-control','disabled']) !!}
        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('course_id') ? 'has-error' : ''}}">
    {!! Form::label('course_id', 'Course Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('course_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><!div class="form-group {{ $errors->has('institucion') ? 'has-error' : ''}}">
    {!! Form::label('institucion', 'Institución', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('institucion', $institucion, $course_name->institucion, ['class' => 'form-control']) !!}        
        {!! $errors->first('institucion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nombre_institucion') ? 'has-error' : ''}}">
    {!! Form::label('nombre_institucion', 'Nombre Institución', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre_institucion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre_institucion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">    
    <div class="col-md-4 text-right"><strong>Activo</strong></div>
    <div class="col-md-2 text-right">
    <select name="activo" class="form-control">        
        <option value="1" @if($course_name->activo) selected @endif>Activo</option>        
        <option value="0" @if(!$course_name->activo) selected @endif>Inactivo</option>
    </select>
    </div>
</div><div class="form-group {{ $errors->has('constancias') ? 'has-error' : ''}}">
    {!! Form::label('constancias', 'Constancias', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('constancias', null, ['class' => 'form-control']) !!}
        {!! $errors->first('constancias', '<p class="help-block">:message</p>') !!}
    </div>
<!--</div><div class="form-group {{ $errors->has('reedicion') ? 'has-error' : ''}}">
    {!! Form::label('reedicion', 'Reedición', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('reedicion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('reedicion', '<p class="help-block">:message</p>') !!}
    </div>
</div>-->

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>