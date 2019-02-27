@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
		<h1>Questões Cadastradas</h1><br>

		<table class="table">
	 		<thead>
			
				<tr>
					<th>Numº Questao</th>
					<th>Enunciado</th>
					<th>Nivel Questão</th>
					<th>ID da Disciplina</th>
					<th>Funções</th>
				</tr>
			</thead>
			<tbody>
				<p type="hidden" value="{{ $x = 1 }}"></p>
				@foreach($questaos as $questao)
					<tr>
						<td>{{$x++}}</td>
						<td>{{preg_replace('/<[^>]*>|[&;]/', '', $questao->enunciado) }}</td>
						<td>{{$questao->dificuldade}}</td>
						<td>{{$questao->nome}}</td>
						<td> <a href='/editar/questao/{{$questao->qtsid}}'>Editar</a> - <a href='/remover/questao/{{$questao->qtsid}}'>Remover</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="/cadastrar/questao"> Inserir nova </a><br>
		</div>

	</div>
@stop