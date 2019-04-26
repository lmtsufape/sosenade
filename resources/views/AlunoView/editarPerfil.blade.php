@extends('layouts.app')
@section('titulo','Editar Perfil')
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
		<h1 class="text-center"> Editar Perfil </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

		<div class="card" id="body-tabs">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link {{Session::has('senha') ? '' : 'active'}}" id="alterar-tab" data-toggle="tab" href="#alterar" role="tab" aria-controls="alterar" aria-selected="true">Alterar Dados</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{Session::has('senha') ? 'active' : ''}}" id="importar-tab" data-toggle="tab" href="#importar" role="tab" aria-controls="importar" aria-selected="false">Alterar Senha</a>
					</li>
				</ul>
			</div>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade {{Session::has('senha') ? '' : 'show active'}}" id="alterar" role="tabpanel" aria-labelledby="alterar-tab">
					<div class="list-group list-group-flush">
						<br>
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
								<button type="submit" name="alterar" class="btn btn-primary">Salvar alterações</button><br><br>
							</div>
						</form>
					</div>
				</div>
				<div class="tab-pane fade {{Session::has('senha') ? 'show active' : ''}}" id="importar" role="tabpanel" aria-labelledby="importar-tab">
					<div class="list-group list-group-flush">
						<br>
						<form method="POST" action="{{ route('alterar_senha_aluno') }}">
							<input type="hidden" name="id" value="{{$aluno->id}}">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group justify-content-center row">
								<div class="form-row col-md-12 justify-content-center">
									<div class="form-group col-md-4">
										<label for="password">Senha atual</label>
										<input type="password" id="password" name="old_password" placeholder="Digite a sua senha atual" class="form-control" value="{{ old('password') }}" required autofocus>
									</div>
									<div class="form-group col-md-4">
										<label for="password">Nova senha</label>
										<input type="password" id="password" name="password" placeholder="Digite a nova senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" required autofocus>
										@if ($errors->has('password'))
											<span class = "invalid-feedback" role="alert">
												{{$errors->first('password')}}
											</span>
										@endif
									</div>
									<div class="form-group col-md-4">
										<label for="password_confirmation">Confirme a nova senha</label>
										<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme sua nova senha" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{ old('password_confirmation') }}" required autofocus>
										@if ($errors->has('password_confirmation'))
											<span class = "invalid-feedback" role="alert">
												{{$errors->first('password_confirmation')}}
											</span>
										@endif
									</div>
								</div>
							</div>
							<div class="justify-content-center row">
								<div class="text-center my-3" id="btn_alterar">
									<button type="submit" name="alterar" class="btn btn-primary">Salvar senha</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop