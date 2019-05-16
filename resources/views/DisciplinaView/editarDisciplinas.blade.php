@extends('layouts.app')
@section('titulo','Editar Disciplina')
@section('content')

	<form class="shadow p-3 bg-white rounded" action= "{{route('update_disciplina')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type = "hidden" name="id" value="{{$disciplina->id}}">

		<h1 class="text-center"> Editar Disciplina/Conteúdos </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

	  <div class="form-row "  >
	    <div class="form-group col-md-6 offset-md-3"  >
	      <input type="text" name="nome" id="nome" placeholder="Nome Disciplina/Conteúdo" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{$disciplina->nome}}" required autofocus>
	      @if ($errors->has('nome'))
	        <span class = "invalid-feedback" role="alert">
	          <strong>{{$errors->first('nome')}}</strong>
	        </span>
	      @endif
	    </div>

		</div>
		<div class="col-md-12 text-center">
			<br><button type="submit" name="Editar" class="btn btn-primary">Salvar alterações</button><br><br>
		</div>
	</form>
@stop
