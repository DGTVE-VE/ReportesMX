@extends('cursos') @section('contentd')
<center> <h4>Puedes ver estadísticas de los siguientes cursos:</h4></center>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
                        <table class="table table-hover">
                           <thead>
                           <tr>
                                <td class="text-primary" style="font-size: medium"><strong>#</strong></td>
                               <td class="text-primary" style="font-size: medium"><strong>ID del Curso</strong></td>
                               <td class="text-primary" aling="right" style="font-size: medium"><strong>Nombre del Curso</strong></td>
                               <td class="text-primary" aling="right" style="font-size: medium"><strong>Inscritos</strong></td>
                               <td class="text-primary" aling="right" style="font-size: medium; text-align: right;"><strong>Constancias</strong></td>
                               <td class="text-primary" aling="right" style="font-size: medium; text-align: right;"><strong>Eficiencia%</strong></td>

                           </tr>
                           </thead>
                            <?php $total = 0; ?>
                            <?php $total1 = 0; ?>
                            <?php $total2 = 0;?>

                            <?php $l = 0;?>
                            @foreach ($inscritos as $i)
                           <tbody>
                                <tr>
                                    <td aling="right">{{$i->id}}</td>
                                    <td aling="right">{{$i->course_id}}</td>
                                    <td aling="right">{{$i->course_name}}</td>
                                    <td align="right">{{ number_format($i->inscritos)}}</td>
                                    <td align="right">{{number_format($i->constancias)}}</td>
                                    <td align="right">{{round($i->eficiencia,2).' %'}}</td>
                                </tr>
                             @endforeach
                             
                            @foreach ($totalesi as $i)
                               
                            <?php $total += $i->inscritos;?>
                            <?php $total1 +=$i->constancias;?>
                            <?php $total2 +=$i->eficiencia;?>
                           <?php if($i->eficiencia > 0){
                               $l++;
                           }?>
                           
                           @endforeach

                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-primary" aling="right" style="font-size: medium"><strong>Total: </strong></td>
                                <td class="text-primary" aling="right" style="font-size: medium"><strong>{{number_format($total)}}</strong></td>
                                <td class="text-primary" aling="right" style="font-size: medium; text-align: right;"><strong>{{number_format($total1)}}</strong></td>
                                <td class="text-primary" aling="right" style="font-size: medium; text-align: right;"><strong>{{round(($total2/$l),2).' %'}}</strong></td
                            </tr>
                            </tbody>
                        </table>
          		</div>
            	<a class="btn btn-default" href="{{url ('/download/totales.csv')}}" role="button">Descargar archivo csv</a>
               	</div>
    <div class="pagination-wrapper">{!!$inscritos->render()!!}</div>
</div>
@endsection
