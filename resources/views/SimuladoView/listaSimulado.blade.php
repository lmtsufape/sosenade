@extends('layouts.default')
@section('content')

    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
		<h1 class="text-center">Simulados Cadastrados</h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>
		
		<table class="table table-hover">
	 		<thead>
				<tr>
					<th>Descrição</th>
					<th>Criado por</th>
					<th style="width: 20%">Funções</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($simulados as $simulado)
					<tr>
						<td>{{$simulado->descricao_simulado}}</td>
						<td>{{$simulado->nome}}</td>
						<td>
							<a href="{{route('edit_simulado', ['id'=>$simulado->sim_id])}}">Editar</a> -
							<a href="{{route('delete_simulado', ['id'=>$simulado->sim_id])}}">Remover</a> - 
							<a href="{{route('set_simulado', ['id'=>$simulado->sim_id])}}">Montar</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	  
		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_simulado')}}">Adicionar um simulado</a><br>
		</div>

	</div>

@stop