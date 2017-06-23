@extends('app') @section('content')
<center> <h4>Respuestas a evaluaciones disponibles para el curso seleccionado.</h4></center>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                   <td class="text-primary" style="font-size: medium"><strong>Estado</strong></td>
                   <td class="text-primary" style="font-size: medium"><strong>Intento</strong></td>
                   <td class="text-primary" style="font-size: medium"><strong>Respuesta</strong></td>
                   <td class="text-primary" style="font-size: medium"><strong>student item id</strong></td>
                   <td class="text-primary" aling="right" style="font-size: medium"><strong>Puntos Obtenidos</strong></td>
                   <td class="text-primary" aling="right" style="font-size: medium"><strong>Puntos posibles</strong></td>
                   <td class="text-primary" aling="right" style="font-size: medium; text-align: right;"><strong>Retroalimentación</strong></td>
                   <td class="text-primary" aling="right" style="font-size: medium; text-align: right;"><strong>Texto Retroalimentación</strong></td>

               </tr>
               </thead>
                <?php $total = 0; ?>
                <?php $total1 = 0; ?>
                <?php $total2 = 0;?>

                <?php $l = 0;?>
                <tbody>
                @foreach ($consulta1EP as $i)
                    <tr>
                        <td aling="right">{{$i->status}}</td>
                        <td align="right">{{$i->attempt_number}}</td>
                        <td aling="right">{{$i->raw_answer}}</td>
                        <td aling="right">{{$i->student_item_id}}</td>
                        <td aling="right">{{$i->points_earned}}</td>
                        <td aling="right">{{$i->points_possible}}</td>
                        <td align="right">{{$i->feedback}}</td>
                        <td align="right">{{$i->feedback_text}}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td></td>
                        <td></td>

                    </tr>
                </tbody>
            </table>
        </div>
        <a class="btn btn-default" href="{{url ('/download/totales.csv')}}" role="button">Descargar archivo csv</a>
    </div>
    <div class="pagination-wrapper">{!!$consulta1EP->render()!!}</div>
</div>
@endsection
