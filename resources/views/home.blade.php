@extends('layouts.app')
@section('titulo', 'Bem-vindo')
@section('content')
	<div class="shadow p-3 bg-white rounded container-fluid text-center">
		<td align="left" valign="top">
			<img class="img-fluid mb-5 d-block mx-auto" src="1.png" width="500px">
			<h2 class="text-uppercase mb-0">Bem Vindo, {{$nome}}</h1>
			<hr class="star-light">
			<h3 class="font-weight-light mb-0">{{$curso}} - {{$unidade}}</h2>
			<h3 class="font-weight-light mb-0">Você está logado como {{$tipo}}.</h2>
			<br>
		</td>
	</div>
@stop