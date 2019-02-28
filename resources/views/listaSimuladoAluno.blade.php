@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">

		<h1> Simulados disponíveis </h1><br>

		<table class="table">
	 		<thead>
				<tr>
					<th>Nome do Simulado</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($simulados as $simulado)
					<tr>
						<td>{{$simulado->descricao_simulado}}</td>
						<td>
							<a href="{{route('qst_simulado', ['id'=>$simulado->id])}}">Responder</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop