@extends('layouts.default')
@section('content')
	<h1>Cadastrar Respostas</h1><br><br>
	<form action = "/adicionar/resposta" method = "post">
		<input type = "hidden" name="_token" value="{{csrf_token()}}">
		Alternativa marcada:<input type="text" name="alternativa_questao"/>
		ID do Aluno:
		 <select name="aluno_id">
		 	@foreach ($alunos as $aluno)
		  	<option value="{{$aluno->id}}"> {{$aluno->id}}</option>
		  	@endforeach
			</select> 
		Id da Questao:
		 <select name="questao_id">
		 	@foreach ($questaos as $questao)
		  	<option value="{{$questao->id}}"> {{$questao->id}}</option>
		  	@endforeach
			</select> 
			
			
		<input type='submit' value='cadastrar'/>
	</form>
@stop