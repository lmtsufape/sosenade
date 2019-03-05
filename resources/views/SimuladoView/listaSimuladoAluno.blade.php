@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">

		<h1> Simulados disponíveis </h1><br>

		<table class="table table-hover">
	 		<thead>
				<tr>
					<th>Nome do Simulado</th>
					<th style="vertical-align:middle; text-align: center; width: 40%">Opções</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($simulados as $simulado)
					<tr>
						<td>{{$simulado->descricao_simulado}}</td>
						<td style="vertical-align:middle; text-align: center; width: 40%">
							<a href="{{route('startSimulado', ['id'=>$simulado->id])}}">Ver</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop