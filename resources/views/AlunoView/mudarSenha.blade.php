@extends('layouts.app')
@section('titulo','Editar Perfil')
@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
            </button>{{ Session::get('message', '') }}
        </div>
    @elseif(Session::has('fail'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
            </button> {{ Session::get('message', '') }}
        </div>
    @endif

    <div class="shadow p-3 bg-white text-center" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <h1 style="margin: 15px"> Primeiro Login do Aluno </h1>
        </div>
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{Session::has('senha') ? '' : 'active'}}" id="alterar-tab" data-toggle="tab"
                       href="#alterar" role="tab" aria-controls="alterar" aria-selected="true">Alterar Senha</a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="list-group list-group-flush">
                <br>
                <form method="POST" action="{{ route('alterar_senha_aluno') }}">
                    <input type="hidden" name="id" value="{{$aluno->id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group justify-content-center row">
                        <div class="col-md-5">
                            <div class="form-group col-md-12">
                                <label for="password" style="float: left;">Senha atual</label>
                                <input type="password" id="old_password" name="old_password"
                                       placeholder="Digite a sua senha atual" class="form-control"
                                       value="{{ old('old_password') }}" required autofocus>
                                @if(Session::has('fail'))
                                    <span class="invalid-feedback" role="alert">
												{{ Session::get('message', '') }}
											</span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label for="password" style="float: left;">Nova senha</label>
                                <input type="password" id="password" name="password"
                                       placeholder="Digite a nova senha"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       value="{{ old('password') }}" required autofocus>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
												{{$errors->first('password')}}
											</span>
                                @else
                                    <span style="color: #7F7F7F; font-size: 12px;">A senha deve possuir no minimo 8 caracteres.</span>
                                @endif
                            </div>

<<<<<<< HEAD
					<input type="hidden" name="id" value="{{$aluno->id}}">
					<input type="hidden" name="_token" value="{{csrf_token()}}">

					<div class="form-group justify-content-center row">
						<div class="form-row col-md-12 justify-content-center">
							<div class="form-group col-md-4">
								<label for="old_password">Senha atual</label>
								<input type="password" id="old_password" name="old_password" placeholder="Digite a sua senha atual" class="form-control" value="{{ old('old_password') }}" required autofocus>
								@if ($errors->has('old_password'))
									<span class = "invalid-feedback" role="alert">
										{{$errors->first('old_password')}}
									</span>
								@endif
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
@stop
=======
                            <div class="form-group col-md-12">
                                <label for="password_confirmation" style="float: left;">Confirme a nova
                                    senha</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       placeholder="Confirme sua nova senha"
                                       class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                       value="{{ old('password_confirmation') }}" required autofocus>
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
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
@stop
>>>>>>> 8b7f2d3c6f231b34e83315afa3fffe54cc80fb49
