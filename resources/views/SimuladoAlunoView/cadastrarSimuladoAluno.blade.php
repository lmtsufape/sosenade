@extends('layouts.default')
@section('content')
	<h1>Cadastrar Simulado Aluno</h1><br><br>
	<form action = "/adicionar/simuladoaluno" method = "post">
		<input type = "hidden" name="_token" value="{{csrf_token()}}">

		ID do Aluno:
		 <select name="aluno_id">
		 	@foreach ($alunos as $aluno)
		  	<option value="{{$aluno->id}}"> {{$aluno->id}}</option>
		  	@endforeach
			</select> 
		Id do Simulado:
		 <select name="simulado_id">
		 	@foreach ($simulados as $simulado)
		  	<option value="{{$simulado->id}}"> {{$simulado->id}}</option>
		  	@endforeach
			</select> 
			
			
		<input type='submit' value='cadastrar'/>
	</form>
@stop