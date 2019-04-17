@extends('layouts.app')
@section('titulo','Editar Disciplina')
@section('content')

	<form class="shadow p-3 bg-white rounded" action= "{{route('update_disciplina')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type = "hidden" name="id" value="{{$disciplina->id}}">

		<h1 class="text-center"> Editar Disciplina </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

	  <div class="form-row ">
	    <div class="form-group col-md-6">
	      <label for="nome">Nome</label>
	      <input type="text"  name="nome" id="nome" placeholder="Nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{$disciplina->nome}}" required autofocus>
	      @if ($errors->has('nome'))
	        <span class = "invalid-feedback" role="alert">
	          <strong>{{$errors->first('nome')}}</strong>
	        </span>
	      @endif
	    </div>

	    <div class="form-group col-md-4">
	      	<label for="curso_id">Curso</label>
	      	<select name="curso_id" class="form-control{{ $errors->has('curso_id') ? ' is-invalid' : '' }}" required autofocus>
				@foreach ($cursos as $curso)
				<option value="{{$curso->id}}" {{$disciplina->curso_id == $curso->id ? 'selected' : '' }}>{{$curso->curso_nome}} 
				</option>
				@endforeach
			</select>
			@if ($errors->has('curso_id'))
	    		<span class = "invalid-feedback" role="alert">
	    			{{$errors->first('curso_id')}}
	    		</span>
	    	@endif
	    </div> 

		</div>
		<div class="col-md-12 text-center">
			<br><button type="submit" name="Editar" class="btn btn-primary">Salvar alterações</button><br><br>
		</div>
	</form>
@stop
