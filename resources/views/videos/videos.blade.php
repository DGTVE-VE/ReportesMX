@extends('app') @section('content')
<center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
  <html>
    <head>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
      var datos = {!!$promedio!!};
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();

            data.addColumn('number', 'Video número:');
            data.addColumn('number', 'Tiempo promedio en minutos');

            for(var i = 0; i < datos.length+1; i++){
                data.addRows([
                  [ i,  datos[i]],
                ]);
              }


    var options = {

      chart: {

        title: 'Tiempo de reproducción del video',
        subtitle: 'En promedio por curso y por video'
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, options);
        }
      </script>
</head>
<body>
<br>
<div class="container">
    <div class="row">
      <table class="table">
        <div id="columnchart_material" style="width: 900px; height: 500px;"></div>

      </table>
    </div>
    </div>
</body>
</html>
@endsection
