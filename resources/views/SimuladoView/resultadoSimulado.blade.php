@extends('layouts.default')
@section('content')
	<div class="shadow p-3 mb-5 bg-white rounded">
		
		<div class="col-md-12 text-center">
			<h2>Resultado</h2><br>
			<h5 class="{{($resultado == 100) ? 'text-success' : ''}}">Você acertou <b>{{$resultado}}%</b> do total de {{$total}} questões </h5><br>
		</div>

		<table class="table form-group justify-content-center table-hover" id="dynamic_field" >
			<thead>
				<tr>
					<th style="text-align: center;">#</th>
					<th>Questão</th>
					<th style="text-align: center;"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($questaos as $questao)
					<tr>
						<td style="vertical-align:middle; text-align: center; width: 5%">
							{{($loop->index + 1)}}
						</td>
						<td style="vertical-align:middle;">
							<!-- O enunciado tem que levar a uma explicação da resposta da questão -->
							{{preg_replace('/<[^>]*>|[&;]/', '', $questao->enunciado) }}
						</td>  
						<td style="vertical-align:middle; text-align: center; width: 40%">
							@if($questao->alternativa_questao == $questao->alternativa_correta)
								<img src="{{asset('right.png')}}" width="8%">
							@else
								<img src="{{asset('wrong.png')}}" width="6%">
							@endif
						</td>  
					</tr>
				@endforeach
			</tbody> 
		</table>
		<div class="form-group col-md-12 text-center">
			<br><a class="btn btn-primary mr-3" href="{{route('list_simulado_aluno')}}"> Voltar para lista </a>
		</div>
	</div>
@stop