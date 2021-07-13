@extends('layouts.app')
@section('titulo','Editar Unidade')
@section('content')
    <div class="shadow p-3 bg-white" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Editar Unidade </h1>
                <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Inicio</a> >
                    Editar Unidade
                </p>
            </div>
        </div>
        <form action="{{ route('update_unidade') }}" method="post">

            <input type="hidden" name="id" value="{{ $unidade->id }}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group justify-content-center row">
                <div class="form-group col-md-8">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome da Unidade"
                           class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                           value="{{ $unidade->nome }}" required autofocus>
                    @if ($errors->has('nome'))
                        <span class="invalid-feedback" role="alert">
						{{$errors->first('nome')}}
					</span>
                    @endif
                </div>
            </div>

            <hr style="width: 67%">
            <div class="row" style="margin-left: 60%; margin-top: -15px">
                <div class="text-center my-3" id="btn_cadastrar">
                    <button type="submit" name="cadastrar" class="btn btn-primary" style="width: 200px">Salvar Alterações</button>
                </div>
            </div>
        </form>
    </div>
@stop
