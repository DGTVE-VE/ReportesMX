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
</div><div class="form-group {{ $errors->has('course_name') ? 'has-error' : ''}}">
    {!! Form::label('course_name', 'Course Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('course_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('course_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('inicio') ? 'has-error' : ''}}">
    {!! Form::label('inicio', 'Inicio', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('inicio', null, ['class' => 'form-control']) !!}
        {!! $errors->first('inicio', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('fin') ? 'has-error' : ''}}">
    {!! Form::label('fin', 'Fin', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('fin', null, ['class' => 'form-control']) !!}
        {!! $errors->first('fin', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('inicio_inscripcion') ? 'has-error' : ''}}">
    {!! Form::label('inicio_inscripcion', 'Inicio Inscripcion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('inicio_inscripcion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('inicio_inscripcion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('fin_inscripcion') ? 'has-error' : ''}}">
    {!! Form::label('fin_inscripcion', 'Fin Inscripcion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('fin_inscripcion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('fin_inscripcion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
    {!! Form::label('descripcion', 'Descripcion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('thumbnail') ? 'has-error' : ''}}">
    {!! Form::label('thumbnail', 'Thumbnail', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('thumbnail', null, ['class' => 'form-control']) !!}
        {!! $errors->first('thumbnail', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('institucion') ? 'has-error' : ''}}">
    {!! Form::label('institucion', 'Institucion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('institucion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('institucion', '<p class="help-block">:message</p>') !!}
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
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>