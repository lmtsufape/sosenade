@extends('layouts.default')
@section('content')
    
	
	<form class="shadow p-3 mb-5 bg-white rounded" action= "/adicionar/questaoCoordenador" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<h1 class="text-center"> Cadastrar Questao </h1><br><br>	

	    <div class="form-group col-md-6">
	      <label for="enunciado">Enunciado</label>
	      <input type="text" name="enunciado" id="enunciado" placeholder="enunciado" class="form-control{{ $errors->has('enunciado') ? ' is-invalid' : '' }}" value="{{ old('enunciado') }}" required autofocus>
	      @if ($errors->has('enunciado'))
	        <span class = "invalid-feedback" role="alert">
	          {{$errors->first('enunciado')}}
	        </span>
	      @endif
	    </div>

 

	    <div class="form-group col-md-6">
	      <label for="alternativa_a">alternativa_a</label>
	      <input type="alternativa_a" id="alternativa_a" name="alternativa_a" placeholder="alternativa_a" class="form-control{{ $errors->has('alternativa_a') ? ' is-invalid' : '' }}" value="{{ old('alternativa_a') }}" required autofocus>
	      @if ($errors->has('alternativa_a'))
	    	<span class = "invalid-feedback" role="alert">
	    		{{$errors->first('alternativa_a')}}
	    	</span>
	    	@endif
	    </div>


	    
	  <div class="form-group col-md-6">
	    <label for="alternativa_b">alternativa_b</label>
	    <input type="text" id="alternativa_b" name="alternativa_b" placeholder="alternativa_b" class="form-control{{ $errors->has('alternativa_b') ? ' is-invalid' : '' }}" value="{{ old('alternativa_b') }}" required autofocus>
	  	@if ($errors->has('alternativa_b'))
	    	<span class = "invalid-feedback" role="alert">
	    		{{$errors->first('alternativa_b')}}
	    	</span>
	    @endif
	  </div>
		
	  <div class="form-group col-md-6">
	      <label for="alternativa_c">alternativa_c</label>
	      <input type="text" name="alternativa_c" id="alternativa_c" placeholder="alternativa_c" class="form-control{{ $errors->has('alternativa_c') ? ' is-invalid' : '' }}" value="{{ old('alternativa_c') }}" required autofocus>
	      @if ($errors->has('alternativa_c'))
	        <span class = "invalid-feedback" role="alert">
	          {{$errors->first('alternativa_c')}}
	        </span>
	      @endif
	    </div>

		<div class="form-group col-md-6">
	      <label for="alternativa_d">alternativa_d</label>
	      <input type="text" name="alternativa_d" id="alternativa_d" placeholder="alternativa_d" class="form-control{{ $errors->has('alternativa_d') ? ' is-invalid' : '' }}" value="{{ old('alternativa_d') }}" required autofocus>
	      @if ($errors->has('alternativa_d'))
	        <span class = "invalid-feedback" role="alert">
	          {{$errors->first('alternativa_d')}}
	        </span>
	      @endif
	    </div>

		<div class="form-group col-md-6">
	      <label for="alternativa_e">alternativa_e</label>
	      <input type="text"  name="alternativa_e" id="alternativa_e" placeholder="alternativa_e" class="form-control{{ $errors->has('alternativa_e') ? ' is-invalid' : '' }}" value="{{ old('alternativa_e') }}" required autofocus>
	      @if ($errors->has('alternativa_e'))
	        <span class = "invalid-feedback" role="alert">
	          {{$errors->first('alternativa_e')}}
	        </span>
	      @endif
	    </div>

		<div class="form-group col-md-6">
	      <label for="alternativa_correta">alternativa_correta</label>
	      <input type="text" name="alternativa_correta" id="alternativa_correta" placeholder="alternativa_correta" class="form-control{{ $errors->has('alternativa_correta') ? ' is-invalid' : '' }}" value="{{ old('alternativa_correta') }}" required autofocus>
	      @if ($errors->has('alternativa_correta'))
	        <span class = "invalid-feedback" role="alert">
	          {{$errors->first('alternativa_correta')}}
	        </span>
	      @endif
	    </div>

		<div class="form-group col-md-4">
	      <label for="dificuldade">dificuldade</label>
	      <input type="text"  name="dificuldade" id="dificuldade" placeholder="dificuldade" class="form-control{{ $errors->has('dificuldade') ? ' is-invalid' : '' }}" value="{{ old('dificuldade') }}" required autofocus>
	      @if ($errors->has('dificuldade'))
	        <span class = "invalid-feedback" role="alert">
	          {{$errors->first('dificuldade')}}
	        </span>
	      @endif
	    </div>

	    

		<div class="form-group col-md-4">
	      	<label for="disciplina_id">Diciplina</label>
	      	<select name="disciplina_id" class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>	
				@foreach ($disciplinas as $disciplina)
				<option value="{{$disciplina->id}}" {{old('disciplina') == $disciplina->id ? 'selected' : '' }}   >{{$disciplina->nome}} </option>
				@endforeach
			</select>
			@if ($errors->has('disciplina_id'))
	    		<span class = "invalid-feedback" role="alert">
	    			{{$errors->first('disciplina_id')}}
	    		</span>
	    	@endif
	    </div>
	  </div>
	  
	  <button type="submit" name="cadastrar" class="btn btn-primary float-right">Cadastrar</button><br><br>

	</form>

@stop