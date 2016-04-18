@extends('app') @section('content')
<center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    var sem = {!!$semanal!!};

  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(drawChart);

function drawChart() {

  var data = new google.visualization.DataTable();

    data.addColumn('number', 'Desde {{$s}} ,hasta {{$f}}');
    data.addColumn('number', 'Incritos semanal');


    for (var i = 0 ; i <= sem.length ; i++){
    if(sem[i]){
      data.addRows([
        [i,  parseInt(sem[i])],
      ]);
    }else{
      data.addRows([
        [i,  0],
      ]);
    }



    }

  var options = {

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
      colors: ['blue']
  };

  var chart = new google.charts.Line(document.getElementById('line_top_x'));

  chart.draw(data, options);

}
</script>
</head>
<body>
<div class="container">
  <div class="row">

    <h4>Grafica que muestra el número de inscritos semana a semana.</h4>

    <table class="table table-hover">
       <td><div id="line_top_x"></div></td>

       <a class="btn btn-default" href="{{url ('/download/semanal.csv')}}" role="button">Descargar archivo csv</a>

          <td><div><table class="table table-hover">
                <tr class="info" style="font-size: medium">
                  <td>Mes</td>
                  <td>Registrados</td>
                </tr>
                <?php
                for($i = 0; $i < sizeof($semanal); $i++ ){?>
                  <tr>
                  <td>{{$i}}</td>
                  <td>{{$semanal[$i]}}</td>
                  </tr>

              <?php } ?>
                </table>
          </div></td>

    </table>
    </table>
    <br>


  </div>
  </div>


</body>
@endsection
