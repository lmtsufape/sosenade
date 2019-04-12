@extends('layouts.app')
@section('titulo','Editar Alunos')
@section('content')

	@if(Session::has('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ Session::get('message', '') }}
		</div>
	@elseif(Session::has('fail'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ Session::get('message', '') }}
		</div>
	@endif

	<div class="shadow p-3 bg-white rounded">

		<h1 class="text-center"> Editar Aluno </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

		<form action= "{{route('update_aluno')}}" method="post">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="id" value="{{$aluno->id}}">
			<input type="hidden" name="password" value="{{$aluno->password}}">
			<div class="form-group justify-content-center row">
				<div class="form-group col-md-8">
					<label for="nome">Nome</label>
					<input type="text" name="nome" id="nome" placeholder="Nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{$aluno->nome}}" required autofocus>
					@if ($errors->has('nome'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('nome')}}
						</span>
					@endif
				</div>
			  
				<div class="form-row col-md-12 justify-content-center">
					<div class="form-group col-md-4">
						<label for="email">E-mail</label>
						<input type="text" id="email" name="email" placeholder="exemplo@exemplo" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$aluno->email}}" required autofocus>
						@if ($errors->has('email'))
							<span class = "invalid-feedback" role="alert">
								{{$errors->first('email')}}
							</span>
						@endif
					</div>

					<div class="form-group col-md-4">
						<label for="cpf">CPF</label>
						<input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }} cpf" value="{{$aluno->cpf}}" required autofocus>
						@if ($errors->has('cpf'))
							<span class = "invalid-feedback" role="alert">
								{{$errors->first('cpf')}}
							</span>
						@endif
					</div>
				</div>
			</div>

			<div class="col-md-12 text-center">
				<button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button><br><br>
			</div>
		</form>
	</div>

@stop