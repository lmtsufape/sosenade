@extends('layouts.app')
@section('titulo','Cadastrar Usuário')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Cadastro de Usuário </h1>
                <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Inicio</a> >
                    Cadastrar Usuário
                </p>
            </div>
        </div>

        <form action="{{route('add_usuario')}}" method="post">
            <input type="hidden" name="id" value="-1">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group justify-content-center row">
                <div class="form-group col-md-8">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome"
                           class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ old('nome') }}"
                           required autofocus>
                    @if ($errors->has('nome'))
                        <span class="invalid-feedback" role="alert">
						{{$errors->first('nome')}}
					</span>
                    @endif
                </div>

                <div class="form-row col-md-12 justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="email">E-mail</label>
                        <input type="text" id="email" name="email" placeholder="exemplo@exemplo.com"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
							{{$errors->first('email')}}
						</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx"
                               class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }} cpf"
                               value="{{ old('cpf') }}" required autofocus>
                        @if ($errors->has('cpf'))
                            <span class="invalid-feedback" role="alert">
							{{$errors->first('cpf')}}
						</span>
                        @endif
                    </div>
                </div>

                <div class="form-row col-md-12 justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" placeholder="Senha"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               value="{{ old('password') }}" required autofocus>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
							{{$errors->first('password')}}
						</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Confirmar Senha"
                               class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                               value="{{ old('password_confirmation') }}" required autofocus>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
							{{$errors->first('password_confirmation')}}
						</span>
                        @endif
                    </div>
                </div>
                <div class="form-row col-md-12 justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="tipousuario_id">Tipo de usuário</label>
                        <select name="tipousuario_id"
                                class="form-control{{ $errors->has('tipousuario_id') ? ' is-invalid' : '' }}" required
                                autofocus>
                            @foreach ($tipos_usuario as $tipo_usuario)
                                @if ($tipo_usuario->id != 1 && $tipo_usuario->id != 5)
                                    <option
                                        value="{{$tipo_usuario->id}}" {{old('tipousuario') == $tipo_usuario->id ? 'selected' : '' }}>
                                        {{$tipo_usuario->tipo}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('tipo_usuario_id'))
                            <span class="invalid-feedback" role="alert">
						{{$errors->first('tipo_usuario_id')}}
					</span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="curso_id">Curso</label>
                        <select name="curso_id" class="form-control{{ $errors->has('curso_id') ? ' is-invalid' : '' }}"
                                required autofocus>
                            @foreach ($cursos as $curso)
                                @if($curso->curso_nome != "Curso Teste")
                                    <option value="{{$curso->id}}" {{old('curso') == $curso->id ? 'selected' : '' }}>
                                        {{$curso->curso_nome}} ({{$curso->unidade->nome}})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('curso_id'))
                            <span class="invalid-feedback" role="alert">
						{{$errors->first('curso_id')}}
					</span>
                        @endif
                    </div>
                </div>
            </div>

            <hr style="width: 67%;">
            <div class="row" style="margin-left: 60%; margin-top: -15px">
                <div class="text-center my-3" id="btn_cadastrar">
                    <button type="submit" name="cadastrar" class="btn btn-primary" style="width: 200px">Cadastrar
                        Usuário
                    </button>
                </div>
            </div>
        </form>
    </div>
@stop
