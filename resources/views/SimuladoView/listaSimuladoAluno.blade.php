@extends('layouts.app')
@section('titulo','Simulados')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Simulados</h1>
                <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home_aluno')}}" style="color: inherit;">Início</a> >
                    Simulados
                </p>
            </div>
        </div>

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
