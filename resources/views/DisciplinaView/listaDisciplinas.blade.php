@extends('layouts.app')
@section('titulo','Disciplinas Cadastradas')
@section('content')

	<div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
	    
		<h1 class="text-center">Disciplinas Cadastradas</h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>
		@if(!$disciplinas->isEmpty())
			<table class="table table-hover">
		 		<thead>
					<tr>
						<th>Nome</th>
						<th style="width: 10%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($disciplinas as $disciplina)
						<tr>
							<td style="">{{$disciplina->nome}}</td>
							<td class="btn-group"> 
								<a href="{{route('edit_disciplina',['id'=>$disciplina->id])}}" class="btn btn-sm btn-primary">Editar</a>
								<a href="{{route('delete_disciplina',['id'=>$disciplina->id])}}" class="btn btn-sm btn-danger">Remover</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem disciplinas cadastradas até o momento.</p>
		@endif

		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_disciplina')}}"> Adicionar uma nova disciplina </a><br>
		</div>

	</div>

@stop