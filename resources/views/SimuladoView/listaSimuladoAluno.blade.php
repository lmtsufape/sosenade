@extends('layouts.app')
@section('titulo','Simulados')
@section('content')

	<div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">

		<h1 class="text-center"> Simulados </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
		  		<a class="nav-link active" id="disponiveis-tab" data-toggle="tab" href="#disponiveis" role="tab" aria-controls="disponiveis" aria-selected="true">Disponíveis</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="realizados-tab" data-toggle="tab" href="#realizados" role="tab" aria-controls="realizados" aria-selected="false">Realizados</a>
			</li>
		</ul>

		<div class="tab-content" id="myTabContent">

			<div class="tab-pane fade show active" id="disponiveis" role="tabpanel" aria-labelledby="disponiveis-tab">
				<div class="list-group list-group-flush">
					@if (!empty($simulados))
						@foreach ($simulados as $simulado)
							<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="{{route('startSimulado', ['id'=>$simulado->id])}}">
								{{$simulado->descricao_simulado}} <span class="badge badge-primary badge-pill">{{$simulado->questaos_count}}</span>
							</a>
						@endforeach
					@else
						<br>
						<p class="text-center alert alert-light">Você não tem simulados disponíveis</p>
					@endif
				</div>
			</div>

			<div class="tab-pane fade" id="realizados" role="tabpanel" aria-labelledby="realizados-tab">
				<div class="list-group list-group-flush">
					@if (!empty($simulados_feitos))
						@foreach ($simulados_feitos as $simulado)
							<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="{{route('startSimulado', ['id'=>$simulado->id])}}">
								{{$simulado->descricao_simulado}} <span class="badge badge-secondary badge-pill">{{$simulado->questaos_count}}</span>
							</a>
						@endforeach
					@else
						<br>
						<p class="text-center alert alert-light">Você ainda não fez nenhum simulado</p>
					@endif
				</div>
			</div>

		</div>

	</div>

@stop