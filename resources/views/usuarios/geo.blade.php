@extends('app') @section('content')
<center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
<html>
<head>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsOvxr2VfN7VH4TGwZvDtkjfGrntcnQwg&callback=initMap"
  type="text/javascript"></script>
  <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>

  <script type='text/javascript'>
  google.charts.load('current', {'packages': ['geochart']});
  google.charts.setOnLoadCallback(drawMarkersMap);

  function drawMarkersMap() {
    var data = google.visualization.arrayToDataTable([
      ['Estado',   'Usuarios'],
      <?php foreach ($state as $key): ?>
        @if($key->state == 'México')
        ['Estado de México', {!!$key->cs!!}],
        @elseif($key->state != null)
          ['{!!$key->state!!}', {!!$key->cs!!}],
        @endif
      <?php endforeach; ?>
    ]);

    var options = {
      region: 'MX',
      displayMode: 'markers',
      colorAxis: {colors: ['yellow', 'greenyellow', 'green', 'blue', 'purple', 'red']}
    };

    var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  };
  </script>


  <script type="text/javascript">
  google.charts.load('current', {'packages':['geochart']});
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {

    var data0 = google.visualization.arrayToDataTable([
      ['País', 'Usuarios'],
        <?php foreach ($country as $key): ?>
          @if($key->country == 'MX')
          @elseif($key->country != null)
            ['{!!$key->country!!}', {!!$key->cc!!}],
          @endif
        <?php endforeach; ?>
    ]);



    var options0 = {
      colorAxis: {colors: ['greenyellow', 'gold', 'lime', 'green', 'aqua', 'aquamarine', 'blue', 'blueviolet', 'indigo', 'darkmagenta','darkorchid']}
    };

    var chart0 = new google.visualization.GeoChart(document.getElementById('regions_div'));

    chart0.draw(data0, options0);
  };
  </script>

  </head>
  <body>
  <br>
  <h3> <p style="text-align: center";>Usuarios por Entidad Federativa: </p> </h3>
  <div class="container">
  <div class="row table-responsive">
      <table class="table table-hover table-bordered">
        <td><div id="chart_div" style="width: 700px; height: 400px;"></div></td>
        <td><table class="table table-hover">
          <tr class="danger"><td>Estado</td><td>Usuarios</td></tr>
          <?php $i=0; $total = 0;?>
          @foreach($state as $key)
            @if($i<=10)
              <tr><td>{{$key->state}}</td><td>{{$key->cs}}</td></tr>
              <?php $i++; ?>
              @endif
              <?php $total = $total + $key->cs; ?>
              @endforeach
              <tr><td>...</td><td>...</td></tr>
              <tr class="success"><td>Total de usuarios que registraron su Entidad Federativa:</td><td>{{$total}}</td></tr>
              <tr><td><a class="btn btn-default" href="{{url ('/download/usuarios_estado.csv')}}" role="button">Descargar archivo usuarios_estado.csv</a><td><td></tr>
            </table>
          </td>
      </table>
    </div>
  </div>
  <br>

  <h3> <p style="text-align: center";>Usuarios por País: </p> </h3>
  <div class="container">
  <div class="row table-responsive">
  <table class="table table-hover table-bordered">
    <td><div id="regions_div" style="width: 700px; height: 400px;"></div></td>
    <td>
      <table class="table table-hover">
        <tr class="danger"><td>País</td><td>Usuarios</td></tr>
        <?php $i=0; $total = 0;?>
        @foreach($country as $key)
          @if($i<=10)
            <tr><td>{{$key->country}}</td><td>{{$key->cc}}</td></tr>
            <?php $i++; ?>
          @endif
          <?php $total = $total + $key->cc; ?>
        @endforeach
        <tr><td>...</td><td>...</td></tr>
        <tr class="success"><td>Total de usuarios que registraron su país:</td><td>{{$total}}</td></tr>
        <tr><td><a class="btn btn-default" href="{{url ('/download/usuarios_pais.csv')}}" role="button">Descargar archivo usuarios_pais.csv</a></td><td></td></tr>
      </table>
    </td>
  </table>
  </div>
  </div>
  </body>
  </html>
  @endsection
