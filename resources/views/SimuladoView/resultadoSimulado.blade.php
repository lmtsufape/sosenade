@extends('layouts.app')
@section('titulo','Resultado do Simulado')
@section('content')
    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Resultado</h1>
                <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a> >
                    Simulados Realizados > Simulado
                </p>
            </div>

            <div class="col-sm" style="margin-top: 30px; margin-right: 20px">
                <a class="btn btn-primary" href="{{route('new_simulado')}}" style="float: right;"> Cadastrar
                    Simulado</a><br>
            </div>
        </div>

		<div class="col-md-12 text-center">
			<h3 style="margin-bottom: 0px">Você acertou <b style="color: #34ce57">{{$resultado}}%</b></h3>
                <h5 style="color: gray; margin-top: 0px;">N° de questões: {{$total}} | Acertos: {{round($resultado/100 * $total)}} | Erros: {{round((100-$resultado)/100 * $total)}}  </h5><br>
		</div>

		<table class="table form-group justify-content-center table-hover" id="dynamic_field">
			<thead>
				<tr style="color: gray; box-shadow: 2px 3px 2px 2px #b9bbbe;" >
					<th style="text-align: center;">#</th>
					<th>Questão</th>
					<th style="text-align: center;">Status</th>
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
							{{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao->enunciado)), $limit = 180, $end = '...') }}
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
