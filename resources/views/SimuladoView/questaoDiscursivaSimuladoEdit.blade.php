@extends('layouts.app')
@section('titulo','Simulado')
@section('content')

    <form id="form_questao_anterior" class="d-none" action= "{{route('voltar_qst_discursiva_simulado')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="simulado_id" value="{{$simulado->id}}">
		<input type="hidden" name="questao_id" value="{{$questao->id}}">

        @if($questao->corrente)
            <input type="hidden" name="corrente" value="{{$questao->corrente}}">
        @endif
    </form>

	<form class="shadow p-3 bg-white rounded" action= "{{route('salvar_voltar_qst_discursiva_simulado')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="simulado_id" value="{{$simulado->id}}">
		<input type="hidden" name="questao_id" value="{{$questao->id}}">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="display-4 text-center">Responda a questão</h2><br>
				</div>
			</div>
			<div class="card row">
				<div class="card-header">
					<h4 class="card-text"> {!! $questao->enunciado !!} </h4>
				</div>
				<div class="card-body">
					<h5 class="card-title">Escreva sua resposta:</h5>

					<div class="list-group container">
                        <textarea class="form-control summermote_alt" name="resposta" required rows="8">{{$resposta->resposta_discursiva}}</textarea>
					</div>

					<div class="col-md-12 mt-4 text-center">
						@if($questao["questao_ant"])
							<button class="btn btn-success pull-center" type="button" onclick="document.getElementById('form_questao_anterior').submit()"> << Anterior </button>
						@endif
                        <button id="confirmar-btn" type="submit" class="btn btn-success pull-center" data-container="body" data-toggle="popover" data-placement="right">Salvar resposta</button>
                        <button type="button" onclick="document.getElementById('retomar_btn').click()" class="btn btn-success pull-center"> Retormar simulado >> </button>
                        <a class="d-none" id="retomar_btn" href="{{route('qst_simulado', $simulado->id)}}"></a>
					</div>
				</div>
			</div>
		</div>
	</form>

@stop
