<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

  google.charts.load('current', {'packages':['corechart']});
  google.charts.load('current', {packages: ['corechart', 'line']});
  google.charts.setOnLoadCallback(drawChart);
  google.charts.setOnLoadCallback(drawLineColors);

  function drawChart() {

    var data0 = google.visualization.arrayToDataTable([
      ['Mes', 'Inscritos'],
      @foreach($mes as $m)
        @if($m->month == 1)
          [{{$m->year}}, 'Año'], ['{{$m->month}}',  {{$m->c}} ],
        @else
          ['{{$m->month}}',  {{$m->c}} ],
        @endif
      @endforeach
    ]);

    var options0 = {
      title: 'Historico anual inscritos en MéxicoX',
      hAxis: {title: 'Mes/Año',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };
    var chart0 = new google.visualization.AreaChart(document.getElementById('chart_div0'));
    chart0.draw(data0, options0);


    var data1 = google.visualization.arrayToDataTable([
      ['Mes', 'Inscritos'],
      @foreach($cur as $c)
        @if($c->month == 1)
          [{{$c->year}}, 'Año'], ['{{$c->month}}',  {{$c->c}} ],
        @else
          ['{{$c->month}}', {{$c->c}} ],
        @endif
      @endforeach
    ]);

    var options1 = {
      title: 'Historico anual, inscritos a cursos',
      hAxis: {title: 'Mes/año',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0},
      colors: ['green']
    };
    var chart1 = new google.visualization.AreaChart(document.getElementById('chart_div1'));
    chart1.draw(data1, options1);
  }

  function drawLineColors() {

      var data2 = new google.visualization.DataTable();

      data2.addColumn('number', 'Número de cursos' );
      data2.addColumn('number', 'Alumnos registrados');

      @foreach($users_course as $key)
      data2.addRows([
        [{{$key->n}},  {{$key->users}}],
      ]);
      @endforeach

      var options2 = {
        chart: {
          title: 'Alumnos inscritos en N cursos',
        },
        width: 750,
        height: 400,
        colors: ['orange']
      };

      var chart2 = new google.visualization.LineChart(document.getElementById('chart_div2'));

      chart2.draw(data2, options2);
  }
    </script>
</head>
<body>
  @extends('app') @section('content')

  <center> <h4>Información de "{{$course_name}}"</h4></center>
  <br>
  <div class="container">
    <div class="row">
      <br>
      <div><table class="table table-hover table-bordered" style="font-size: small">
        <tr class="primary">
          <td>
            <h5>Número de instructores en la plataforma</h5>
          </td>
          <td>
            <h5>{{$n_instructores}}</h5>
          </td>
        </tr>
      </table></div>
    </br>
    <h4>Usuarios que se registran a N cursos.</h4>
    <table class="table table-hover table-bordered">
      <td><div id="chart_div2" style="width: 700px; height: 500px;"></div></td>
      <td><div><table class="table table-hover table-bordered" style="font-size: small">
        <tr class="warning" style="font-size: small">
          <td>Número de cursos</td>
          <td>Alumnos registrados</td>
        </tr>
        <?php $j = 0; ?>
        @foreach($users_course as $m)
          @if($j < 10)
          <tr>
            <td>{{$m->n}}</td>
            <td>{{$m->users}}</td>
            <?php $j++; ?>
          </tr>
          @endif
        @endforeach
        <tr>
          <td>...</td>
          <td>...</td>
        </tr>
      </table>
      <a class="btn btn-default" href="{{url ('/download/usuarios_curso.csv')}}" role="button">Descargar archivo usuarios_curso.csv</a>
    </div></td>
  </table>

  <h4>Historico mensual de todos los usuarios que se registran en MéxicoX</h4>

  <table class="table table-hover table-bordered">
    <td><div id="chart_div0" style="width: 700px; height: 500px;"></td>

      <td><div><table class="table table-hover table-bordered">
        <tr class="info" style="font-size: medium">
          <td>Año</td>
          <td>Mes</td>
          <td>Registrados</td>
        </tr>
        @foreach($mes as $m)
          @if($m->year != "" && $m->month < 11 && $m->year < 2016)
          <tr>
            <td>{{$m->year}}</td>
            <td>{{$m->month}}</td>
            <td>{{$m->c}}</td>
          </tr>
          @endif
        @endforeach
      </table>
      <a class="btn btn-default" href="{{url ('/download/inscritos.csv')}}" role="button">Descargar archivo inscritos.csv</a>
    </div></td>
  </table>
  <br>
  <h4>Historico mensual de todos los usuarios que se inscriben en algún curso de MéxicoX</h4>
  <table class="table table-hover table-bordered">
    <td><div id="chart_div1" style="width: 700px; height: 500px;"></td>
      <td><div><table class="table table-hover table-bordered">
        <tr class="success" style="font-size: medium">
          <td>Año</td>
          <td>Mes</td>
          <td>Registrados</td>
        </tr>
        @foreach($cur as $c)
          @if($c->year != "" && $c->month < 11 && $c->year < 2016)
          <tr>
            <td>{{$c->year}}</td>
            <td>{{$c->month}}</td>
            <td>{{$c->c}}</td>
          </tr>
          @endif
        @endforeach
      </table>
      <a class="btn btn-default" href="{{url ('/download/registrados.csv')}}" role="button">Descargar archivo registrados.csv</a>
    </div></td>
  </table>
</table>
</div>
</div>
</body>
@endsection
