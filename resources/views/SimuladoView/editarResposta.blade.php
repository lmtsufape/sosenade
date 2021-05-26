@extends('layouts.app')
@section('titulo','Simulado')
@section('content')

	<form class="shadow p-3 bg-white rounded" action= "{{route('update_answ',['id'=>$resposta->id])}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="simulado_id" value="{{$simulado['id']}}"> 
		<input type="hidden" name="resposta_id" value="{{$resposta['id']}}"> 
		<input type="hidden" name="questao_id" value="{{$questao['id']}}">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="display-4 text-center">Revisar Respostas</h2><br>
				</div>
			</div>
			<div class="card row">
				<div class="card-header">
					<h4 class="card-text"> {!! $questao['enunciado']!!} </h4>
				</div>
				<div class="card-body">
					<h5 class="card-title">Selecione a (nova) resposta correta:</h5>
					<div class="list-group container">

						<input type="radio" name="alternativa" id="radioa" value="0" required autofocus @if($resposta->alternativa_questao == "0") checked @endif />
						<label class="list-group-item" for="radioa">A - {!! nl2br($questao['alternativa_a'])!!}</label>

						<input type="radio" name="alternativa" id="radiob" value="1" @if($resposta->alternativa_questao == "1") checked @endif />
						<label class="list-group-item" for="radiob">B - {!!nl2br($questao['alternativa_b'])!!}</label>

						<input type="radio" name="alternativa" id="radioc" value="2" @if($resposta->alternativa_questao == "2") checked @endif />
						<label class="list-group-item" for="radioc">C - {!! nl2br($questao['alternativa_c'])!!}</label>

						<input type="radio" name="alternativa" id="radiod" value="3" @if($resposta->alternativa_questao == "3") checked @endif />
						<label class="list-group-item" for="radiod">D - {!! nl2br($questao['alternativa_d'])!!}</label>

						<input type="radio" name="alternativa" id="radioe" value="4" @if($resposta->alternativa_questao == "4") checked @endif />
						<label class="list-group-item" for="radioe">E - {!! nl2br($questao['alternativa_e'])!!}</label>
					</div>
					<div class="form-group col-md-12 text-center">
						<br><a class="btn btn-primary mr-3" href="{{route('list_edit_answ',['id'=>$simulado->id])}}"> Voltar </a>
						<button onclick="atLeastOneRadio()" id="confirmar-btn" type="submit" class="btn btn-success pull-center" data-container="body" data-toggle="popover" data-placement="right" data-content="Selecione uma alternativa para prosseguir.">Salvar</button>
					</div>
				</div>
			</div>
		</div>
	</form>

<style type="text/css">
	.list-group-item {
		user-select: none;
	}

	.list-group input[type="radio"] {
		display: none;
	}

	.list-group input[type="radio"] + .list-group-item {
		cursor: pointer;
	}

	.list-group input[type="radio"] + .list-group-item:before {
		display: none;
	}

	.list-group input[type="radio"]:checked + .list-group-item {
		background-color: #e9ecef;
		color: #000;
	}

	.list-group input[type="radio"]:checked + .list-group-item:before {
		display: none;
	}
</style>

<script type="text/javascript">
	function atLeastOneRadio() {
		var chx = document.getElementsByTagName('input');
		for (var i=0; i<chx.length; i++) {
			// If you have more than one radio group, also check the name attribute
			// for the one you want as in && chx[i].name == 'choose'
			// Return true from the function on first match of a checked item
			if (chx[i].type == 'radio' && chx[i].checked) {
				return true;
			} 
		}
		// End of the loop, return false
		$('#confirmar-btn').popover('show');
		setTimeout(function() {
		    $('#confirmar-btn').popover('hide');
		}, 1500);
	}

	$(function () {
		$('#confirmar-btn').popover({
			trigger: 'manual'
		})
	})
</script>

@stop