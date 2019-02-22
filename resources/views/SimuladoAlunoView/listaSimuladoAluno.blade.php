@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
	<h1> Lista de Simulado dos Alunos </h1><br><br>
	<table class="table">
 		<thead>
		
			<tr>
				<th>Id do Simulado Aluno </th>
				<th>Id do Aluno</th>
				<th>Id do Simulado</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($simuladoAlunos as $simuladoAluno)
			<tr>
				<td>{{$simuladoAluno->id}}</td>
				<td>{{$simuladoAluno->aluno_id}}</td>
				<td>{{$simuladoAluno->simulado_id}}</td>
				<td>
					<a href="/editar/simuladoaluno/{{$simuladoAluno->id}}">Editar</a> -
					<a href="/remover/simuladoaluno/{{$simuladoAluno->id}}">Remover</a>
				</td>
			</tr>
			@endforeach
		</tbody>
		
	</table>
	<a href="/cadastrar/simuladoaluno"> Adicionar um Simulado Aluno</a>
@stop