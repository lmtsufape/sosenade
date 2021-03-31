@extends('layouts.app')
@section('titulo','Cadastrar Unidade')
@section('content')
	<form class="shadow p-3 bg-white rounded" action="{{ route('add_unidade') }}" method="post">
	
		<input type="hidden" name="id" value="-1">
		<input type="hidden" name="_token" value="{{csrf_token()}}">

		<h1 class="text-center"> Cadastrar Unidade </h1>
		<br>

		<div class="form-group justify-content-center row">
			<div class="form-group col-md-8">
				<label for="nome">Nome</label>
				<input type="text" name="nome" id="nome" placeholder="Nome da Unidade" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ old('nome') }}" required autofocus>
				@if ($errors->has('nome'))
					<span class = "invalid-feedback" role="alert">
						{{$errors->first('nome')}}
					</span>
				@endif
			</div>

		<div class="col-md-12 text-center">
			<button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button><br><br>
		</div>
	</form>
@stop
