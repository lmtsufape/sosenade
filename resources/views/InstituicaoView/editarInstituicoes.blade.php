@extends('layouts.app')
@section('titulo','Cadastrar Instituição')
@section('content')
	<form class="shadow p-3 bg-white rounded" action="{{ route('update_instituicao') }}" method="post">

		<input type="hidden" name="id" value="{{ $instituicao->id }}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">

		<h1 class="text-center"> Cadastrar Instituição </h1>
		<br>

		<div class="form-group justify-content-center row">
			<div class="form-group col-md-8">
				<label for="nome">Nome</label>
				<input type="text" name="nome" id="nome" placeholder="Nome da instituição" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ $instituicao->nome }}" required autofocus>
				@if ($errors->has('nome'))
					<span class = "invalid-feedback" role="alert">
						{{$errors->first('nome')}}
					</span>
				@endif
			</div>

			<div class="form-row col-md-12 justify-content-center">
				<div class="form-group col-md-4">
					<label for="email">E-mail</label>
					<input type="text" id="email" name="email" placeholder="exemplo@exemplo.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $instituicao->email }}" required autofocus>
					@if ($errors->has('email'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('email')}}
						</span>
					@endif
			  	</div>

				<div class="form-group col-md-4">
					<label for="cnpj">CNPJ</label>
					<input type="text" id="cnpj" name="cnpj" placeholder="00.000.000/0000-00" class="form-control{{ $errors->has('cnpj') ? ' is-invalid' : '' }} cnpj" value="{{ $instituicao->cnpj }}" required autofocus>
					@if ($errors->has('cnpj'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('cnpj')}}
						</span>
					@endif
				</div>
			</div>

			<!-- <div class="form-row col-md-12 justify-content-center">
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
			</div>
		</div> -->

		<div class="col-md-12 text-center">
			<button type="submit" name="cadastrar" class="btn btn-primary">Salvar alterações</button><br><br>
		</div>
	</form>
@stop
