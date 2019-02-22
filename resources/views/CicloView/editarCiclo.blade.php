@extends('layouts.default')
@section('content')
    
	<form class="shadow p-3 mb-5 bg-white rounded" action= "/atualizar/ciclo" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$ciclo->id}}">

		<h1 class="text-center"> Editar Ciclo </h1><br><br>	

		<div class="form-row ">
	    	<div class="form-group col-md-6">
	      	<label for="tipo_ciclo">Tipo Ciclo</label>
	      	<input type="text" name="tipo_ciclo" id="tipo_ciclo" placeholder="Nome" class="form-control{{ $errors->has('tipo_ciclo') ? ' is-invalid' : '' }}" value="{{$ciclo->tipo_ciclo}}" required autofocus>
	    	@if ($errors->has('tipo_ciclo'))
	    	<span class = "invalid-feedback" role="alert">
	    		{{$errors->first('tipo_ciclo')}}
	    	</span>
	    	@endif
	    	</div> 
	   	</div>

	  <button type="submit" name="editar" class="btn btn-primary float-right">Editar</button><br><br>
	</form>
@stop
