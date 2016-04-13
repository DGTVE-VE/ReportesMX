@extends('app') @section('content')
<center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
            <head>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {var data = google.visualization.arrayToDataTable([
          ['', 'Hombres: {{$infot[0]}} ', 'Mujeres: {{$infot[1]}}', 'Indefinido: {{$infot[2]}}'],
          ['Genero', {{$infot[0]}}, {{$infot[1]}}, {{$infot[2]}}]]);

                    var options = {
                        chart: {
                            title: '',
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

                    var chart = new google.charts.Bar(document.getElementById('chart_div'));

                    chart.draw(data, options);
                }

            </script>


            </head>
            <body>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <br>
            <h3> <p style="text-align: center";>Usuarios por género: </p> </h3>

            <br>
                <div id="chart_div" style="width: 900px; height: 500px;"></div>
                <a class="btn btn-default" href="{{url ('/download/genero.csv')}}" role="button">Descargar archivo csv</a>
        </div>
    </div>
</div>
</body>
@endsection
