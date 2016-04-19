<head>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script type="text/javascript" src="{{url ('usuarios/totales.js')}}"></script>

  <script type="text/javascript">

  google.charts.load('current', {'packages': ['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data0 = new google.visualization.arrayToDataTable([
      ['Rango edad', 'Menores a 15','Entre 16 y 20', 'Entre 21 y 25', 'Entre 26 y 30', 'Entre 31 y 35', 'Entre 36 y 40', 'Entre 41 y 45', 'Entre 46 y 50', 'Más de 50'],
      [ ' ', {{$edad[0]}}, {{$edad[1]}}, {{$edad[2]}}, {{$edad[3]}}, {{$edad[4]}}, {{$edad[5]}}, {{$edad[6]}}, {{$edad[7]}}, {{$edad[8]}}
    ]]);

    var options0 = {
      title: 'Por rango de edades',
      width: 900,

      chart: { title:'Rangos'},

      bar: { groupWidth: "90%" }
    };

    var chart0 = new google.charts.Bar(document.getElementById('top_x_div'));
    chart0.draw(data0, google.charts.Bar.convertOptions(options0));

    ////////////////////////////////////////////////////////////////////////////

    var data1 = google.visualization.arrayToDataTable([
    ['', 'Hombres', 'Mujeres', 'No especificado'],
    ['Genero', {{$infot[0]}}, {{$infot[1]}}, {{$infot[2]}}]]);

    var options1 = {
      chart: {
        title: 'Por género de usuarios',
        subtitle: '',
      },

      bars: 'vertical',

      vAxis: {
        format: 'decimal'
      },
      height: 500,
      vAxis: {
        format: 'decimal'
      },
      colors: ['#1b9e77', '#7570b3', '#d95f02'],
    };

    var chart1 = new google.charts.Bar(document.getElementById('chart_div'));
    chart1.draw(data1, options1);

    ////////////////////////////////////////////////////////////////////////////

    var data2 = google.visualization.arrayToDataTable([

         ['', 'Doctorado', 'Maestria', 'Técnico Superior', 'Licenciatura', 'Bachillerato', 'Secundaria', 'Primaria', 'Ninguno', 'Otros', 'No especificado'],
         ['Grado',{{$estudio[0]}}, {{$estudio[1]}}, {{$estudio[2]}}, {{$estudio[3]}}, {{$estudio[4]}}, {{$estudio[5]}}, {{$estudio[6]}}, {{$estudio[7]}},  {{$estudio[8]}}, {{$estudio[9]}}
                                                       ]]);

    var options2 = {
      chart: {
        title: 'Nivel de estudios usuarios',
        subtitle: '',
      }
    };

    var chart2 = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart2.draw(data2, options2);

    ////////////////////////////////////////////////////////////////////////////


  }

  </script>

</head>
<body>
  @extends('app') @section('content')
  <center> <h4>Información de usuarios inscritos al curso de "{{$course_name}}"</h4></center>

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <br><br>

        <table class="table active table-bordered">
          <thead>
            <tr>
              <th>Usuarios</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
            <tr class="success">
              <td>Registrados en MéxicoX</td>
              <td>{{$info[0]}}</td>
            </tr>
            <tr class="info">
              <td>Inscritos a {{$course_name}}</td>
              <td>{{$info[2]}}</td>
            </tr>
            <tr class="danger">
              <td>No registrados en {{$course_name}}</td>
              <td>{{$info[1]}}</td>
            </tr>
          </tbody>
        </table>

        <a class="btn btn-default" href="{{url ('/download/totales.csv')}}" role="button">Descargar archivo totales.csv</a>
        <br><br>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <br><br>
      <table class="table table-hover table-bordered">
        <td><div id="top_x_div" style="width: 850px; height: 400px;"></div></td>

        <td><div><table class="table table-hover table-bordered">
          <tr><td class="active" style="font-size: medium">Rango edad</td><td class="active" style="font-size: medium">#</td></tr>
          <tr><td class="warning">Menores a 15</td><td class="warning">{{$edad[0]}}</td></tr>
          <tr><td class="warning">Entre 16 y 20</td><td class="warning">{{$edad[1]}}</td></tr>
          <tr><td class="warning">Entre 21 y 25</td><td class="warning">{{$edad[2]}}</td></tr>
          <tr><td class="warning">Entre 26 y 30</td><td class="warning">{{$edad[3]}}</td></tr>
          <tr><td class="warning">Entre 31 y 35</td><td class="warning">{{$edad[4]}}</td></tr>
          <tr><td class="warning">Entre 36 y 40</td><td class="warning">{{$edad[5]}}</td></tr>
          <tr><td class="warning">Entre 41 y 45</td><td class="warning">{{$edad[6]}}</td></tr>
          <tr><td class="warning">Entre 46 y 50</td><td class="warning">{{$edad[7]}}</td></tr>
          <tr><td class="warning">Más de 50</td><td class="warning">{{$edad[8]}}</td></tr>
        </table>

        <a class="btn btn-default" href="{{url ('/download/edades.csv')}}" role="button">Descargar archivo edades.csv</a>
      </div></td>
    </table>
    <br>

  </table>
</div>
</div>

<div class="container">
  <div class="row">
    <br><br>
    <table class="table table-hover table-bordered" style=" height: 550px;" >
      <td><div id="chart_div" style="width: 850px; height: 400px;"></div></td>
      <td><div>
        <table class="table table-hover table-bordered">
        <tr><td class="danger" style="font-size: medium">Genero</td><td class="danger" style="font-size: medium">Cantidad</td></tr>
        <tr><td class="warning">Mujeres</td><td class="warning">{{$infot[1]}}</td></tr>
        <tr><td class="warning">Hombres</td><td class="warning">{{$infot[0]}}</td></tr>
        <tr><td class="warning">No especificado</td><td class="warning">{{$infot[2]}}</td></tr>
      </table>
    <a class="btn btn-default" href="{{url ('/download/genero.csv')}}" role="button">Descargar archivo genero.csv</a>
    </div></td>
  </table>
  <br>

</table>
</div>
</div>

<div class="container">
  <div class="row">
    <br><br>
    <table class="table table-hover table-bordered">
      <td><div id="columnchart_material" style="width: 850px; height: 400px;"></div></td>
      <td><div><table class="table table-hover table-bordered">
        <tr><td class="success" style="font-size: medium">Nivel de estudios</td><td class="success" style="font-size: medium">Cantidad</td></tr>
        <tr><td class="warning">Doctorado</td><td class="warning">{{$estudio[0]}}</td></tr>
        <tr><td class="warning">Maestria</td><td class="warning">{{$estudio[1]}}</td></tr>
        <tr><td class="warning">Técnico Superior</td><td class="warning">{{$estudio[2]}}</td></tr>
        <tr><td class="warning">Licenciatura</td><td class="warning">{{$estudio[3]}}</td></tr>
        <tr><td class="warning">Bachillerato</td><td class="warning">{{$estudio[4]}}</td></tr>
        <tr><td class="warning">Secundaria</td><td class="warning">{{$estudio[5]}}</td></tr>
        <tr><td class="warning">Primaria</td><td class="warning">{{$estudio[6]}}</td></tr>
        <tr><td class="warning">Ninguno</td><td class="warning">{{$estudio[7]}}</td></tr>
        <tr><td class="warning">Otros</td><td class="warning">{{$estudio[8]}}</td></tr>
        <tr><td class="warning">No especificado</td><td class="warning">{{$estudio[9]}}</td></tr>
      </table>
    <a class="btn btn-default" href="{{url ('/download/nivel.csv')}}" role="button">Descargar archivo nivel.csv</a>
    </div></td>
  </table>
  <br>

</table>
</div>
</div>

</body>
@endsection
