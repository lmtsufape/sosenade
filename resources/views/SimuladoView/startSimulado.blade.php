@extends('layouts.app')
@section('titulo','Simulado')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Responder Simulado - {{$simulado->descricao_simulado}}</h1>
                <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a> >
                    Simulados Disponiveis > Responder Simulado
                </p>
            </div>
        </div>

		<div class="col-md-12 text-center">
			<h5>Você tem <b>{{count($questaos)}}</b> questões a responder neste simulado </h5><br>
		</div>

		<table class="table form-group justify-content-center table-striped" id="dynamic_field" >
			<thead>
            <tr style="color: gray;" >
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
							@elseif ($questao->dificuldade == 3)
								Difícil
                            @else
                                {{$questao->dificuldade}}
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
