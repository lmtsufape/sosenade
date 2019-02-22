@extends('layouts.default')
@section('content')

<form class="shadow p-3 mb-5 bg-white rounded" action= "/atualizar/simulado" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$simulado->id}}">

		<h1 class="text-center"> Editar simulado </h1><br><br>	

		<div class="form-row ">
	    	<div class="form-group col-md-6">
	      	<label for="descricao_simulado">Descricao simulado</label>
	      	<input type="text" class="form-control{{ $errors->has('descricao_simulado') ? ' is-invalid' : '' }}"  name="descricao_simulado" id="descricao_simulado" placeholder="Descricao" value="{{$simulado->descricao_simulado}}" required autofocus>
	    	@if ($errors->has('descricao_simulado'))
	    	<span class = "invalid-feedback" role="alert">
	    		{{$errors->first('descricao_simulado')}}
	    	</span>
	    	@endif
	    	</div> 
  	
	    	<div class="form-group col-md-4">
	      		<label for="curso_id">Curso</label>
	      		<select name="curso_id" class="form-control{{ $errors->has('curso_id') ? ' is-invalid' : '' }}" required autofocus>
				@foreach ($cursos as $curso)
					<option value="{{$curso->id}}" {{$simulado->curso_id == $curso->id ? 'selected' : '' }}>{{$curso->curso_nome}} 
					</option>
				@endforeach
				</select>
				@if ($errors->has('curso_id'))
	    		<span class = "invalid-feedback" role="alert">
	    			{{$errors->first('curso_id')}}
	    		</span>
	    	@endif
	    	</div>

	    		<div class="form-group col-md-4">
		      	<label for="usuario_id">Unidade</label>
		      	<select class="form-control{{ $errors->has('usuario_id') ? ' is-invalid' : '' }}" name="usuario_id" required autofocus>
					@foreach($usuarios as $usuario)
					<option value="{{$usuario->id}}" {{$simulado->usuario_id == $usuario->id ? 'selected' : '' }}  >{{$usuario->nome}}</option>
					@endforeach
				</select>
				@if ($errors->has('usuario_id'))
		    		<span class = "invalid-feedback" role="alert">
		    			{{$errors->first('usuario_id')}}
		    		</span>
		    	@endif
	    	</div>


	   	</div>

	  <button type="submit" name="editar" class="btn btn-primary float-right">Editar</button><br><br>
	</form>


@stop
