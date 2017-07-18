@extends('app') @section('content')

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1> Reporte mensual de constancias en MéxicoX </h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
			{!! Form::open(['url' => 'getReporteMensual', 'class' => 'form-inline' ]) !!}

					<br>
					<br>
					{!! Form::label('fecha_inicio', 'Fecha inicio del reporte') !!}
					<br>
					{!! Form::date('fecha_inicio', \Carbon\Carbon::now()) !!}

					<br>
					<br>
					{!! Form::label('fecha_fin', 'Fecha fin del reporte') !!}
					<br>
					{!! Form::date('fecha_fin', \Carbon\Carbon::now()) !!}

					<br>
					<br>
					{!! Form::submit('Generar Reportes', ['class' => 'btn btn-danger']) !!}

			{!! Form::close() !!}
    </div>
</div>
<br>
<br>
@if(isset($inscritos_totales))
<div class="row">
    <div class="col-md-6 col-md-offset-3">
			<table class="table table-bordered">
  			<tr class="info">
					<td colspan="4">Reporte mensual</td>
				</tr>
				<tr>
					<td>Mes</td>
					<td>Registrados en la plataforma</td>
					<td>Registrados cursos</td>
					<td>Constancias generadas</td>
				</tr>
					<?php $j = 0; $total_inscritos_t = 0; $total_inscritos_c = 0; $total_constancias = 0;?>
				@for($j = 0; $j < sizeof($inscritos_totales); $j++)
				<tr>
					@if(isset($inscritos_totales[$j]->m))
						<td>{!! $inscritos_totales[$j]->m !!}</td>
					@else
						<td>0</td>
					@endif

					@if(isset($inscritos_totales[$j]->c))
						<td>{!! $inscritos_totales[$j]->c !!}</td>
						<?php $total_inscritos_t = $total_inscritos_t + $inscritos_totales[$j]->c; ?>
					@else
						<td>0</td>
					@endif

					@if(isset($inscritos_curso[$j]->c))
						<td>{!! $inscritos_curso[$j]->c !!}</td>
						<?php  $total_inscritos_c = $total_inscritos_c + $inscritos_curso[$j]->c ;?>
					@else
						<td>0</td>
					@endif

					@if(isset($constancias[$j]->c))
						<td>{!! $constancias[$j]->c !!}</td>
						<?php $total_constancias = $total_constancias + $constancias[$j]->c;  ?>
					@else
						<td>0</td>
					@endif
				</tr>
				@endfor
				<tr>
					<td class="active">Totales:</td>
					<td class="active">{!! $total_inscritos_t !!}</td>
					<td class="active">{!! $total_inscritos_c !!}</td>
					<td class="active">{!! $total_constancias !!}</td>
				</tr>
			</table>
    </div>
</div>
@endif
@endsection
