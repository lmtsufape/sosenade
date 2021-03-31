@extends('layouts.app')
@section('titulo','Editar Disciplina')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Editar Disciplina/Conteúdos </h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Inicio</a> >
                    <a href="{{route('list_disciplina')}}" style="color: inherit;"> Listar Disciplinas</a> >
                    Editar Disciplina
                </p>
            </div>
        </div>

        <form action="{{route('update_disciplina')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$disciplina->id}}">

            <div class="form-row col-md-12 justify-content-center">
                <div class="form-group col-md-8">
                    <label for="nome">Nome da Disciplina/Conteudo</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome Disciplina/Conteúdo"
                           class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                           value="{{$disciplina->nome}}" required autofocus>
                    @if ($errors->has('nome'))
                        <span class="invalid-feedback" role="alert">
	          <strong>{{$errors->first('nome')}}</strong>
	        </span>
                    @endif
                </div>

            </div>
            <hr style="width: 67%;">
            <div class="row" style="margin-left: 60%; margin-top: -15px">
                <div class="text-center my-3" id="btn_cadastrar">
                    <button type="submit" name="cadastrar" class="btn btn-primary" style="width: 200px">Salvar
                        Alterações
                    </button>
                </div>
            </div>
        </form>
@stop
