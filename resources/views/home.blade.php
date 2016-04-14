@extends('cursos') @section('contentd')
<center> <h4>Hola, {{$name_user}}, {{$course_name}}</h4></center>
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

                               </tr>
                           </thead>
                            <?php $total = 0; ?>
                            @foreach ($inscritos as $i)
                                   <tbody>
                                <tr>
																<td aling="right">{{$i->id}}</td>
                                <td aling="right">{{$i->course_id}}</td>
                                <td aling="right">{{$i->course_name}}</td>
                                <td align="right">{{ number_format($i->inscritos)}}</td>
                                </tr>
                                <?php $total += $i->inscritos;?>
                            @endforeach
                            <tr>
                                <td></td>
																<td></td>
                                <td class="text-primary" aling="right" style="font-size: medium"><strong>Total: </strong></td>
                                <td class="text-primary" aling="right" style="font-size: medium"><strong>{{number_format($total)}}</strong></td>
                            </tr>
                            </tbody>
                        </table>
		</div>
		<a class="btn btn-default" href="{{url ('/download/totales.csv')}}" role="button">Descargar archivo csv</a>
	</div>
</div>
@endsection
