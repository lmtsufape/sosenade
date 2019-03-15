@extends('layouts.default')
@section('content')

	<div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
	    
		<h1 class="text-center">Disciplinas Cadastradas</h1>
		<h2 class="text-center">{{$nome_curso}}</h2><br>
		<table class="table table-hover">
	 		<thead>
				<tr>
					<th style="width: 70%">Nome</th>
					<th>Funções</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($disciplinas as $disciplina)
					<tr>
						<td style="">{{$disciplina->nome}}</td>
						<td> 
							<a href="{{route('edit_disciplina',['id'=>$disciplina->id])}}">Editar</a> -
							<a href="{{route('delete_disciplina',['id'=>$disciplina->id])}}">Remover</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_disciplina')}}"> Adicionar uma nova disciplina </a><br>
		</div>

	</div>

@stop