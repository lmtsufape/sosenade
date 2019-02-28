@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
	<h1>Alunos cadastrados</h1>
	<table class="table table-hover table-bordered">
 		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>CPF</th>
				<th>Email</th>
				<th>Curso</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach($alunos as $aluno)
				<tr>
					<td>{{$aluno->aluno_id}}</td>
					<td>{{$aluno->nome}}</td>
					<td>{{$aluno->cpf}}</td>
					<td>{{$aluno->email}}</td>
					<td>{{$aluno->curso_nome}}</td>
					<td> 
						<a href="{{route('edit_aluno', ['id' => $aluno->aluno_id])}}">Editar</a> - <a href="{{route('delete_aluno', ['id' => $aluno->aluno_id])}}">Remover</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	<div class="col-md-12 text-center">
		<br><a class="btn btn-primary" href="{{route('new_aluno')}}"> Inserir novo </a><br>
	</div>
@stop