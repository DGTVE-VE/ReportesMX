<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<div class="container">
    <div class="row">
		<div class="col-md-12">
			<h3>Asociar Categoria</h3>
		</div>
        <div class="col-md-1">
			Course_id
        </div>
		<div class="col-md-4">
			<input id="idCurso" type="text" oninput="buscaCurso()" style="width:100%"></input>
		</div>
		<div class="col-md-2">
			Nombre del Curso:
		</div>
		<div id="nombreCurso" class="col-md-3">
			Escriba Id de curso
		</div>
		<div class="col-md-12">
			<br> Categorias
		</div>
		@foreach($categorias as $categoria)
			<div class="col-md-1">
				<input type="checkbox" class="check" value="{{$categoria->id}}" onclick="agregarCategoria(this.value, this.checked)"></input>
			</div>
			<div class="col-md-11">
				{{$categoria->categoria}}
			</div>
		@endforeach
		<div class="col-md-12" style="padding:10px;">
		</div>
		<div class="col-md-3">
			<input id="botonAsociar" type="button" value="Asociar" disabled style="color:gray;" onclick="asociarCategoria()"></input>
		</div>
    </div>
</div>
<script>
var arregloCat = new Array();
	function buscaCurso(){
		var txtCurso = document.getElementById("idCurso").value;
		$.ajax({
		method: "POST",
				url: "{{url('consultaCurso')}}",
				data: {
					idCurso: txtCurso,
					_token: "{{csrf_token()}}"
				},
				error: function (ts) {
					document.getElementById("nombreCurso").innerHTML = "Especifique Id de curso";
					document.getElementById("botonAsociar").disabled = true;
					document.getElementById("botonAsociar").style.color = "gray";
				}
		})
		.done(function (msg) {
			document.getElementById("nombreCurso").innerHTML = msg;
			document.getElementById("botonAsociar").disabled = false;
			document.getElementById("botonAsociar").style.color = "black";
		});
	}
	
	function asociarCategoria(){
		var txtCurso = document.getElementById("idCurso").value;
		$.ajax({
		method: "POST",
				url: "{{url('asignaCategoria')}}",
				data: {
					arregloCat: arregloCat,
					idCurso: txtCurso,
					_token: "{{csrf_token()}}"
				},
				error: function (ts) {
					document.getElementById("nombreCurso").innerHTML = "Error al asociar categorías";
					document.getElementById("botonAsociar").disabled = false;
					document.getElementById("botonAsociar").style.color = "black";
				}
		})
		.done(function (msg) {
			document.getElementById("nombreCurso").innerHTML = "Actualizado correctamente";
			document.getElementById("botonAsociar").disabled = true;
			document.getElementById("botonAsociar").style.color = "gray";
			document.getElementById("idCurso").value = "";
			var seleccion = document.getElementsByClassName('check');
			document.getElementById("nombreCurso").innerHTML = msg;
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
		document.getElementById("nombreCurso").innerHTML = arregloCat;
	}
</script>