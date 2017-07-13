@extends('app') @section('content')

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1> Activa usuario en MéxicoX </h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form action="activaUsuario" method="POST" class="form-inline">
            {{csrf_field()}}
            <label for="email"> <i class="fa fa-envelope-o" aria-hidden="true"></i> Correo electrónico</label>
            <input type="text" id="email" name="email" placeholder="Correo del usuario" class="form-control">
            <input type="submit" value="Activar" class="btn btn-info">
        </form>
    </div>
</div>
@endsection
