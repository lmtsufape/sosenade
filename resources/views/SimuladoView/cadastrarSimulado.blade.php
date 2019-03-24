@extends('layouts.default')
@section('content')

	<form class="shadow p-3 mb-5 bg-white rounded" action= "{{route('add_simulado')}}" method="post">
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
			<div class="col-md-3">
				<input type="text" name="data_inicio_simulado" class="date" id="dp1" width="230px" required autofocus placeholder="De">
			</div>
			<div class="col-md-3">
				<input type="text" name="data_fim_simulado" class="date" id="dp2" width="230px" required autofocus placeholder="Até">
			</div>
		</div>	

		<div class="form-group justify-content-center row">
			<div class="col-md-2 text-center">
				<button type="submit" name="cadastrar" class="btn btn-primary btn-block">Continuar</button>
			</div>
		</div>

	</form>

	<!-- Script do DatePicker no Footer.blade -->

@stop