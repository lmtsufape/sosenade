@extends('layouts.app')
@section('titulo','Cadastrar Questão')
@section('content')
    <div class="shadow p-3 bg-white rounded">
		<h1 class="text-center"> Cadastrar Nova Questão </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>
		<form action= "{{route('add_qst')}}" method="post">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Classificação da Questão</h5>
				</div>
				<div class="card-body row justify-content-center">
					<div class="col-md-4 text-center">
						<label for="dificuldade">Disciplina</label>
						<select name="disciplina_id" class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>
							<option selected hidden value="">Selecione a disciplina</option>
							@foreach ($disciplinas as $disciplina)
								<option value="{{$disciplina->id}}">{{$disciplina->nome}} </option>
							@endforeach
						</select>
					</div>

					<div class="col-md-4 text-center">
						<label for="dificuldade">Dificuldade</label>
						<select name="dificuldade" class="form-control{{ $errors->has('dificuldade') ? ' is-invalid' : '' }}" required autofocus>
							<option selected hidden value="">Selecione o nível</option>
							<option value="1">Fácil</option>
							<option value="2">Médio</option>
							<option value="3">Difícil</option>
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
					<textarea class="form-control summernote" name="enunciado" id="enunciado"></textarea>
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
									<textarea class="form-control summernote_alt" type="alternativa1" id="alternativa1" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
								</td>
							</tr>
							<tr>  
								<td style="border: 0px; width: 1%; vertical-align:middle;">B.</td>
								<td style="border: 0px">
									<textarea class="form-control summernote_alt" type="alternativa2" id="alternativa2" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
								</td>
							</tr>
							<tr>  
								<td style="border: 0px; width: 1%; vertical-align:middle;">C.</td>
								<td style="border: 0px">
									<textarea class="form-control summernote_alt" type="alternativa3" id="alternativa3" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
								</td>
							</tr>
							<tr>  
								<td style="border: 0px; width: 1%; vertical-align:middle;">D.</td>
								<td style="border: 0px">
									<textarea class="form-control summernote_alt" type="alternativa4" id="alternativa4" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
								</td>
							</tr>
							<tr>  
								<td style="border: 0px; width: 1%; vertical-align:middle;">E.</td>
								<td style="border: 0px">
									<textarea class="form-control summernote_alt" type="alternativa5" id="alternativa5" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="wrapper text-center my-3">
						<span style="font-weight: bold">Alternativa correta:&nbsp</span>
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<label class="btn btn-info">
								<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="0" required> A
							</label>
							<label class="btn btn-info">
								<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="1" required> B
							</label>
							<label class="btn btn-info">
								<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="2" required> C
							</label>
							<label class="btn btn-info">
								<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="3" required> D
							</label>
							<label class="btn btn-info">
								<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="4" required> E
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
	</div>

@stop