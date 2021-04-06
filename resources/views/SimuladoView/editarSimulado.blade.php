@extends('layouts.app')
@section('titulo','Editar Simulado')
@section('content')
    <div class="shadow p-3 bg-white" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Editar Simulado</h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a> >
                    <a href="{{route('list_simulado')}}" style="color: inherit;">Listar Simulados</a> >
                    Editar Simulado
                </p>
            </div>
        </div>

        <form action="{{route('update_simulado')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$simulado->id}}">
            <input type="hidden" name="curso_id" value="{{$simulado->curso_id}}">

            <div class="form-group justify-content-center row">
                <div class="col-md-8">
                    <label for="descricao_simulado">Título</label>
                    <input type="text" class="form-control{{ $errors->has('descricao_simulado') ? ' is-invalid' : '' }}"
                           name="descricao_simulado" id="descricao_simulado" value="{{$simulado->descricao_simulado}}"
                           required autofocus>
                    @if ($errors->has('descricao_simulado'))
                        <span class="invalid-feedback" role="alert">
			    		{{$errors->first('descricao_simulado')}}
			    	</span>
                    @endif
                </div>

            </div>

            <div class="form-group justify-content-center row" id="datas">
                <div class="col-md-8">
                    <label for="periodo">Selecione o período</label>
                    <input type="text" name="periodo" class="form-control w-100 text-center" id='periodo'/>
                </div>

            </div>
            <div class="form-group justify-content-center row">
                <div class="col-md-3">
                    <label for="descricao_simulado">Disponibilidade</label><br>
                    <input name="disponibilidade" id="toggle-btn" type="checkbox" data-onstyle="success"
                           data-offstyle="outline-dark" data-on="Disponível" data-off="Oculto" data-toggle="toggle"
                           checked>
                </div>
                <div class="col-md-3">
                    <label for="simulado_hora_aluno">4hrs por simulado</label><br>
                    <input name="simulado_hora_aluno" id="toggle-btn" type="checkbox" data-onstyle="danger"
                           data-offstyle="outline-dark" data-on="4hrs" data-off="Sem limite" data-toggle="toggle"
                           checked>
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
