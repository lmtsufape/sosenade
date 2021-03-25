@extends('layouts.app')
@section('titulo','Cadastrar Disciplinas')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Cadastro de Disciplinas </h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Inicio</a> >
                    Cadastrar Disciplina
                </p>
            </div>
        </div>

	<form action="{{route('add_disciplina')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">

		<div class="form-group justify-content-center row">
			<div class="col-md-10">
                <label for="nome">Nome da Disciplina/Conteudo</label>
				<input type="text" name="nome" id="nome" placeholder="Digite o nome da disciplina/conteúdo aqui" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ old('nome') }}" required autofocus>
					@if ($errors->has('nome'))
						<span class = "invalid-feedback" role="alert">
							<strong>{{$errors->first('nome')}}</strong>
						</span>
					@endif
			</div>
		</div>

        <hr style="width: 67%; margin-top: 30%">
        <div class="row" style="margin-left: 60%; margin-top: -15px">
            <div class="text-center my-3" id="btn_cadastrar">
                <button type="submit" name="cadastrar" class="btn btn-primary" style="width: 200px">Cadastrar Disciplina</button>
            </div>
        </div>
	</form>
@stop
