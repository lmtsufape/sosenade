@extends('layouts.relatorios')
@section('titulo','Relatório de Desempenho Por Aluno')
@section('date',$date)
@section('content')
	<h3 style="text-align:center;">
		{{$total_alunos}} aluno(s) cadastrados.
	</h3>
	@foreach($resum_aluno as $aluno)
		<table>
				<thead>
					<tr>
						<th style="font-size: 14; width: 60%">{{$aluno['nome']}}</th>
						<th style="font-size: 14">Média Geral: {{$aluno['md_geral']}}%</th>
					</tr>
					@if($aluno['simulados'])
						<tr style="font-style: italic;">
							<th>Título do Simulado</th>
							<th>Média do Simulado</th>
						</tr>
					@else
						<tr style="font-style: italic;">
							<th colspan="2">Nenhum simulado respondido</th>
						</tr>
					@endif
				</thead>
				<tbody>
					@foreach($aluno['simulados'] as $simulados)
						<tr>
							<td>{{$simulados['titulo_simu']}}</td>
							<td>{{$simulados['media']}}%</td>
						</tr>
						<tr>
							<td colspan="2">
								<table>
									<thead>
										<tr style="font-style: italic;">
											<th style="font-size: 12; width: 60.2%">Nome da Disciplina</th>
											<th style="font-size: 12">Média da Disciplina</th>
										</tr>
									</thead>
									<tbody>
										@foreach($simulados['disciplinas'] as $disciplinas)
											<tr>
												<td>{{$disciplinas['nome']}}</td>
												<td>{{$disciplinas['media']}}%</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								
							</td>
						</tr>
					@endforeach
				</tbody>
		</table>
	@endforeach
@stop