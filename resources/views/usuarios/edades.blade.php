@extends('app') @section('content')
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
          var data = new google.visualization.arrayToDataTable([
              ['Rango edad', 'Menores a 15','Entre 16 y 20', 'Entre 21 y 25', 'Entre 26 y 30', 'Entre 31 y 35', 'Entre 36 y 40', 'Entre 41 y 45', 'Entre 46 y 50', 'Más de 50'],
              [ ' ', {{$edad[0]}}, {{$edad[1]}}, {{$edad[2]}}, {{$edad[3]}}, {{$edad[4]}}, {{$edad[5]}}, {{$edad[6]}}, {{$edad[7]}}, {{$edad[8]}}
          ]]);

          var options = {
            title: 'Porcentaje de edades por rangos',
            width: 900,

            chart: { title:'Rangos'},

            bar: { groupWidth: "90%" }
          };

          var chart = new google.charts.Bar(document.getElementById('top_x_div'));
          // Convert the Classic options to Material options.
          chart.draw(data, google.charts.Bar.convertOptions(options));
        };
      </script>

</head>
<body>
<center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
<div class="container">
    <div class="row">

      <h4>Usuarios totales por rangos de edades:</h4>

      <table class="table table-hover">
         <td><div id="top_x_div" style="width: 900px; height: 500px;"></div></td>

            <td><div><table class="table table-hover">
                  <tr class="info" style="font-size: medium">
                  </tr>
                      <tr><td class="info" style="font-size: medium">Rango edad</td><td class="info" style="font-size: medium">#</td></tr>
                      <tr><td>Menores a 15</td><td>{{$edad[0]}}</td></tr>
                      <tr><td>Entre 16 y 20</td><td>{{$edad[1]}}</td></tr>
                      <tr><td>Entre 21 y 25</td><td>{{$edad[2]}}</td></tr>
                      <tr><td>Entre 26 y 30</td><td>{{$edad[3]}}</td></tr>
                      <tr><td>Entre 31 y 35</td><td>{{$edad[4]}}</td></tr>
                      <tr><td>Entre 36 y 40</td><td>{{$edad[5]}}</td></tr>
                      <tr><td>Entre 41 y 45</td><td>{{$edad[6]}}</td></tr>
                      <tr><td>Entre 46 y 50</td><td>{{$edad[7]}}</td></tr>
                      <tr><td>Más de 50</td><td>{{$edad[8]}}</td></tr>

                  </table>
            </div></td>
      </table>
      <br>

      </table>
    </div>
    </div>
</body>

@endsection
