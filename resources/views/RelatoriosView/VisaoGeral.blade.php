@extends('layouts.app')
@section('titulo','Visão Geral do Sistema')
@section('content')
	
	<div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
	
		<h1 class="text-center">Visão Geral do Sistema</h1>
		<h3 class="text-center">{{$cursos->count()}} curso(s) em {{$n_unidades}} unidade(s) acadêmica(s)</h3><br>

		<div id="accordion">
			@foreach($cursos as $curso)
				<div class="card">
					<div class="card-header form-row" id="{{('heading'.$curso->id)}}">
						<button class="btn btn-block text-left" style="background-color:transparent"  data-toggle="collapse" data-target="#{{('collapse'.$curso->id)}}" aria-expanded="true" aria-controls="{{('collapse'.$curso->id)}}">
							{{$curso->curso_nome}} (<i>{{$curso->unidade->nome}}</i>) <span class="badge badge-primary badge-pill">{{$curso->ciclo->tipo_ciclo}}</span>
						</button>
					</div>
					<div id="{{('collapse'.$curso->id)}}" class="collapse" aria-labelledby="{{('heading'.$curso->id)}}" data-parent="#accordion">
						<div class="card-body">
							<div id="accordion_disc">
								<span style="font-weight: bold;">Neste curso: </span>
								<ul class="list-group list-group-flush">
									<li class="list-group-item">{{count($curso->simulados) ? count($curso->simulados) : 'Não existem' }} simulado(s) cadastrado(s).</li>
									<li class="list-group-item">{{count($curso->coordenadores) ? count($curso->coordenadores) : 'Não existem' }} coordenador(es) cadastrado(s).</li>
									<li class="list-group-item">{{count($curso->professores) ? count($curso->professores) : 'Não existem' }} professor(es) cadastrado(s).</li>
									<li class="list-group-item">{{count($curso->alunos) ? count($curso->alunos) : 'Não existem' }} aluno(s) cadastrado(s).</li>
								</ul>
								<br>
								<span style="font-weight: bold;">{{count($curso->disciplinas) ? 'Disciplinas ('.count($curso->disciplinas).'):' : 'Não existem disciplinas cadastradas' }}</span>
								@if(count($curso->disciplinas))
									@foreach($curso->disciplinas as $disciplina)
										<ul class="list-group list-group-flush">
											<li class="list-group-item list-group-item-secondary">{{$disciplina->nome}}</li>
											<li class="list-group-item">
												<ul class="list-group list-group-flush">
													@if(count($disciplina->questaos))
														<li class="list-group-item">
															{{count($disciplina->questaos_facil) ? count($disciplina->questaos_facil).' questão(ões)' : 'Nenhuma questão' }} de nível <b>FÁCIL</b>
														</li>
														<li class="list-group-item">
															{{count($disciplina->questaos_medio) ? count($disciplina->questaos_medio).' questão(ões)' : 'Nenhuma questão' }} de nível <b>MÉDIO</b>
														</li>
														<li class="list-group-item">
															{{count($disciplina->questaos_dificil) ? count($disciplina->questaos_dificil).' questão(ões)' : 'Nenhuma questão' }} de nível <b>DIFÍCIL</b>
														</li>
													@else
														<li class="list-group-item text-danger">Esta disciplina não possui questões cadastradas.</li>
													@endif
												</ul>
											</li>
										</ul>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
@stop