@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
	<h1>Lista de Questões Cadastradas</h1>
	<table class="table">
 		<thead>
		
			<tr>
				<th>Numº Questao</th>
				<th>Enuciado</th>
				<th>Nivel Questão</th>
				<th>ID da Disciplina</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach($questaos as $questao)
			<tr>
				<td>{{$questao->id}}</td>
				<td>{{preg_replace('/<[^>]*>|[&;]/', '', $questao->enunciado) }}</td>
				<td>{{$questao->dificuldade}}</td>
				<td>{{$questao->disciplina_id}}</td>

	

				<td> <a href='/editar/questao/{{$questao->id}}'>Editar</a> - <a href='/remover/questao/{{$questao->id}}'>Remover</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
	<a href="/cadastrar/questao"> Inserir novo </a>
@stop