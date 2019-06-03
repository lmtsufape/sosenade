@extends('layouts.app')
@section('titulo','Simulados Cadastrado')
@section('content')

    <div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">
    
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
						<th>Descrição (Nº de Questôes)</th>
						<th>Criado por</th>
						<th>Status</th>
						<th style="width: 15%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($simulados as $simulado)
						<tr>
							<td>
								{{$simulado->descricao_simulado}}
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
							<td>{{$simulado->nome}}</td>
							<td>
								@if($simulado->data_inicio_simulado == null)
									<span>
										Não agendado
									</span>
								@elseif($simulado->data_fim_simulado->isPast())
									<span class="text-danger">
										Expirado em {{$simulado->data_fim_simulado->format('d/m H:i')}}
									</span>
								@else
									<span class="text-success">
										Agendado ({{$simulado->data_inicio_simulado->format('d/m H:i')}} - {{$simulado->data_fim_simulado->format('d/m H:i')}})
									</span>
								@endif
							</td>
							<td>
								<a href="{{route('set_simulado', ['id'=>$simulado->sim_id])}}" class="btn btn-secondary" data-placement="bottom" rel="tooltip" title="Montar"><i class="fa fa-gear"></i></a>
								<a href="{{route('edit_simulado', ['id'=>$simulado->sim_id])}}" class="btn btn-primary" data-placement="bottom" rel="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_simulado', ['id'=>$simulado->sim_id])}}" class="btn btn-danger" data-placement="bottom" rel="tooltip" title="Excluir"><i class="fa fa-trash"></i></a>
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

	<!-- Ativa todos os tooltips da pagina -->
	<script type="text/javascript"> 
		$('[rel="tooltip"]').tooltip(); 
	</script>

@stop