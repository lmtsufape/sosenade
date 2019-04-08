@extends('layouts.relatorios')
@section('titulo','Relatório de Desempenho Por Disciplina')
@section('date',$date)
@section('content')
    <table class="table table-bordered table-striped">
 		<thead class="table thead">
			<tr>
				<th>Nome da Disciplina</th>
				<th>Quantidade de Questões</th>
				<th>Quantidade de Respostas</th>
				<th>Taxa de Acerto</th>
			</tr>
		</thead>
		<tbody>
			@foreach($disciplinas as $disciplina)
				<tr class="linha">
					<td>{{$disciplina->nome}}</td>
					@if(count($disciplina->questaos))
						<td>{{count($disciplina->questaos)}}</td>
						@if(array_key_exists($disciplina->nome, $cont_respostas))
							<td>{{$cont_respostas[$disciplina->nome]}}</td>
							<td>{{$medias[$disciplina->nome]}}</td>
						@else
							<td colspan="2" style="font-weight: bold;">
								Não possui nenhuma resposta
							</td>
						@endif
					@else
						<td colspan="3" style="font-weight: bold;">Não possui questões</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
@stop