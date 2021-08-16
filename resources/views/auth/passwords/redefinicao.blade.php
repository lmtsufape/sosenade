@extends('layouts.app')
@section('titulo', 'Redefinição de Senha')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="shadow p-3 bg-white" style="border-radius: 10px">
                        <div class="row"
                             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
                            <div class="col-sm">
                                <h1 style="margin-left: 15px; margin-top: 15px">Escolha de Redefinição de Senha</h1>
                            </div>
                        </div>
                        <form action="{{route('cookie.resetPassword')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <label for="tipo"
                                           style="font-weight: bold;">{{ __('Selecione seu tipo de usuário') }}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <select class="form-control" id="tipo" name="tipo"
                                            style="background-color: #f2f0f0">
                                        <option selected value="aluno">Aluno</option>
                                        <option value="instituicao">Instituição</option>
                                        <option value="user">Outro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-md-5">
                                    <button type="submit" class="btn btn-primary"
                                            style="margin-top: 20px; width: 100px; border-radius: 10px">Enviar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
