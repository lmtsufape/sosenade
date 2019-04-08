@extends('layouts.relatorios')
@section('titulo','Relatório de Desempenho Por Aluno')
@section('date',$date)
@section('content')
	<h3 style="text-align:center;">
		{{$total_alunos}} aluno(s) cadastrados.
	</h3><br>
	<table class="table table-bordered">
		<thead class="thead-dark">
			<tr>
				<th>Nome do Aluno</th>
				<th>Simulados Feitos (Tx. de Acerto)</th>
				<th>Disciplinas Abrangentes (Tx. de Acerto)</th>
			</tr>
		</thead>
		<tbody>
			@foreach($resum_aluno as $aluno)
				@php ($first = true)
				@php ($count_discplina = 0)
				@foreach($aluno['simulados'] as $simulados)
					<tr>
						@if($first == true)
							<td rowspan="{{count($aluno['simulados'])}}" class="align-middle">
								{{$aluno['nome']}}
							</td>
							@php ($first = false)
						@endif
						<td class="align-middle">
							<p style="text-align:left;">
								{{$simulados['titulo_simu']}}
								<span style="float:right; font-weight: bold;">
									{{$simulados['media']}}%
								</span>
							</p>
						</td>
						<td class="align-middle">
							@foreach($simulados['disciplinas'] as $disciplinas)
								<p style="text-align:left;">
									{{$disciplinas['nome']}}
									<span style="float:right; font-weight: bold;">
										{{$disciplinas['media']}}%
									</span>
								</p>
							@endforeach
						</td>
					</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>
	<br>
@stop