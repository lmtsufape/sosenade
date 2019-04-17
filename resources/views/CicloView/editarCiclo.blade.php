@extends('layouts.app')
@section('titulo','Editar Ciclo')
@section('content')
    
	<form class="shadow p-3 bg-white rounded" action= "{{route('update_ciclo')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$ciclo->id}}">

		<h1 class="text-center"> Editar Ciclo </h1><br><br>	

		<div class="form-row justify-content-center row">
	    	<div class="form-group col-md-6">
		      	<label for="tipo_ciclo">Ano do Ciclo:</label>
		      	<input type="text" name="tipo_ciclo" id="tipo_ciclo" placeholder="Nome" class="form-control{{ $errors->has('tipo_ciclo') ? ' is-invalid' : '' }}" value="{{$ciclo->tipo_ciclo}}" required autofocus>
		    	@if ($errors->has('tipo_ciclo'))
			    	<span class = "invalid-feedback" role="alert">
			    		{{$errors->first('tipo_ciclo')}}
			    	</span>
		    	@endif
	    	</div> 
	   	</div>

	  	<div class="col-md-12 text-center">
			<br><button type="submit" name="editar" class="btn btn-primary">Editar</button><br><br>
		</div>
	</form>
@stop
