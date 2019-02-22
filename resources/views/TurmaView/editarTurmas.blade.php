@extends('layouts.default')
@section('content')
  
	<h1>editar Turma</h1><br><br>
	<form action = "/atualizar/turma" method = "post">
		<input type = "hidden" name="_token" value="{{csrf_token()}}">
		
		ID do Aluno:
		 <select name="aluno_id" value="{{aluno->id}}">
		 	@foreach ($alunos as $aluno)
		  	<option value="{{$aluno->id}}"> {{$aluno->id}}</option>
		  	@endforeach
			</select> 
		ID do ciclo:
		 <select name="ciclo_id">
		 	@foreach ($ciclos as $ciclo)
		  	<option value="{{$ciclo->id}}"> {{$ciclo->id}}</option>
		  	@endforeach
			</select> 
		<input type="submit" value="atualizar"/>
	</form>
@stop