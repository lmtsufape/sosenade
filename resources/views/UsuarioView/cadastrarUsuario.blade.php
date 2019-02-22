@extends('layouts.default')
@section('content')
	<form class="shadow p-3 mb-5 bg-white rounded" action= "/adicionar/usuario" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<h1 class="text-center"> Cadastrar Coordenador </h1><br><br>	

	  
	    <div class="form-group col-md-4">
	      <label for="nome">Nome</label>
	      <input type="text" name="nome" id="nome" placeholder="Nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ old('nome') }}" required autofocus>
	      @if ($errors->has('nome'))
	        <span class = "invalid-feedback" role="alert">
	          {{$errors->first('nome')}}
	        </span>
	      @endif
	    </div>

	    <div class="form-group col-md-4">
	      <label for="password">Senha</label>
	      <input type="password" id="password" name="password" placeholder="Senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" required autofocus>
	      @if ($errors->has('password'))
	    	<span class = "invalid-feedback" role="alert">
	    		{{$errors->first('password')}}
	    	</span>
	    	@endif
	    </div>
	  
	  

	    <div class="form-group col-md-4">
	      <label for="password_confirmation">Confirmar Senha</label>
	      <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Senha" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{ old('password_confirmation') }}" required autofocus>
	      @if ($errors->has('password_confirmation'))
	    	<span class = "invalid-feedback" role="alert">
	    		{{$errors->first('password_confirmation')}}
	    	</span>
	    	@endif
	    </div>


	  <div class="form-group col-md-4">
	    <label for="email">E-mail</label>
	    <input type="text" id="email" name="email" placeholder="exemplo@exemplo" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
	  	@if ($errors->has('email'))
	    	<span class = "invalid-feedback" role="alert">
	    		{{$errors->first('email')}}
	    	</span>
	    @endif
	  </div>
	  
	  
	    <div class="form-group col-md-4">
	      	<label for="curso_id">Curso</label>
	      	<select name="curso_id" class="form-control{{ $errors->has('curso_id') ? ' is-invalid' : '' }}" required autofocus>
				@foreach ($cursos as $curso)
				<option value="{{$curso->id}}" {{old('curso') == $curso->id ? 'selected' : '' }}>{{$curso->curso_nome}} 
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
	    	<label for="tipousuario_id">Tipo de usuário</label>
	      	<select name="tipousuario_id" class="form-control{{ $errors->has('tipousuario_id') ? ' is-invalid' : '' }}" required autofocus>
				@foreach ($tipos_usuario as $tipo_usuario)
				<option value="{{$tipo_usuario->id}}" {{old('tipousuario') == $tipo_usuario->id ? 'selected' : '' }}>{{$tipo_usuario->tipo}}</option>
				@endforeach
			</select>
			@if ($errors->has('tipo_usuario_id'))
	    		<span class = "invalid-feedback" role="alert">
	    			{{$errors->first('tipo_usuario_id')}}
	    		</span>
	    	@endif
	    </div>
	   
	    <div class="form-group col-md-4">
	    	<label for="cpf">CPF</label>
	    	<input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }} cpf" value="{{ old('cpf') }}" required autofocus>
	    	@if ($errors->has('cpf'))
	    		<span class = "invalid-feedback" role="alert">
	    			{{$errors->first('cpf')}}
	    		</span>
	    	@endif
	    </div>	 





	      
	    

	  	<button type="submit" name="cadastrar" class="btn btn-primary float-right">Cadastrar</button><br><br>
	</form>
@stop