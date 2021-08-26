@extends('layouts.app')
@section('titulo','Mudar Senha')
@section('content')

	@if(Session::has('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ Session::get('message', '') }}
		</div>
	@elseif(Session::has('fail'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ Session::get('message', '') }}
		</div>
	@endif

	<div class="shadow p-3 bg-white rounded">

		<h1 class="text-center"> Mudar Senha </h1>
		<br>
				
		<div class="tab-pane fade {{Session::has('senha') ? 'show active' : 'show active'}}" id="alterar" role="tabpanel" aria-labelledby="alterar-tab">
			<div class="list-group list-group-flush">
				<br>

				<form method="POST" action="{{ route('mudar_senha') }}">

					<input type="hidden" name="id" value="{{$aluno->id}}">
					<input type="hidden" name="_token" value="{{csrf_token()}}">

					<div class="form-group justify-content-center row">
						<div class="form-row col-md-12 justify-content-center">
							<div class="form-group col-md-4">
								<label for="old_password">Senha atual</label>
								<input type="password" id="old_password" name="old_password" placeholder="Digite a sua senha atual" class="form-control" value="{{ old('old_password') }}" required autofocus>
								@if ($errors->has('old_password'))
									<span class = "invalid-feedback" role="alert">
										{{$errors->first('old_password')}}
									</span>
								@endif
							</div>
							<div class="form-group col-md-4">
								<label for="password">Nova senha</label>
								<input type="password" id="password" name="password" placeholder="Digite a nova senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" required autofocus>
								@if ($errors->has('password'))
									<span class = "invalid-feedback" role="alert">
										{{$errors->first('password')}}
									</span>
								@endif
							</div>
							<div class="form-group col-md-4">
								<label for="password_confirmation">Confirme a nova senha</label>
								<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme sua nova senha" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{ old('password_confirmation') }}" required autofocus>
								@if ($errors->has('password_confirmation'))
									<span class = "invalid-feedback" role="alert">
										{{$errors->first('password_confirmation')}}
									</span>
								@endif
							</div>
						</div>
					</div>
					<div class="justify-content-center row">
						<div class="text-center my-3" id="btn_alterar">
							<button type="submit" name="alterar" class="btn btn-primary">Salvar senha</button>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>
@stop