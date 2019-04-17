@extends('layouts.app')
@section('titulo','Cadastrar Ciclo')
@section('content')
	<form class="shadow p-3 bg-white rounded" action= "{{route('add_ciclo')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<h1 class="text-center"> Cadastrar Ciclo </h1><br>	

		<div class="form-row justify-content-center row">
	    	<div class="form-group col-md-6">
		      	<label for="tipo_ciclo">Ano do ciclo</label>
		      	<input type="text" name="tipo_ciclo" id="tipo_ciclo" placeholder="Digite aqui o ano do novo ciclo" class="form-control{{ $errors->has('tipo_ciclo') ? ' is-invalid' : '' }}" value="{{ old('tipo_ciclo') }}" required autofocus>
		    	@if ($errors->has('tipo_ciclo'))
			    	<span class = "invalid-feedback" role="alert">
			    		{{$errors->first('tipo_ciclo')}}
			    	</span>
		    	@endif
	    	</div> 
	   	</div>

	  	<div class="col-md-12 text-center">
			<br><button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button><br><br>
		</div>
	</form>
@stop