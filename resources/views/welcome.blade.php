@extends('layouts.default')
@section('content')
    
	<div class="shadow p-1 mb-5 bg-white rounded container-fluid text-center">
		<td align="left" valign="top">
			<img class="img-fluid mb-5 d-block mx-auto" src="1.png" width="250px">
			<h1 class="text-uppercase mb-0">Bem Vindo, {{$nome}}</h1>
			<hr class="star-light">
			<h2 class="font-weight-light mb-0">{{$curso}} - {{$unidade}}</h2>
			<h2 class="font-weight-light mb-0">Você está logado como {{$tipo}}.</h2>
			<br>
		</td>
	</div>

@stop