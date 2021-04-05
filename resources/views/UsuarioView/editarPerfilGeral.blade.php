@extends('layouts.app')
@section('titulo','Atualizar Perfil')
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

	<div class="shadow p-3 bg-white text-center" style="border-radius: 10px">
        <div class="row" style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <h1 style="margin: 15px"> Meu Perfil </h1>
            {{-- <p><a href="">Inicio</a> > <a href="">Olá, fulano</a> > <a href=""></a>Meu Perfil</p> --}}
        </div>

		<div class="card" id="body-tabs">
			@if(Auth::user()->id == $usuario->id)
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
			@endif
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade {{Session::has('senha') ? '' : 'show active'}}" id="alterar" role="tabpanel" aria-labelledby="alterar-tab">
					<div class="list-group list-group-flush">
						<br>
						<form action= "{{route('update_professor')}}" method="post">
							<input type="hidden" name="id" value="{{$usuario->id}}">
							<input type="hidden" name="password" value="{{$usuario->password}}">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group row justify-content-center">
								<div class="form-group col-md-5">
									<label for="nome" style="float: left;">Nome completo</label>
									<input type="text" name="nome" id="nome" placeholder="Nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{$usuario->nome}}" required autofocus>
									@if ($errors->has('nome'))
										<span class = "invalid-feedback" role="alert">
											{{$errors->first('nome')}}
										</span>
									@endif

                                    <label for="cpf" style="float: left;">CPF</label>
                                    <input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }} cpf" value="{{$usuario->cpf}}" required autofocus>
                                    @if ($errors->has('cpf'))
                                        <span class = "invalid-feedback" role="alert">
                                            {{$errors->first('cpf')}}
                                        </span>
                                    @endif

                                    <label for="email" style="float: left;">E-mail</label>
										<input type="text" id="email" name="email" placeholder="exemplo@exemplo" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$usuario->email}}" required autofocus>
										@if ($errors->has('email'))
											<span class = "invalid-feedback" role="alert">
												{{$errors->first('email')}}
											</span>
										@endif
								</div>
                                <div class="form-group col-md-5">
                                    <label for="vinculo" style="float: left;">Vínculo</label>
                                    <input type="text" id="vinculo" name="vinculo" placeholder="Vínculo" class="form-control{{ $errors->has('vinculo') ? ' is-invalid' : '' }} vinculo" value="{{ $user_vinculo->tipo }}" disabled>
                                    @if ($errors->has('vinculo'))
                                        <span class = "invalid-feedback" role="alert">
                                            {{$errors->first('vinculo')}}
                                        </span>
                                    @endif

                                    <label for="curso" style="float: left;">Curso</label>
                                    <input type="text" id="curso" name="curso" placeholder="Curso" class="form-control{{ $errors->has('curso') ? ' is-invalid' : '' }} curso" value="{{ $user_curso->curso_nome }}" disabled>
                                    @if ($errors->has('curso'))
                                        <span class = "invalid-feedback" role="alert">
                                            {{$errors->first('curso')}}
                                        </span>
                                    @endif

                                    <label for="instituicao" style="float: left;">Instituição</label>
                                    <input type="text" id="instituicao" name="instituicao" placeholder="Instituição" class="form-control{{ $errors->has('instituicao') ? ' is-invalid' : '' }} instituicao" value="{{ $user_instituicao->nome }}" disabled>
                                    @if ($errors->has('instituicao'))
                                        <span class = "invalid-feedback" role="alert">
                                            {{$errors->first('instituicao')}}
                                        </span>
                                    @endif
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
						<form method="POST" action="{{ route('alterar_senha') }}">
							<input type="hidden" name="id" value="{{$usuario->id}}">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group justify-content-center row">
								<div class="form-row col-md-12 justify-content-center">
									<div class="form-group col-md-5">
										<label for="password" style="float: left;">Senha atual</label>
										<input type="password" id="password" name="old_password" placeholder="Digite a sua senha atual" class="form-control" value="{{ old('password') }}" required autofocus>

										<label for="password" style="float: left;">Nova senha</label>
										<input type="password" id="password" name="password" placeholder="Digite a nova senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" required autofocus>
										@if ($errors->has('password'))
											<span class = "invalid-feedback" role="alert">
												{{$errors->first('password')}}
											</span>
										@endif

										<label for="password_confirmation" style="float: left;">Confirme a nova senha</label>
										<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme sua nova senha" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{ old('password_confirmation') }}" required autofocus>
										@if ($errors->has('password_confirmation'))
											<span class = "invalid-feedback" role="alert">
												{{$errors->first('password_confirmation')}}
											</span>
										@endif
									</div>
									<div class="form-group col-md-5">
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
