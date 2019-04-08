@extends('layouts.app')
@section('titulo','Simulados Cadastrado')
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

		@if(!$simulados->isEmpty())
			<table class="table table-hover">
		 		<thead>
					<tr>
						<th>Descrição</th>
						<th>Criado por</th>
						<th>Status (Nº de Questôes)</th>
						<th style="width: 20%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($simulados as $simulado)
						<tr>
							<td>{{$simulado->descricao_simulado}}</td>
							<td>{{$simulado->nome}}</td>
							<td>
								@if($simulado->data_inicio_simulado == null)
									<span>
										Não agendado
									</span>
								@else
									<span class="text-success">
										Agendado ({{$simulado->data_inicio_simulado->format('d/m')}} - {{$simulado->data_fim_simulado->format('d/m')}})
									</span>
								@endif
								@if($simulado->questaos_count == 0)
									<span class="badge badge-danger badge-pill">
										0
									</span>
								@else
									<span class="badge badge-primary badge-pill">
										{{$simulado->questaos_count}}
									</span>
								@endif
							</td>
							<td class="btn-group">
								<a href="{{route('set_simulado', ['id'=>$simulado->sim_id])}}" class="btn btn-sm btn-secondary">Montar</a>
								<a href="{{route('edit_simulado', ['id'=>$simulado->sim_id])}}" class="btn btn-sm btn-primary">Editar</a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_simulado', ['id'=>$simulado->sim_id])}}" class="btn btn-sm btn-danger">Remover</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem simulados cadastrados até o momento.</p>
		@endif
	  
		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_simulado')}}">Adicionar um simulado</a><br>
		</div>

	</div>

@stop