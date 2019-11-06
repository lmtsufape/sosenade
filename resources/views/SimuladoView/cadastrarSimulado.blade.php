@extends('layouts.app')
@section('titulo','Cadastrar Simulado')
@section('content')

	<form class="shadow p-5 bg-white rounded" action= "{{route('add_simulado')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		
		<h1 class="text-center"> Cadastrar Simulado </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>	
	
		<div class="form-group justify-content-center row">
			<div class="col-md-6">
				<label for="descricao_simulado">Título</label>
				<input type="text" class="form-control{{ $errors->has('descricao_simulado') ? ' is-invalid' : '' }}"  name="descricao_simulado" id="descricao_simulado" placeholder="Escreva aqui o título do simulado" value="{{ old('descricao_simulado') }}" required autofocus>
				@if ($errors->has('descricao_simulado'))
					<span class = "invalid-feedback" role="alert">
						{{$errors->first('descricao_simulado')}}
					</span>
				@endif
			</div> 
			<div class="col-md-2">
				<label for="descricao_simulado">Disponibilidade</label>
				<input name="disponibilidade" id="toggle-btn" type="checkbox" data-onstyle="success" data-offstyle="outline-dark" data-on="Disponível" data-off="Oculto" data-toggle="toggle" checked >
			</div>
		</div>

		<div class="form-group justify-content-center row" id="datas">
			<div class="col-md-4">
				<label for="periodo">Selecione o período</label>
				<input type="text" name="periodo" class="form-control w-100 text-center" id='periodo' />
			</div>

			<div class="col-md-2">
					<label for="simulado_hora_aluno">4hrs por simulado</label>
					<input name="simulado_hora_aluno" id="toggle-btn" type="checkbox" data-onstyle="danger" data-offstyle="outline-dark" data-on="4hrs" data-off="Sem limite" data-toggle="toggle" checked >
			</div>
		</div>	

		<div class="form-group justify-content-center row">
			<div class="col-md-2 text-center">
				<button type="submit" name="cadastrar" class="btn btn-primary btn-block">Continuar</button>
			</div>
		</div>

	</form>

	<!-- Script do DatePicker no footer.blade -->

@stop