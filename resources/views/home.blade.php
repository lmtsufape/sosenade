@extends('layouts.app')
@section('titulo', 'Bem-vindo')
@section('content')
	<div class="shadow p-3 bg-white text-center" style="border-radius: 10px">
        <div class="row" style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; height: 25px">

        </div>

        <td align="left" valign="top">
            <img class="img-fluid mb-5 d-block mx-auto" src="1.png" width="500px">
            <h2 class="display-4">Bem-Vindo, {{$nome}}!</h2>
            <hr class="my-4">
            @if(Auth::guard('aluno')->check())
                <h3 class="lead">Você está logado como {{$tipo}}.</h3>
                <h3 class="lead">{{$curso}} - {{$unidade}}</h3>
			@elseif(Auth::guard('instituicao')->check())
				<h3 class="lead">Você está logado como {{$tipo}} - {{$nome}}.</h3>
            @elseif(Auth::guard()->user()->tipousuario_id < 4)
                <h3 class="lead">Você está logado como {{$tipo}}.</h3>
                <h3 class="lead">{{$curso}} - {{$unidade}}</h3>
            @elseif(Auth::guard()->user()->tipousuario_id == 5)
                <h3 class="lead">Você está logado como {{$tipo}}.</h3>
                <h3 class="lead">{{$unidade}}</h3>
            @elseif(Auth::guard()->user()->tipousuario_id == 4)
                <h3 class="lead">Você está logado como {{$tipo}}.</h3>
            @endif
            <br>
        </td>
	</div>
@stop
