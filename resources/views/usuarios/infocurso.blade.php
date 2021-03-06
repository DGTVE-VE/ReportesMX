<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    var sem = {!!$semanal!!};

  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(drawChart);

function drawChart() {

  var data0 = new google.visualization.DataTable();

    data0.addColumn('number', 'Desde {{$s}} ,hasta {{$f}}');
    data0.addColumn('number', 'Incritos semanal');


    for (var i = 0 ; i <= sem.length ; i++){

    if(sem[i]){
      data0.addRows([
        [i,  parseInt(sem[i])],
      ]);
    }else{
      data0.addRows([
        [i,  0],
      ]);
    }

    }

  var options0 = {
    legend: { position: 'left' },

    chart: {

      title: 'Cantidad de usuarios registrados con un total de {{$l}}',
      subtitle: 'Por semana en el curso'
    },
    width: 900,
      height: 400,

    axes: {
      x: {
        0: {side: 'top'}
      }
    },
      colors: ['green']
  };

  var chart0 = new google.charts.Line(document.getElementById('line_top'));

  chart0.draw(data0, options0);

  ////////////////////////////////////////////////////////////////////////////////

  var datos = {!!$desercion!!};

  var data = new google.visualization.DataTable();
  var data1 = new google.visualization.DataTable();
  data.addColumn('number', 'Día' );
  data1.addColumn('number', 'Día' );
  data.addColumn('number', 'Por día');
  data1.addColumn('number', 'Acumulado');

  var suma = 0;

  for (var i = 0 ; i < datos.length; i++){

    suma = suma + parseInt(datos[i].usuarios);

    if(datos[i].usuarios){
      data.addRows([

        [i,  parseInt(datos[i].usuarios)],

      ]);}else{
        data.addRows([

          [i,  0],

        ]);

      }
      if(suma){
        data1.addRows([

          [i, parseInt(suma)],

        ]);
      }else{
        data1.addRows([

          [i, 0],

        ]);

      }
    }

    var options = {
      legend: { position: 'left' },

      chart: {

        title: 'Alumnos que registraron actividad',
        subtitle: 'Por día'
      },
      width: 950,
      height: 400,

      axes: {
        x: {
          0: {side: 'top'}
        }
      },
      colors: ['red']
    };
    var options1 = {
      legend: { position: 'left' },
      chart: {
        title: 'Acumulado de alumnos que registraron actividad',
        subtitle: 'A lo largo del curso.'
      },
      width: 950,
      height: 400,
      axes: {
        x: {
          0: {side: 'top'}
        }
      },
        colors: ['purple']
    };

    var chart = new google.charts.Line(document.getElementById('line_top_x'));
    var chart1 = new google.charts.Line(document.getElementById('line_top_y'));


    chart.draw(data, options);
    chart1.draw(data1, options1);

    ////////////////////////////////////////////////////////////////////

    var data_a = new google.visualization.DataTable();
     data_a.addColumn('number', 'Actividades');
     data_a.addColumn('number', 'Alumnos');

    var array_0 = {!! $activities_activities !!};
    var array_1 = {!! $activities_users !!};

    for(var i = 1; i < array_0.length ; i++){
      data_a.addRows([
        [array_0[i], array_1[i]],
      ]);
}


     var options_a = {
       chart: {
         title: "Actividades en el curso.",
         subtitle: "Usuarios que contestaron N actividades."
       },
       width: 900,
       height: 400
     };

     var chart_a = new google.charts.Line(document.getElementById('actividades'));

     chart_a.draw(data_a, options_a);

}
</script>

</head>
<body>
@extends('app') @section('content')
<center> <h4>Información de "{{$course_name}}"</h4></center>
<br><br>
<div class="container">
  <div class="row">
    <h4>Inscritos semana a semana desde que se abrieron inscripciones en el curso.</h4>
  <br>
    <table class="table table-hover table-bordered">
       <td><div id="line_top"></div>
       </td>
          <td><div><table class="table table-hover table-bordered">
                <tr class="success" style="font-size: medium">
                  <td>Semana #</td>
                  <td>Registrados</td>
                </tr>
                <?php
                for($i = 0; $i < sizeof($semanal); $i++ ){?>
                  <tr>
                  <td>{{$i+1}}</td>
                  <td>{{$semanal[$i]}}</td>
                  </tr>

              <?php } ?>
                </table>
                <a class="btn btn-default" href="{{url ('/download/semanal.csv')}}" role="button">Descargar archivo semanal.csv</a>
          </div></td>

    </table>

    <br>
  </div>
  </div>

  <div class="container">
    <div class="row">
    <br>
    <h4>Actividades completadas por alumnos.</h4>

    <table class="table table-hover table-bordered">
       <td><div id="actividades"></div>
       </td>
          <td><div><table class="table table-hover table-bordered">
                <tr class="primary" style="font-size: medium">
                  <td>Actividades #</td>
                  <td>Alumnos</td>
                </tr>
                <?php
                for($i = 1; $i < sizeof($activities_activities); $i++ ){?>
                  <tr>
                  <td>{{ $activities_activities[$i] }}</td>
                  <td>{{ $activities_users[$i]}}</td>
                  </tr>

              <?php } ?>
                </table>
                <a class="btn btn-default" href="{{url ('/download/complete_activities.csv')}}" role="button">Descargar archivo actividades.csv</a>
          </div></td>

    </table>

</div>
</div>

  <div class="container">
    <div class="row">
    <br>
    <h4>Registro diario de alumnos que tuvierón actividad en el curso.</h4>
  <table class="table table-hover table-bordered">
    <td><div id="line_top_x"></div></td>
      <br>
      <td><a class="btn btn-default" href="{{url ('/download/desercion.csv')}}" role="button">Descargar archivo desercion.csv</a></td>
  </table>

</div>
</div>

<div class="container">
  <div class="row">
        <br>
        <h4>Alumnos con registro de actividad a lo largo del curso.</h4>
      <table class="table table-hover table-bordered">
        <td><div id="line_top_y"></div></td>
          <br>
          <td><a class="btn btn-default" href="{{url ('/download/historico.csv')}}" role="button">Descargar archivo historico.csv</a></td>
      </table>

    </div>
  </div>


</body>
@endsection
