@extends('layouts.app')
@section('titulo','Simulado')
@section('content')
	
	<div class="shadow p-3 mb-5 bg-white rounded">
		
		<div class="col-md-12 text-center">
			<h2>Responder simulado - {{$simulado->descricao_simulado}}</h2><br>
			<h5>Você tem <b>{{count($questaos)}}</b> questões a responder neste simulado </h5><br>
		</div>

		<table class="table form-group justify-content-center table-striped" id="dynamic_field" >
			<thead>
				<tr>
					<th style="text-align: center;">#</th>
					<th>Disciplina</th>
					<th style="text-align: center;">Nível</th>
				</tr>
			</thead>
			<tbody>
				@foreach($questaos as $questao)
					<tr>
						<td style="vertical-align:middle; text-align: center; width: 5%">
							{{($loop->index + 1)}}
						</td>
						<td style="vertical-align:middle;">
							{{$questao->nome_disciplina}}
						</td>  
						<td style="vertical-align:middle; text-align: center; width: 40%">
							@if ($questao->dificuldade == 1)
								Fácil
							@elseif ($questao->dificuldade == 2)
								Médio
							@else
								Difícil
							@endif
						</td>  
					</tr>
				@endforeach
			</tbody> 
		</table>
		
		<div class="form-group col-md-12 text-center">
			<br><a class="btn btn-primary mr-3" href="{{route('list_simulado_aluno')}}"> Voltar para lista </a>
			<a class="btn btn-success" href="{{route('qst_simulado',['id'=>$simulado->id])}}"> Responder simulado </a><br>
		</div>

	</div>
@stop