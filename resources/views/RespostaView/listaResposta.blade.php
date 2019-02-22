@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
	<h1> Lista de Qeustão </h1><br><br>
	<table class="table">
 		<thead>
			<tr>
				<th>ID</th>
				<th>Alternativa Questão</th>
				<th>Id do aluno</th>
				<th>Id da Questão</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($respostas as $resposta)
			<tr>
				<td>{{$resposta->id}}</td>
				<td>{{$resposta->alternativa_questao}}</td>
				<td>{{$resposta->aluno_id}}</td>
				<td>{{$resposta->questao_id}}</td>
				<td> 
					<a href="/editar/resposta/{{$resposta->id}}">Editar</a> -
					<a href="/remover/resposta/{{$resposta->id}}">Remover</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<a href="/cadastrar/resposta"> Adicionar uma Resposta</a>
@stop