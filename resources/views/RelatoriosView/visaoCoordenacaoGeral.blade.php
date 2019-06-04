@extends('layouts.app')
@section('titulo','Visão Geral do Sistema')
@section('content')
	
	<div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">
	
		<h1 class="text-center">Visão Geral do Sistema</h1>
		<h3 class="text-center">{{$cursos->count()}} curso(s) em {{($unidade->nome)}}</h3><br>
		<h4 class="text-left" style="font-weight: bold"> Unidades: </h4>
		<div id="accordion_uni">
				<div class="card">
					<div class="card-header form-row" id="{{('heading_uni'.$unidade->id)}}">
						<button class="btn btn-block text-left" style="background-color:transparent"  data-toggle="collapse" data-target="#{{('collapse_uni'.$unidade->id)}}" aria-expanded="true" aria-controls="{{('collapse_uni'.$unidade->id)}}">
							{{$unidade->nome}} <span class="badge badge-primary badge-pill">{{count($unidade->cursos)}}</span>
						</button>
					</div>
					<div id="{{('collapse_uni'.$unidade->id)}}" class="collapse" aria-labelledby="{{('heading_uni'.$unidade->id)}}" data-parent="#accordion_uni">
						<div class="card-body">
							<div id="accordion_curso">
								@if(count($unidade->cursos))
									<div id="accordion">
										@foreach($unidade->cursos as $curso)
											<div class="card">
												<div class="card-header form-row" id="{{('heading'.$curso->id)}}">
													<button class="btn btn-block text-left" style="background-color:transparent"  data-toggle="collapse" data-target="#{{('collapse'.$curso->id)}}" aria-expanded="true" aria-controls="{{('collapse'.$curso->id)}}">
														{{$curso->curso_nome}} <span class="badge badge-info">{{$curso->ciclo->tipo_ciclo}}</span>
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
								@else
									<div style="width: 100%; white-space: nowrap;">
										<span class="alert alert-danger text-center" style="display:block;" >Esta unidade não possui cursos cadastrados.</span>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
@stop