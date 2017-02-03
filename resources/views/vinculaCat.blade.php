<!--script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script-->
<!-- Latest compiled and minified CSS -->
<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"-->
<!-- Latest compiled and minified JavaScript -->
<!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script-->

@extends('app')

@section('content')
<div class="container">
    <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<h3>Asociar curso a categorias</h3>
		</div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5">
			Course_id
        </div>
		<div class="col-lg-5 col-md-5 col-sm-4 col-xs-7">
			<input id="idCurso" type="text" oninput="buscaCurso()" style="width:100%"></input>
		</div>
        <div id="MensajeUsuario" class="col-lg-3 col-md-3 col-sm-6 col-xs-12"></div>
		<div class="col-lg-12 col-md-12 col-sm-12"></div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-5">
			Nombre del Curso:
		</div>
		<div class="col-lg-5 col-md-5 col-sm-4 col-xs-7">
			<input id="nombreCurso" type="text" style="width:100%" disabled></input>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 text-center">
			<input id="botonAsociar" type="button" value="Asociar" disabled style="color:gray;" onclick="asociarCategoria()"></input>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h4> Categorias</h4>
		</div>
		@foreach($categorias as $categoria)
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
				<input type="checkbox" class="check" value="{{$categoria->id}}" onclick="agregarCategoria(this.value, this.checked)"></input>
			</div>
			<div class="col-lg-11 col-md-11 col-sm-10 col-xs-10">
				{{$categoria->categoria}}
			</div>
		</div>
		@endforeach
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:10px;"></div>
    </div>
</div>
<script>
	var arregloCat = new Array();
	divMsjUsuario = document.getElementById("MensajeUsuario");
	btnAsociar = document.getElementById("botonAsociar");
	divMuestraCurso = document.getElementById("nombreCurso");
	txtCurso = document.getElementById("idCurso");

	function buscaCurso(){
		$.ajax({
		method: "POST",
				url: "{{url('consultaCurso')}}",
				data: {
					idCurso: txtCurso.value,
					_token: "{{csrf_token()}}"
				},
				error: function (ts) {
					divMsjUsuario.innerHTML= "Especifique Id de curso";
					divMsjUsuario.style.backgroundColor = "#ffc966";
					divMuestraCurso.value = "";
					btnAsociar.disabled = true;
					btnAsociar.style.color = "gray";
				}
		})
		.done(function (msg) {
			divMuestraCurso.value = msg;
			divMsjUsuario.innerHTML = "";
			divMsjUsuario.style.backgroundColor = "#ffffff";
			btnAsociar.disabled = false;
			btnAsociar.style.color = "black";
		});
	}
	
	function asociarCategoria(){
		$.ajax({
		method: "POST",
				url: "{{url('asignaCategoria')}}",
				data: {
					arregloCat: arregloCat,
					idCurso: txtCurso.value,
					_token: "{{csrf_token()}}"
				},
				error: function (ts) {
					divMsjUsuario.innerHTML = "Error al asociar categorías";
					divMsjUsuario.style.backgroundColor = "#ffc966";
					btnAsociar.disabled = false;
					btnAsociar.style.color = "black";
				}
		})
		.done(function (msg) {
			divMsjUsuario.innerHTML = "Actualizado correctamente";
			divMsjUsuario.style.backgroundColor = "#ffc966";
			btnAsociar.disabled = true;
			btnAsociar.style.color = "gray";
			txtCurso.value = "";
			var seleccion = document.getElementsByClassName('check');
			divMuestraCurso.value = "";
			for (var i=0, len=seleccion.length; i < len; i++) {
				seleccion[i].checked = false;
			}
			arregloCat.length = 0;
		});
	}
	
	function agregarCategoria(categoria, marcado){
		if(marcado==true){
			arregloCat.push(categoria);
		}
		else{
			arregloCat.splice(arregloCat.indexOf(categoria),1);
		}
	}
</script>
@endsection