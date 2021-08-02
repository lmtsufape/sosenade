@extends('layouts.app')
@section('titulo', 'Redefinição de Senha')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Escolha de Redefinição de Senha') }}</div>

                    <div class="card-body">
                        <b>Redefinição de Senha para Instituição:</b> <a href="{{route('cookie.resetPassword', ['tipo' => 'instituicao'])}}">Clique Aqui</a><br>
                        <b>Redefinição de Senha para Aluno:</b> <a href="{{route('cookie.resetPassword', ['tipo' => 'aluno'])}}">Clique Aqui</a><br>
                        <b>Redefinição de Senha para Outros:</b> <a href="{{route('cookie.resetPassword', ['tipo' => 'user'])}}">Clique Aqui</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
