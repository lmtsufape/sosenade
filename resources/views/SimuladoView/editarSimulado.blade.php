@extends('layouts.default')
@section('content')

<form class="shadow p-3 mb-5 bg-white rounded" action= "{{route('update_simulado')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$simulado->id}}">
		<input type="hidden" name="curso_id" value="{{$simulado->curso_id}}">

		<h1 class="text-center"> Editar simulado </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

		<div class="form-row ">
	    	<div class="form-group col-md-6">
		      	<label for="descricao_simulado">Descricao simulado</label>
		      	<input type="text" class="form-control{{ $errors->has('descricao_simulado') ? ' is-invalid' : '' }}"  name="descricao_simulado" id="descricao_simulado" value="{{$simulado->descricao_simulado}}" required autofocus>
		    	@if ($errors->has('descricao_simulado'))
			    	<span class = "invalid-feedback" role="alert">
			    		{{$errors->first('descricao_simulado')}}
			    	</span>
		    	@endif
	    	</div>
	   	</div>

		<div class="row justify-content-center">
			<button type="submit" name="editar" class="btn btn-primary float-right">Editar</button><br><br>
		</div>
	</form>

@stop
