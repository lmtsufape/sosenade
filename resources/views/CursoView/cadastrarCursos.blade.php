@extends('layouts.app')
@section('titulo','Cadastrar Curso')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px; width: 80%; margin-left: auto; margin-right: auto">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Cadastro de Curso </h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Inicio</a> >
                    Cadastrar Curso
                </p>
            </div>
        </div>

        <form action="{{route('add_curso')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-row col-md-12 justify-content-center">
                <div class="form-group col-md-4">
                    <label for="curso_nome">Nome do Curso</label>
                    <input type="text" class="form-control{{ $errors->has('curso_nome') ? ' is-invalid' : '' }}"
                           name="curso_nome" id="curso_nome" placeholder="Digite o nome do curso aqui"
                           value="{{ old('curso_nome') }}" required autofocus>
                    @if ($errors->has('curso_nome'))
                        <span class="invalid-feedback" role="alert">
						<strong>{{$errors->first('curso_nome')}}
					</span>
                    @endif
                </div>

                <div class="form-row col-md-12 justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="unidade_id">Unidade</label>
                        <select class="form-control{{ $errors->has('unidade_id') ? ' is-invalid' : '' }}" name="unidade_id"
                                required autofocus>
                            <option hidden disabled selected>Selecione a unidade</option>
                            @foreach($unidade_academicas as $unidade_academica)
                                <option
                                    value="{{$unidade_academica->id}}" {{ old('unidade_academica') == $unidade_academica->id ? 'selected' : ''}}>{{$unidade_academica->nome}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('unidade_id'))
                            <span class="invalid-feedback" role="alert">
						{{$errors->first('unidade_id')}}
					</span>
                        @endif
                    </div>
                </div>

                <div class="form-row col-md-12 justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="ciclo_id">Ciclo</label>
                        <select class="form-control{{ $errors->has('ciclo_id') ? ' is-invalid' : '' }}" name="ciclo_id"
                                required autofocus>
                            <option hidden disabled selected>Selecione o ciclo</option>
                            @foreach ($ciclos as $ciclo)
                                <option
                                    value="{{$ciclo->id}}" {{ old('ciclo') == $ciclo->id ? 'selected' : ''}} >{{$ciclo->tipo_ciclo}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('ciclo_id'))
                            <span class="invalid-feedback" role="alert">
						{{$errors->first('ciclo_id')}}
					</span>
                        @endif
                    </div>
                </div>
            </div>

            <hr style="width: 67%;">
            <div class="row" style="margin-left: 60%; margin-top: -15px">
                <div class="text-center my-3" id="btn_cadastrar">
                    <button type="submit" name="cadastrar" class="btn btn-primary" style="width: 200px">Cadastrar
                        Curso
                    </button>
                </div>
            </div>
        </form>
    </div>
@stop
