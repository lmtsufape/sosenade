@extends('layouts.default')
@section('content')

	<form class="shadow p-3 mb-5 bg-white rounded" action= "/adicionar/disciplina" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<h1 class="text-center"> Cadastrar disciplina </h1><br><br>	

	  
	    <div class="form-group col-md-4">
	      <label for="nome">Nome</label>
	      <input type="text"  name="nome" id="nome" placeholder="Nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{ old('nome') }}" required autofocus>
	      @if ($errors->has('nome'))
	        <span class = "invalid-feedback" role="alert">
	          <strong>{{$errors->first('nome')}}</strong>
	        </span>
	      @endif
	    </div>

		<button type="submit" name="cadastrar" class="btn btn-primary float-right">Cadastrar</button><br><br>
	</form>
@stop