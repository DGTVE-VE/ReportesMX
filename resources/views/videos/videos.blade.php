@extends('app') @section('content')
<center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
  <html>
    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
      var datos = {!!$promedio!!};
      var datos1 = {!!$nvideo!!};
      google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStacked);

function drawStacked() {
      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Minutos vistos del video en promedio');
      data.addColumn('number', 'Estimado de minutos que no se miro el video');

      for(var i = 0; i < datos.length+1; i++){
          data.addRows([
            [{v: [parseInt(i)+1, 0, 0], f: 'Tiempo en minutos '},  parseFloat(datos[i]), parseFloat(datos1[i])-parseFloat(datos[i])],
          ]);
        }


      var options = {
        title: 'La duración del video es estimada, puede diferir. El dato de video visto es un promedio de todos los estudiantes que comenzaron a ver el video, si contar los que no lo vieron. El orden de los videos puede variar al orden en el que aparecen publicados en el curso.',
        isStacked: true,
        hAxis: {
          title: 'Videos del curso {{$course_name}}',
          format: ' ',
          viewWindow: {
            min: [0, 0, 0],
            max: [parseInt(datos.length+1), 0, 0]
          }
        },
        vAxis: {
          title: 'Minutos',
          format: ' '
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
      </script>
</head>
<body>
<br>
<div class="container">
    <div class="row">
      <table class="table">
          <div id="chart_div" style="width: 900px; height: 500px;"></div>

      </table>
    </div>
    </div>
</body>
</html>
@endsection
