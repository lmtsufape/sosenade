@extends('layouts.default')
@section('content')
	<h1>Cadastrar Turmas</h1><br><br>
	<form action = "/adicionar/turma" method = "post">
		<input type = "hidden" name="_token" value="{{csrf_token()}}">

		ID do Aluno:
		 <select name="aluno_id">
		 	@foreach ($alunos as $aluno)
		  	<option value="{{$aluno->id}}"> {{$aluno->id}}</option>
		  	@endforeach
			</select> 
		Id do ciclo:
		 <select name="ciclo_id">
		 	@foreach ($ciclos as $ciclo)
		  	<option value="{{$ciclo->id}}"> {{$ciclo->id}}</option>
		  	@endforeach
			</select> 
			
			
		<input type='submit' value='cadastrar'/>
	</form>
@stop