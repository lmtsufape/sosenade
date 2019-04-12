@extends('layouts.app')
@section('titulo','Editar Simulado')
@section('content')

<form class="shadow p-3 bg-white rounded" action= "{{route('update_simulado')}}" method="post">
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

		<div class="form-group justify-content-center row">
			<div class="col-md-5">
				<label for="descricao_simulado">Título</label>
		      	<input type="text" class="form-control{{ $errors->has('descricao_simulado') ? ' is-invalid' : '' }}"  name="descricao_simulado" id="descricao_simulado" value="{{$simulado->descricao_simulado}}" required autofocus>
		    	@if ($errors->has('descricao_simulado'))
			    	<span class = "invalid-feedback" role="alert">
			    		{{$errors->first('descricao_simulado')}}
			    	</span>
		    	@endif
	    	</div>
		   	<div class="col-md-2">
				<label for="descricao_simulado">Disponibilidade</label>
				<input name="disponibilidade" id="toggle-btn" type="checkbox" data-onstyle="success" data-offstyle="outline-dark" data-on="Disponível" data-off="Oculto" data-toggle="toggle" {{($simulado->data_inicio_simulado == null) ? "" : "checked"}} >
			</div>
	   	</div>

		<div class="form-group justify-content-center row" id="datas">
			<div class="col-md-3">
				<input type="text" name="data_inicio_simulado" class="date" id="dp1" width="230px" required autofocus placeholder="De" {{($simulado->data_inicio_simulado == null) ? "" : "value=".$simulado->data_inicio_simulado->format('d/m/Y')}}>
			</div>
			<div class="col-md-3">
				<input type="text" name="data_fim_simulado" class="date" id="dp2" width="230px" required autofocus placeholder="Até" {{($simulado->data_fim_simulado == null) ? "" : "value=".$simulado->data_fim_simulado->format('d/m/Y')}}>
			</div>
		</div>	

		<div class="form-group justify-content-center row">
			<div class="col-md-2 text-center">
				<button type="submit" name="editar" class="btn btn-primary btn-block">Editar</button>
	    	</div>
		</div>
	</form>

@stop
