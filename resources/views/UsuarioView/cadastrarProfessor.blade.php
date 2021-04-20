@extends('layouts.app')
@section('titulo','Cadastrar Professor')
@section('content')
    <div class="shadow p-3 bg-white" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Cadastro de Professor </h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a> >
                    Cadastrar Professor
                </p>
            </div>
        </div>
	<form action= "{{route('add_professor')}}" method="post">
		<input type="hidden" name="id" value="-1">
		<input type="hidden" name="_token" value="{{csrf_token()}}">

		<div class="form-group justify-content-center row">
			<div class="form-group col-md-8">
				<label for="nome">Nome Completo</label>
				<input type="text" name="nome" id="nome" placeholder="Nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ old('nome') }}" required autofocus>
                @if ($errors->has('nome'))
					<span class = "invalid-feedback" role="alert">
						{{$errors->first('nome')}}
					</span>
				@endif
			</div>

			<div class="form-row col-md-12 justify-content-center">
				<div class="form-group col-md-4">
					<label for="email">E-mail</label>
					<input type="text" id="email" name="email" placeholder="exemplo@exemplo.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
                    <span style="color: #b8c2cc; font-size: 14px">E-mail utilizado para acessar o sistema.</span>
                    @if ($errors->has('email'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('email')}}
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
			</div>

			<div class="form-row col-md-12 justify-content-center">
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
		</div>

        <hr style="width: 67%;">
        <div class="row" style="margin-left: 60%; margin-top: -15px">
            <div class="text-center my-3" id="btn_cadastrar">
                <button type="submit" name="cadastrar" class="btn btn-primary" style="width: 200px">Cadastrar Professor</button>
            </div>
        </div>
	</form>
@stop
