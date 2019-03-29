@extends('layouts.app')
@section('titulo','Cadastro de Alunos')
@section('content')
	<div class="shadow p-3 mb-5 bg-white rounded">
		<h1 class="text-center"> Cadastro de Alunos </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>
		<div id="body-tabs">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="cadastrar-tab" data-toggle="tab" href="#cadastrar" role="tab" aria-controls="cadastrar" aria-selected="true">Cadastrar </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="importar-tab" data-toggle="tab" href="#importar" role="tab" aria-controls="importar" aria-selected="false">Importar de arquivo</a>
				</li>
			</ul>
			<br>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="cadastrar" role="tabpanel" aria-labelledby="cadastrar-tab">
					<div class="list-group list-group-flush">
						<br>
						<form action="{{route('add_aluno')}}" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group justify-content-center row" id="cadastrar">
								<div class="form-group col-md-8">
									<label for="nome">Nome</label>
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
							<div class="justify-content-center row">
								<div class="text-center" id="btn_cadastrar">
									<button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="tab-pane fade" id="importar" role="tabpanel" aria-labelledby="importar-tab">
					<div class="list-group list-group-flush">
						<br>
						<form method="POST" action="{{ route('import_aluno') }}" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">		
							<div class="form-group justify-content-center row" id="cadastrar">
								<div class="form-group col-md-8">
									<input id="csv_file" type="file" class="form-control" name="csv_file" required>
									@if ($errors->has('csv_file'))
										<span class="help-block">
											<strong>{{ $errors->first('csv_file') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="justify-content-center row">
								<div class="text-center" id="btn_cadastrar">
									<button type="submit" name="cadastrar" class="btn btn-primary">Importar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>	
		<br>
	</div>
@stop