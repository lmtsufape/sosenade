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


	<form class="shadow p-3 bg-white rounded" action= "{{route('answ_qst_discursiva_simulado')}}" method="post">
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
                        <textarea name="resposta" required rows="8"></textarea>
					</div>

					<div class="col-md-12 mt-4 text-center">
						@if($questao["questao_ant"])
							<button type="button" class="btn btn-success pull-center" onclick="document.getElementById('form_questao_anterior').submit()"> << Anterior </button>
						@endif

                        <!-- dar um jeito de voltar das objetivas pras dicursivas -->
						<button id="confirmar-btn" type="submit" class="btn btn-success pull-center" data-container="body" data-toggle="popover" data-placement="right">Próxima >></button>

                        @if($questao->avisar_que_e_a_ultima_discurssiva)
                            <script>
                                document.getElementById('confirmar-btn').onclick= function() {
                                    return confirm('Esta é a ultima questão discursiva, você não vai poder rever elas depois. Tem certeza que deseja proseeguir para as questões objetivas?');}
                            </script>
                        @endif

					</div>
				</div>
			</div>
		</div>
	</form>





@stop
