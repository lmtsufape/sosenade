@extends('layouts.default')
@section('content')
  
	<h1>Editar Resposta</h1><br><br>
	<form action = "/atualizar/resposta" method = "post">
		<input type = "hidden" name="_token" value="{{csrf_token()}}">
		Alternativa Questao:<input type="text" name="alternativa_questao" value="{{$resposta->alternativa_questao}}" />
		
		ID do Aluno:
		 <select name="aluno_id" value="{{aluno->id}}">
		 	@foreach ($alunos as $aluno)
		  	<option value="{{$aluno->id}}"> {{$aluno->id}}</option>
		  	@endforeach
			</select> 
		ID da Questao:
		 <select name="questao_id">
		 	@foreach ($questaos as $questao)
		  	<option value="{{$questao->id}}"> {{$questao->id}}</option>
		  	@endforeach
			</select> 
		<input type="submit" value="atualizar"/>
	</form>
@stop