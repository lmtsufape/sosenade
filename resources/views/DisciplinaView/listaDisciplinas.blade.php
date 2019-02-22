@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
	<h1> Lista de Disciplinas </h1><br><br>
	<table class="table">
 		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Curso</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($disciplinas as $disciplina)
			<tr>
				<td>{{$disciplina->id}}</td>
				<td>{{$disciplina->nome}}</td>
				<td>{{$disciplina->curso_id}}</td>
				<td> 
					<a href="/editar/disciplina/{{$disciplina->id}}">Editar</a> -
					<a href="/remover/disciplina/{{$disciplina->id}}">Remover</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<a href="/cadastrar/disciplina"> Adicionar uma Disciplina</a>
@stop