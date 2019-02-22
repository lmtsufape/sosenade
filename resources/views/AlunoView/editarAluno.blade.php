@extends('layouts.default')
@section('content')

<form class="shadow p-3 mb-5 bg-white rounded" action= "/atualizar/aluno" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$aluno->id}}">
		<input type="hidden" name="password" value="{{$aluno->password}}">



		<h1 class="text-center"> Editar aluno </h1><br><br>	

	  <div class="form-row">
	    <div class="form-group col-md-4">
	      <label for="nome">Nome</label>
	      <input type="text" name="nome" id="nome" placeholder="{{$aluno->nome}}" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ $aluno->nome }}" required autofocus >
	      @if ($errors->has('nome'))
	        <span class = "invalid-feedback" role="alert">
	          {{$errors->first('nome')}}
	        </span>
	      @endif
	    </div>
	  </div>
	  
	  <div class="form-group col-md-4">
	    <label for="email">E-mail</label>
	    <input type="text" id="email" name="email" placeholder="{{$aluno->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$aluno->email}}" required autofocus>
	  	@if ($errors->has('email'))
	    	<span class = "invalid-feedback" role="alert">
	    		{{$errors->first('email')}}
	    	</span>
	    @endif
	  </div>
	 

	     <div class="form-group col-md-4">
	    	<label for="cpf">CPF</label>
	    	<input type="text" id="cpf" name="cpf" placeholder="{{ $aluno->cpf }}" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" value="{{ $aluno->cpf }}" required autofocus>
	    	@if ($errors->has('cpf'))
	    		<span class = "invalid-feedback" role="alert">
	    			{{$errors->first('cpf')}}
	    		</span>
	    	@endif
	    </div>
	   </div>
	  	<button type="submit" name="editar" class="btn btn-primary float-right">Editar</button><br><br>
	</form>
@stop