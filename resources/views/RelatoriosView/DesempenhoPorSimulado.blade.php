@extends('layouts.relatorios')
@section('titulo','Relatório de Desempenho Por Simulado')
@section('date',$date)
@section('content')
    <table class="table table-bordered table-striped">
 		<thead class="table thead bg-warning">
			<tr>
				<th>Título do Simulado</th>
				<th>Quantidade de Questões</th>
				<th>Quantidade de Alunos Que Responderam</th>
				<th>Média de Acertos</th>
			</tr>
		</thead>
		<tbody>
			@foreach($simulados as $simulado)
				<tr class="linha text-uppercase bg-primary">
					<td>{{$simulado->simulado->descricao_simulado}}</td>
					<td>{{$simulado->questaos->count()}}</td>
					<td>{{$simulado->numero_respostas}}</td>
					<td>{{$simulado->media_alunos}}%</td>
				</tr>
				<tr class="bg-secondary text-white">
					<td colspan="4">Questões</td>
				</tr>
				@foreach($simulado->questaos as $questao_simulados)
					<tr>
						<td class="bg-danger" colspan="3">{{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao_simulados->questao->enunciado)), $limit = 100, $end = '...') }}</td>
						<td class="bg-success" >{{count($questao_simulados->questao->respostas->where('simulado_id','=',$simulado->id)->where('acertou'))/$simulado->numero_respostas * 100}}%</td>
					</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>
@stop