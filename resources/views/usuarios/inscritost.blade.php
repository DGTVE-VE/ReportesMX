  <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

      var mes1 = {!!$mes1!!};
      var mes2 = {!!$mes2!!};


    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = new google.visualization.DataTable();
    var data2 = new google.visualization.DataTable();

      data.addColumn('number', 'Mes (Desde Febrero del 2015)' );
      data2.addColumn('number', 'Mes (Desde Febrero del 2015)' );
      data.addColumn('number', 'Por mes en plataforma');
      data2.addColumn('number', 'Por mes en plataforma');


      for (var i = 0 ; i <= mes1.length ; i++){
      if(mes1[i]){
    data.addRows([
      [i,  parseInt(mes1[i])],
    ]);
  }else{
    data.addRows([
      [i,  0],
    ]);
  }
if(mes2[i]){
    data2.addRows([
      [i,  parseInt(mes2[i])],
    ]);
  }else{
    data2.addRows([
      [i,  0],
    ]);
  }

      }

    var options = {

      chart: {

        title: 'Cantidad de usuarios registrados',
        subtitle: 'Por mes en MéxicoX'
      },
      width: 900,
        height: 400,

      axes: {
        x: {
          0: {side: 'top'}
        }
      },
        colors: ['blue']
    };
    var options2 = {

      chart: {

        title: 'Usuarios inscritos en algún curso',
        subtitle: 'Por mes'
      },
      width: 900,
        height: 400,
        colors: ['green']
    };

    var chart = new google.charts.Line(document.getElementById('line_top_x'));
    var chart2 = new google.charts.Line(document.getElementById('line_top_y'));

    chart.draw(data, options);
    chart2.draw(data2, options2);
  }
  </script>
  </head>
<body>
  @extends('app') @section('content')
<center> <h4>Información de todos los cursos de MéxicoX</h4></center>
<br>



<div class="container">
    <div class="row">


      <table class="table table-hover table-bordered" style="font-size: small">
            <tr class="info" style="font-size: small">
              <td>Número de cursos</td>
              <td>Alumnos registrados</td>
            </tr>
            <?php $i = 0; foreach ($users_course as $m): ?>
              <tr>
                <td><?php print_r($m->n); ?></td>
                <td><?php print_r($m->users); $i = $i + $m->users;?></td>
              </tr>
            <?php endforeach; ?>
              <tr>
                <td>Total</td>
                <td>{{$i}}</td>
              </tr>
            </table>


      <h4>Grafica que muestra las estadísticas mes a mes desde febrero del 2015, de todos los usuarios que se registran en MéxicoX</h4>

      <table class="table table-hover table-bordered">
         <td><div id="line_top_x"></div></td>

            <td><div><table class="table table-hover table-bordered">
                  <tr class="info" style="font-size: medium">
                    <td>Mes</td>
                    <td>Registrados</td>
                  </tr>
                  <?php $i = 0; foreach ($mes1 as $m): ?>
                    <tr>
                      <td><?php print_r($i+1); ?></td>
                      <td><?php print_r($m); $i++;?></td>
                    </tr>
                  <?php endforeach; ?>
                  </table>
                  <a class="btn btn-default" href="{{url ('/download/inscritos.csv')}}" role="button">Descargar archivo inscritos.csv</a>
            </div></td>
      </table>
      <br>
      <h4>Grafica que muestra las estadísticas mes a mes desde marzo del 2015, de todos los usuarios que se inscriben en algún curso de MéxicoX</h4>
      <table class="table table-hover table-bordered">
         <td><div id="line_top_y"></div></td>

            <td><div><table class="table table-hover table-bordered">
                  <tr class="success" style="font-size: medium">
                    <td>Mes</td>
                    <td>Registrados</td>
                  </tr>
                  <?php $i = 0; foreach ($mes2 as $m): ?>
                    <tr>
                      <td><?php print_r($i+1); ?></td>
                      <td><?php print_r($m); $i++;?></td>
                    </tr>
                  <?php endforeach; ?>
                  </table>
                  <a class="btn btn-default" href="{{url ('/download/registrados.csv')}}" role="button">Descargar archivo registrados.csv</a>
            </div></td>

      </table>

      </table>

    </div>
    </div>


</body>
  @endsection
