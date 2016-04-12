  @extends('app') @section('content')
  <center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
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

    data.addRows([
      [i,  mes1[i]],
    ]);

    data2.addRows([
      [i,  mes2[i]],
    ]);

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
        colors: ['red']
    };
    var options2 = {

      chart: {

        title: 'Usuarios inscritos en algún curso',
        subtitle: 'Por mes'
      },
      width: 900,
        height: 400,
        colors: ['blue']
    };

    var chart = new google.charts.Line(document.getElementById('line_top_x'));
    var chart2 = new google.charts.Line(document.getElementById('line_top_y'));

    chart.draw(data, options);
    chart2.draw(data2, options2);
  }
  </script>
  </head>
  <body>
  <div class="container">
      <div class="row">

        <table class="table">
          <tr>
           <td><div id="line_top_x"></div></td>
         </tr>
           <tr>
              <td><div id="line_top_y"></div></td>
            </tr>
        </table>
      </div>
      </div>
  </body>
  @endsection
