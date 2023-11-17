@extends('layouts.relatorios')
@section('titulo','Questões Cadastradas Por Disciplina')
@section('date',$date)
@section('content')
	@foreach($disciplinas as $disciplina)
		<div class="bg-light">
		    <table class="table table-bordered">
		 		<thead class="thead-dark">
					<tr>
						<th colspan="2" style="font-weight: normal;">Nome da Disciplina: <b>{{$disciplina->nome}}</b> - Nº de Questões: <b>{{$disciplina->questaos->count()}}</b></th>
					</tr>
				</thead>
			</table>
			@if($disciplina->questaos->count())
				<table class="px-2 table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2" style="font-weight: normal;">Dificuldade: <b>Fácil</b> - Nº de Questões: <b>{{$disciplina->questaos_facil->count()}}</b></th>
						</tr>
					</thead>
					<tbody>
						@if($disciplina->questaos_facil->count())
							@foreach($disciplina->questaos_facil as $questao_facil)
								<tr>
									<td>
										{{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace('/nbsp|<br>/', ' ', $questao_facil->enunciado)), $limit = 50, $end = '...') }}
									</td>
									<td>
										@if($questao_facil->respostas->count())
											{{($questao_facil->respostas->where("acertou")->count()*100)/$questao_facil->respostas->count()}}%
										@else
											Nenhuma resposta.
										@endif
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="2"><b>Nenhuma questão.</b></td>
							</tr>
						@endif
					</tbody>
				</table>
				<table class="px-2 table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2" style="font-weight: normal;">Dificuldade: <b>Médio</b> - Nº de Questões: <b>{{$disciplina->questaos_medio->count()}}</b></th>
						</tr>
					</thead>
					<tbody>
						@if($disciplina->questaos_medio->count())
							@foreach($disciplina->questaos_medio as $questao_medio)
								<tr>
									<td>
										{{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace('/nbsp|<br>/', ' ', $questao_medio->enunciado)), $limit = 50, $end = '...') }}
									</td>
									<td>
										@if($questao_medio->respostas->count())
											{{($questao_medio->respostas->where("acertou")->count()*100)/$questao_medio->respostas->count()}}%
										@else
											Nenhuma resposta.
										@endif
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="2"><b>Nenhuma questão.</b></td>
							</tr>
						@endif
					</tbody>
				</table>
				<table class="px-2 table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2" style="font-weight: normal;">Dificuldade: <b>Difícil</b> - Nº de Questões: <b>{{$disciplina->questaos_dificil->count()}}</b></th>
						</tr>
					</thead>
					<tbody>
						@if($disciplina->questaos_dificil->count())
							@foreach($disciplina->questaos_dificil as $questao_dificil)
								<tr>
									<td>
										{{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace('/nbsp|<br>/', ' ', $questao_dificil->enunciado)), $limit = 50, $end = '...') }}
									</td>
									<td>
										@if($questao_dificil->respostas->count())
											{{($questao_dificil->respostas->where("acertou")->count()*100)/$questao_dificil->respostas->count()}}%
										@else
											Nenhuma resposta.
										@endif
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="2"><b>Nenhuma questão.</b></td>
							</tr>
						@endif
					</tbody>
				</table>
			@else
				<p class="pl-2"><b>Nenhuma questão.</b></p>
			@endif
		</div>
	@endforeach
@stop