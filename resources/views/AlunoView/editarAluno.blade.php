@extends('layouts.app')
@section('titulo','Editar Alunos')
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

    <div class="shadow p-3 bg-white" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Editar Aluno </h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Inicio</a> >
                    <a href="{{route('list_aluno')}}" style="color: inherit;"> Listar Alunos</a> >
                    Editar Aluno
                </p>
            </div>
        </div>

        <form action="{{route('update_aluno')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$aluno->id}}">
            <input type="hidden" name="password" value="{{$aluno->password}}">
            <div class="form-group justify-content-center row">
                <div class="form-group col-md-8">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome"
                           class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{$aluno->nome}}"
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
                        <input type="text" id="email" name="email" placeholder="exemplo@exemplo"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               value="{{$aluno->email}}" required autofocus>
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
                               value="{{$aluno->cpf}}" required autofocus>
                        @if ($errors->has('cpf'))
                            <span class="invalid-feedback" role="alert">
								{{$errors->first('cpf')}}
							</span>
                        @endif
                    </div>
                </div>
            </div>

            <hr style="width: 67%;">
            <div class="row" style="margin-left: 60%; margin-top: -15px">
                <div class="text-center my-3" id="btn_cadastrar">
                    <button type="submit" name="cadastrar" class="btn btn-primary" style="width: 200px">Salvar Alterações</button>
                </div>
            </div>
        </form>
    </div>

@stop
