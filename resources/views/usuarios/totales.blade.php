@extends('app') @section('content')
<center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
      google.charts.load("current", {
          packages: ["corechart"]
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
          var data = google.visualization.arrayToDataTable([
['Usuarios', 'Número'],
['Inscritos en curso: {{$info[2]}}' , {{$info[2]}}],
['No inscritos: {{$info[1]}}', {{$info[1]}}]
]);
          var options = {
              title: 'Usuarios Activos en la plataforma',
              pieHole: 0,
          };

          var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
          chart.draw(data, options);
      }

  </script>

</head>
<body>

  <center><td><a href="{{url('inscritost')}}" class="btn btn-success active" role="button">Inscritos a algún curso por mes</a></td></center>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <br>
            <h4> <p style="text-align: center";>Total de usuarios registrados en MéxicoX: </p> </h4>
            <br>
            <h4 style="text-align: center" ;> <strong> {{$info[0]}} </strong></h4>

                <div id="donutchart" style="width: 900px; height: 500px;"></div>
                <br><br>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">

  <table class="table">
     <td><div id="line_top_x"></div></td>

        <td><div id="line_top_y"></div></td>
  </table>
    </div>
    </div>
</body>
@endsection
