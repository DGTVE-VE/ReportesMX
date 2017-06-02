@extends('app') @section('content')
<center> <h4>Datos de evaluaciones disponibles para el curso seleccionado.</h4></center>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                   <td class="text-primary" style="font-size: medium"><strong>student_id</strong></td>
                   <td class="text-primary" style="font-size: medium"><strong>raw_answer</strong></td>
                   <td class="text-primary" aling="right" style="font-size: medium"><strong>points_earned</strong></td>
                   <td class="text-primary" aling="right" style="font-size: medium"><strong>points_possible</strong></td>
                   <td class="text-primary" aling="right" style="font-size: medium; text-align: right;"><strong>feedback</strong></td>
                   <td class="text-primary" aling="right" style="font-size: medium; text-align: right;"><strong>feedback_text</strong></td>

               </tr>
               </thead>
                <?php $total = 0; ?>
                <?php $total1 = 0; ?>
                <?php $total2 = 0;?>

                <?php $l = 0;?>
                @foreach ($consulta1EP as $i)
                <tbody>
                    <tr>
                        <td aling="right">{{$i->student_id}}</td>
                        <td aling="right">{{$i->raw_answer}}</td>
                        <td aling="right">{{$i->points_earned}}</td>
                        <td align="right">{{ number_format($i->points_possible)}}</td>
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
