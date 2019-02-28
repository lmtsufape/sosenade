@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
   
	<h1> Lista de Questao Aluno </h1><br><br>
	<table class="table">
 		<thead>
		
			<tr>
				<th>Id do Simulado Aluno </th>
				<th>Id da Questao</th>
				<th>Id do Simulado</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($questaoSimulados as $questaoSimulado)
			<tr>
				<td>{{$questaoSimulado->id}}</td>
				<td>{{$questaoSimulado->questao_id}}</td>
				<td>{{$questaoSimulado->simulado_id}}</td>
				<td>
					<a href="{{route('edit_qst_simulado', ['id'=>$questaoSimulado->id])}}">Editar</a> -
					<a href="{{route('delete_qst_simulado', ['id'=>$questaoSimulado->id])}}">Remover</a>
				</td>
			</tr>
			@endforeach
		</tbody>
		
	</table>
	<a href="{{route('new_qst_simulado')}}"> Adicionar uma Questao ao Simulado</a>
@stop