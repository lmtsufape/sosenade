@extends('layouts.relatorios')
@section('titulo','Relatório de Desempenho Por Simulado')
@section('date',$date)
@section('content')
    <table class="table table-bordered table-striped">
 		<thead class="table thead">
			<tr>
				<th>Título do Simulado</th>
				<th>Quantidade de Alunos Que Responderam</th>
				<th>Quantidade de Questões</th>
				<th>Média Geral de Acertos</th>
			</tr>
		</thead>
		<tbody>
			@foreach($simulados as $simulado)
				<tr class="linha">
					<td>{{$simulado->simulado->descricao_simulado}}</td>
					<td>{{$simulado->numero_respostas}}</td>
					<td>{{$simulado->questaos->count()}}</td>
					<td>{{$simulado->media_alunos}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop