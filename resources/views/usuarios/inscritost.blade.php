<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

  var mes1 = {!!$mes1!!};
  var mes2 = {!!$mes2!!};

  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data1 = new google.visualization.DataTable();
    var data2 = new google.visualization.DataTable();
    var data0 = new google.visualization.DataTable();
    var data3 = new google.visualization.DataTable();

    data1.addColumn('number', 'Mes (Desde Febrero del 2015)' );
    data2.addColumn('number', 'Mes (Desde Febrero del 2015)' );
    data1.addColumn('number', 'Por mes en plataforma');
    data2.addColumn('number', 'Por mes en plataforma');
    data3.addColumn('number', 'Número de cursos' );
    data3.addColumn('number', 'Alumnos registrados');

    data0.addColumn('number', 'Número de cursos' );
    data0.addColumn('number', 'Alumnos registrados');



    <?php foreach ($users_course as $key): ?>
    data0.addRows([
      [{{$key->n}},  {{$key->users}}],
    ]);
    <?php endforeach; ?>


    <?php for($k = 0; $k < sizeof($nn) ; $k++){?>

        data3.addRows([
          [{{$nn[$k]}}, {{$inscritos_nc[$nn[$k]]}}],
          ]);

    <?php } ?>


    for (var i = 0 ; i <= mes1.length ; i++){
      if(mes1[i]){
        data1.addRows([
          [i,  parseInt(mes1[i])],
        ]);
      }else{
        data1.addRows([
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

    var options1 = {

      chart: {

        title: 'Cantidad de usuarios registrados',
        subtitle: 'Por mes en MÃ©xicoX'
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
    var options0 = {

      chart: {

        title: 'Alumnos inscritos en N cursos',
      },
      width: 900,
      height: 400,
      colors: ['orange']
    };

    var options3 = {

      chart: {

        title: 'Alumnos inscritos en N cursos y que obtubieron constancia',
      },
      width: 900,
      height: 400,
      colors: ['red']
    };

    var chart1 = new google.charts.Line(document.getElementById('line_top_x'));
    var chart2 = new google.charts.Line(document.getElementById('line_top_y'));
    var chart0 = new google.charts.Line(document.getElementById('line_top'));
    var chart3 = new google.charts.Line(document.getElementById('line_top_z'));


    chart1.draw(data1, options1);
    chart2.draw(data2, options2);
    chart0.draw(data0, options0);
    chart3.draw(data3, options3);


  }
  </script>
</head>
<body>
  @extends('app') @section('content')

  <center> <h4>Información de todos los cursos de MéxicoX</h4></center>
  <br>
  <div class="container">
    <div class="row">
  <div><table class="table table-hover table-bordered" style="font-size: small">
    <tr class="info">
      <td>
        Número de instructores en la plataforma
      </td>
      <td>
        {{$n_instructores}}
      </td>
    </tr>
  </table></div>
</div>
</div>
  <br>
  <div class="container">
    <div class="row">
      <br>
      <center><h4>Constancias emitidas en la plataforma:  {{$constancias}}</h4></center>
      <br>
      <div><table class="table table-hover table-bordered" style="font-size: small">
        <tr class="danger" style="font-size: small">
          <td>ID Curso</td>
          <td>Constancias emitidas</td>
          <td>Inscritos en curso</td>
          <td>Eficiencia en porcentaje</td>
        </tr>
        <?php for( $k = 0 ; $k < sizeof($lista_constancias) ; $k++){ ?>
          <tr>
            <td><?php if($inscrito_curso[$k]==NULL || $inscrito_curso[$k][0]->course_name == ""){
                        print_r($lista_constancias[$k]->nombre_curso);
                      }else {
                        print_r($inscrito_curso[$k][0]->course_name);
                      } ?></td>
            <td><?php print_r($lista_constancias[$k]->constancias); ?></td>
            <td><?php if($inscrito_curso[$k]==NULL)
                         print_r('0000');
                        else {
                          print_r($inscrito_curso[$k][0]->inscritos);
                        }?></td>
            <td><?php if($inscrito_curso[$k] != NULL)
                          print_r(round(($lista_constancias[$k]->constancias/($inscrito_curso[$k][0]->inscritos)*100),2));?></td>
          </tr>
        <?php } ?>
      </table></div>


      <h4>Usuarios que se registran a N cursos.</h4>
      <table class="table table-hover table-bordered">
        <td><div id="line_top"></div></td>
      <td><div><table class="table table-hover table-bordered" style="font-size: small">
        <tr class="active" style="font-size: small">
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
      <a class="btn btn-default" href="{{url ('/download/usuarios_curso.csv')}}" role="button">Descargar archivo usuarios_curso.csv</a>
    </div></td>
  </table>

  <h4>Usuarios que se registran a N cursos y que obtubieron constancia.</h4>
  <table class="table table-hover table-bordered">
    <td><div id="line_top_z"></div></td>
  <td><div><table class="table table-hover table-bordered" style="font-size: small">
    <tr class="danger" style="font-size: small">
      <td>Número de cursos</td>
      <td>Alumnos registrados</td>
    </tr>

    <?php for($k = 0; $k < sizeof($nn) ; $k++){?>
      <tr>
        <td>
          {{$nn[$k]}}
        </td>
        <td>
          {{$inscritos_nc[$nn[$k]]}}
        </td>
      </tr>
    <?php } ?>

  </table>
   <a class="btn btn-default" href="{{url ('/download/usuarios_curso_constancia.csv')}}" role="button">Descargar archivo usuarios_curso.csv</a>
  </div></td>
  </table>

      <h4>Grafica que muestra las estadísticas mes a mes desde febrero del 2015, de todos los usuarios que se registran en MéxicoX</h4>

      <table class="table table-hover table-bordered">
        <td><div id="line_top_x"></div></td>

        <td><div><table class="table table-hover table-bordered">
          <tr class="info" style="font-size: medium">
            <td>Mes</td>
            <td>Registrados</td>
          </tr>
          <?php $i = 1; foreach ($mes1 as $m): ?>
            <tr>
              <td><?php print_r($i); ?></td>
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
        <?php $i = 1; foreach ($mes2 as $m): ?>
          <tr>
            <td><?php print_r($i); ?></td>
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
