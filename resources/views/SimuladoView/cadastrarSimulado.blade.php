@extends('layouts.default')
@section('content')

<form class="shadow p-3 mb-5 bg-white rounded" action= "/adicionar/simulado" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		
		<h1 class="text-center"> Cadastrar simulado </h1><br><br>	

		<div class="form-row ">
	    	<div class="form-group col-md-6">
	      	<label for="descricao_simulado">Descricao simulado</label>
	      	<input type="text" class="form-control{{ $errors->has('descricao_simulado') ? ' is-invalid' : '' }}"  name="descricao_simulado" id="descricao_simulado" placeholder="Descricao" value="{{ old('descricao_simulado') }}" required autofocus>
	    	@if ($errors->has('descricao_simulado'))
	    	<span class = "invalid-feedback" role="alert">
	    		{{$errors->first('descricao_simulado')}}
	    	</span>
	    	@endif
	    	</div> 
  	
	 	</div>

	  <button type="submit" name="cadastrar" class="btn btn-primary float-right">Cadastrar</button><br><br>
	</form>


@stop