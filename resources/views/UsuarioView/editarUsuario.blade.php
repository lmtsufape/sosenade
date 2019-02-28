@extends('layouts.default')
@section('content')

	<form class="shadow p-3 mb-5 bg-white rounded" action= "{{route('update_usuario')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$usuario->id}}">

		<input type="hidden" name="password" value="{{$usuario->password}}">

		<h1 class="text-center"> Editar Usuário </h1><br>

		<div class="form-group justify-content-center row">
			<div class="form-group col-md-8">
		  		<label for="nome">Nome</label>
		  		<input type="text" name="nome" id="nome" placeholder="Nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{$usuario->nome}}" required autofocus>
				@if ($errors->has('nome'))
					<span class = "invalid-feedback" role="alert">
			  			{{$errors->first('nome')}}
					</span>
		  		@endif
			</div>
	
			<div class="form-group col-md-4">
				<label for="cpf">CPF</label>
				<input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }} cpf" value="{{$usuario->cpf}}" required autofocus>
				@if ($errors->has('cpf'))
					<span class = "invalid-feedback" role="alert">
						{{$errors->first('cpf')}}
					</span>
				@endif
			</div>

			<div class="form-group col-md-6">
				<label for="email">E-mail</label>
				<input type="text" id="email" name="email" placeholder="exemplo@exemplo" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$usuario->email}}" required autofocus>
				@if ($errors->has('email'))
					<span class = "invalid-feedback" role="alert">
						{{$errors->first('email')}}
					</span>
				@endif
			</div>

			<div class="form-group col-md-2">
				<label for="tipousuario_id">Tipo de usuário</label>
				<select name="tipousuario_id" class="form-control{{ $errors->has('tipousuario_id') ? ' is-invalid' : '' }}" required autofocus>
					@foreach ($tipos_usuario as $tipo_usuario)
					<option value="{{$tipo_usuario->id}}" {{$usuario->tipousuario_id == $tipo_usuario->id ? 'selected' : '' }}>
						{{$tipo_usuario->tipo}}
					</option>
					@endforeach
				</select>
				@if ($errors->has('tipousuario_id'))
					<span class = "invalid-feedback" role="alert">
						{{$errors->first('tipousuario_id')}}
					</span>
				@endif
			</div>

			<div class="form-group col-md-4">
				<label for="curso_id">Curso</label>
				<select name="curso_id" class="form-control{{ $errors->has('curso_id') ? ' is-invalid' : '' }}" required autofocus>
					@foreach ($cursos as $curso)
						<option value="{{$curso->id}}" {{$usuario->curso_id == $curso->id ? 'selected' : '' }}>
							{{$curso->curso_nome}} 
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
			<button type="submit" name="editar" class="btn btn-primary">Editar</button><br><br>
		</div>

	</form>
@stop