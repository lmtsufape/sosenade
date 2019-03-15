@extends('layouts.default')
@section('content')
    
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
		<h1>Questões Cadastradas</h1><br>
		<table class="table table-hover">
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
				<!-- Verificar se o contador nesse local fere o modelo MVC -->
				<p type="hidden" value="{{ $x = 1 }}"></p>
				@foreach($questaos as $questao)
					<tr>
						<td>{{$x++}}</td> 
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