@extends('layouts.default')
@section('content')
	<h1>Cadastrar Questao Simulado</h1><br><br>
	<form action = "/adicionar/questaosimulado" method = "post">
		<input type = "hidden" name="_token" value="{{csrf_token()}}">

		Id da Questao:
		 <select name="questao_id" required>
		 	@foreach ($questaos as $questao)
		  	<option value="{{$questao->id}}" > {{$questao->id}}</option>
		  	@endforeach
			</select> 
		Id do Simulado:
		 <select name="simulado_id" required>
		 	@foreach ($simulados as $simulado)
		  	<option value="{{$simulado->id}}" > {{$simulado->id}}</option>
		  	@endforeach
			</select> 
			
			
		<input type='submit' value='cadastrar'/>
	</form>
@stop