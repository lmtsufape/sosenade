@extends('layouts.app')
@section('titulo','Editar Questão')
@section('content')
    
	<form class="shadow p-3 bg-white rounded" action= "{{route('update_qst')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$questao->id}}">

		<h1 class="text-center"> Editar Questão </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Classificação da Questão</h5>
			</div>
			<div class="card-body row justify-content-center">
				<div class="col-md-4 text-center">
					<label for="dificuldade">Disciplina</label>
					<select name="disciplina_id" class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>	
						@foreach ($disciplinas as $disciplina)
							<option value="{{$disciplina->id}}" {{ $questao->disciplina_id == $disciplina->id ? 'selected' : '' }}	>{{$disciplina->nome}} </option>
						@endforeach
					</select>
					@if ($errors->has('disciplina_id'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('disciplina_id')}}
						</span>
					@endif
				</div>

				<div class="col-md-4 text-center">
					<label for="dificuldade">Dificuldade</label>
					<select name="dificuldade" class="form-control{{ $errors->has('dificuldade') ? ' is-invalid' : '' }}" required autofocus>
						<option value="1" {{ $questao->dificuldade == 'Fácil' ? 'selected' : '' }} >Fácil</option>
						<option value="2" {{ $questao->dificuldade == 'Médio' ? 'selected' : '' }} >Médio</option>
						<option value="3" {{ $questao->dificuldade == 'Difícil' ? 'selected' : '' }} >Difícil</option>
					</select>
				</div>
			</div>
			<div class="card-footer">
				<small class="text-muted">Selecione a disciplina/conteúdo abrangido na questão e o nível de dificuldade da mesma.</small>
			</div>
		</div>

		<div class="card my-3">
			<div class="card-header">
				<h5 class="card-title">Enunciado</h5>
			</div>
			<div class="card-body">
				<textarea class="form-control summernote" name="enunciado" id="enunciado">{{$questao->enunciado}}</textarea>
			</div>
			<div class="card-footer">
				<small class="text-muted">Digite o enunciado da questão no campo acima.</small>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Alternativas</h5>
			</div>
			<div class="card-body">
				<table class="table">
					<tbody>
						<tr>
							<td style="border: 0px; width: 1%; vertical-align:middle;">A.</td>
							<td style="border: 0px">
								<textarea class="form-control summernote_alt" type="alternativa1" id="alternativa1" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
									{{$questao->alternativa_a}}
								</textarea>
							</td>
						</tr>
						<tr>  
							<td style="border: 0px; width: 1%; vertical-align:middle;">B.</td>
							<td style="border: 0px">
								<textarea class="form-control summernote_alt" type="alternativa2" id="alternativa2" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
									{{$questao->alternativa_b}}
								</textarea>
							</td>
						</tr>
						<tr>  
							<td style="border: 0px; width: 1%; vertical-align:middle;">C.</td>
							<td style="border: 0px">
								<textarea class="form-control summernote_alt" type="alternativa3" id="alternativa3" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
									{{$questao->alternativa_c}}
								</textarea>
							</td>
						</tr>
						<tr>  
							<td style="border: 0px; width: 1%; vertical-align:middle;">D.</td>
							<td style="border: 0px">
								<textarea class="form-control summernote_alt" type="alternativa4" id="alternativa4" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
									{{$questao->alternativa_d}}
								</textarea>
							</td>
						</tr>
						<tr>  
							<td style="border: 0px; width: 1%; vertical-align:middle;">E.</td>
							<td style="border: 0px">
								<textarea class="form-control summernote_alt" type="alternativa5" id="alternativa5" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
									{{$questao->alternativa_e}}
								</textarea>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="wrapper text-center my-3">
					<span style="font-weight: bold">Alternativa correta:&nbsp</span>
					<div class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class="btn btn-info {{($questao->alternativa_correta == '0') ? 'active': ''}}">
							<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="0" required {{ ($questao->alternativa_correta == "0") ? 'checked': ''}}> A
						</label>
						<label class="btn btn-info {{($questao->alternativa_correta == '1') ? 'active': ''}}">
							<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="1" required {{ ($questao->alternativa_correta == "1") ? 'checked': ''}}> B
						</label>
						<label class="btn btn-info {{($questao->alternativa_correta == '2') ? 'active': ''}}">
							<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="2" required {{ ($questao->alternativa_correta == "2") ? 'checked': ''}}> C
						</label>
						<label class="btn btn-info {{($questao->alternativa_correta == '3') ? 'active': ''}}">
							<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="3" required {{ ($questao->alternativa_correta == "3") ? 'checked': ''}}> D
						</label>
						<label class="btn btn-info {{($questao->alternativa_correta == '4') ? 'active': ''}}">
							<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="4" required {{ ($questao->alternativa_correta == "4") ? 'checked': ''}}> E
						</label>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<small class="text-muted">Preencha os campos acima com as alternativas correspondentes e marque a letra da alternativa correta</small>
			</div>
		</div>

		<div class="row justify-content-center my-4">
			<button type="submit" name="editar" class="btn btn-primary center-block">Salvar alterações</button>
		</div>
	</form>
	
@stop