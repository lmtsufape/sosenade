
@extends('layouts.default')
@section('content')
    
	<form class="shadow p-3 mb-5 bg-white rounded" action= "/atualizar/curso" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$curso->id}}">

		<h1 class="text-center"> Editar curso </h1><br><br>	

		<div class="form-row ">
	    	<div class="form-group col-md-6">
	      	<label for="curso_nome">Tipo curso</label>
	      	<input type="text" class="form-control{{ $errors->has('curso_nome') ? ' is-invalid' : '' }}"  name="curso_nome" id="curso_nome" placeholder="Nome" value="{{$curso->nome}}" required autofocus>
	    	@if ($errors->has('curso_nome'))
	    	<span class = "invalid-feedback" role="alert">
	    	<strong>{{$errors->first('curso_nome')}}
	    	</span>
	    	@endif
	    	</div> 
  	
	    	<div class="form-group col-md-4">
		      	<label for="ciclo_id">Ciclo</label>
		      	<select class="form-control{{ $errors->has('ciclo_id') ? ' is-invalid' : '' }}" name="ciclo_id" required autofocus>
					@foreach ($ciclos as $ciclo)
					<option value="{{$ciclo->id}}" {{ $curso->ciclo_id == $ciclo->id ? 'selected' : ''}}   >{{$ciclo->tipo_ciclo}}</option>
					@endforeach
				</select>
				@if ($errors->has('ciclo_id'))
		    		<span class = "invalid-feedback" role="alert">
		    			{{$errors->first('ciclo_id')}}
		    		</span>
		    	@endif


	    	</div>
	    		<div class="form-group col-md-4">
		      	<label for="unidade_id">Unidade</label>
		      	<select class="form-control{{ $errors->has('unidade_id') ? ' is-invalid' : '' }}" name="unidade_id" required autofocus>
					@foreach($unidade_academicas as $unidade_academica)
					<option value="{{$unidade_academica->id}}" {{ $curso->unidade_id == $unidade_academica->id ? 'selected' : ''}}>{{$unidade_academica->nome}}</option>
					@endforeach
				</select>
				@if ($errors->has('unidade_id'))
		    		<span class = "invalid-feedback" role="alert">
		    			{{$errors->first('unidade_id')}}
		    		</span>
		    	@endif
	    	</div>

	   	</div>

	  <button type="submit" name="editar" class="btn btn-primary float-right">Editar</button><br><br>
	</form>


@stop

