@extends('layouts.default')
@section('content')
    
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
		<h1 class="text-center">Questões Cadastradas</h1>
		<h2 class="text-center">{{$nome_curso}}</h2><br>
		<table class="table table-hover">
	 		<thead>
				<tr>
					<th>Enunciado</th>
					<th>Nível</th>
					<th>Disciplina</th>
					<th style="width: 15%">Funções</th>
				</tr>
			</thead>
			<tbody>
				@foreach($questaos as $questao)
					<tr>
						<td>{{preg_replace('/<[^>]*>|[&;]/', '', $questao->enunciado) }}</td>
						<td>{{$questao->dificuldade}}</td>
						<td>{{$questao->nome}}</td>
						<td> <a href="{{route('edit_qst', ['id'=>$questao->qtsid])}}">Editar</a> - <a href="{{route('delete_qst', ['id'=>$questao->qtsid])}}">Remover</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_qst')}}"> Inserir nova questão </a><br>
		</div>

	</div>

@stop