@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
	<h1> Lista de Turmas </h1><br><br>
	<table class="table">
 		<thead>
			<tr>
				<th>Id</th>
				<th>ID do Aluno</th>
				<th>ID do Ciclo</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($turmas as $turma)
			<tr>
				<td>{{$turma->id}}</td>
				<td>{{$turma->aluno_id}}</td>
				<td>{{$turma->ciclo_id}}</td>
				<td> 
					<a href="{{route('edit_turma', ['id'=>$turma->id])}}">Editar</a> -
					<a href="{{route('delete_turma', ['id'=>$turma->id])}}">Remover</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<a href="{{route('new_turma')}}"> Adicionar uma Turma</a>
@stop