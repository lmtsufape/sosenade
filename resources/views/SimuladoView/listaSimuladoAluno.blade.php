@extends('layouts.default')
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

		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" href="#">Disponíveis</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{route('list_simulado_feitos')}}">Realizados</a>
			</li>
		</ul>

		<table class="table table-hover table-borderless">
			<tbody>
				@if (!empty($simulados))
					@foreach ($simulados as $simulado)
						<tr>
							<td style="vertical-align:middle">
								<a style="display:block;" class="btn-link" href="{{route('startSimulado', ['id'=>$simulado->id])}}">{{$simulado->descricao_simulado}}</a>
							</td>
						</tr>
					@endforeach
				@else
					<br>
					<p class="text-center alert alert-light">Você não tem simulados disponíveis</p>
				@endif
			</tbody>
		</table>

		<br>
		
	</div>

@stop