@extends('app') @section('content')
<center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([


            ['', 'Doctorado = {{$estudio[0]}}', 'Maestria = {{$estudio[1]}}', 'Técnico Superior = {{$estudio[2]}}', 'Licenciatura = {{$estudio[3]}}', 'Bachillerato = {{$estudio[4]}}', 'Secundaria = {{$estudio[5]}}', 'Primaria = {{$estudio[6]}}', 'Ninguno = {{$estudio[7]}}', 'Otros = {{$estudio[8]}}', 'No especificado = {{$estudio[9]}}'],
            ['Grado',{{$estudio[0]}}, {{$estudio[1]}}, {{$estudio[2]}}, {{$estudio[3]}}, {{$estudio[4]}}, {{$estudio[5]}}, {{$estudio[6]}}, {{$estudio[7]}},  {{$estudio[8]}}, {{$estudio[9]}}
                                                         ]]);

        var options = {
          chart: {
            title: 'Nivel de estudios usuarios',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
     <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <br>
            <h3> <p style="text-align: center";>Usuarios por Nivel de estudios: </p> </h3>

            <br>
<table class="table table-hover">
    <tr><div id="columnchart_material" style="width: 900px; height: 500px;"></div></tr>
  <br> <br>
    <tr><td class="danger" style="font-size: medium">Nivel de estudios</td><td class="danger" style="font-size: medium">Cantidad</td></tr>
    <tr><td>Doctorado</td><td>{{$estudio[0]}}</td></tr>
    <tr><td>Maestria</td><td>{{$estudio[1]}}</td></tr>
    <tr><td>Técnico Superior</td><td>{{$estudio[2]}}</td></tr>
    <tr><td>Licenciatura</td><td>{{$estudio[3]}}</td></tr>
    <tr><td>Bachillerato</td><td>{{$estudio[4]}}</td></tr>
    <tr><td>Secundaria</td><td>{{$estudio[5]}}</td></tr>
    <tr><td>Primaria</td><td>{{$estudio[6]}}</td></tr>
    <tr><td>Ninguno</td><td>{{$estudio[7]}}</td></tr>
    <tr><td>Otros</td><td>{{$estudio[8]}}</td></tr>
    <tr><td>No especificado</td><td>{{$estudio[9]}}</td></tr>


  </table>
     </div>
    </div>
</div>
  </body>
</html>
@endsection
