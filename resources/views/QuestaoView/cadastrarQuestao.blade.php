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
		<div class="card" id="body-tabs">
			<div class="card-header mb-3">
				<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="cadastrar-tab" data-toggle="tab" href="#cadastrar" role="tab" aria-controls="cadastrar" aria-selected="true">Cadastrar </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="importar-tab" data-toggle="tab" href="#importar" role="tab" aria-controls="importar" aria-selected="false">Importar Questões</a>
					</li>
				</ul>
			</div> 																							
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="cadastrar" role="tabpanel" aria-labelledby="cadastrar-tab">
					<div class="list-group list-group-flush">
						<br>
						<form action= "{{route('add_qst')}}" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="row justify-content-center">
								<div class="col-md-4 text-center">
									<select name="disciplina_id" class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>	
										<option selected hidden value="">Selecione a disciplina</option>
										@foreach ($disciplinas as $disciplina)
											<option value="{{$disciplina->id}}" {{old('disciplina') == $disciplina->id ? 'selected' : '' }}	>{{$disciplina->nome}} </option>
										@endforeach
									</select>
									@if ($errors->has('disciplina_id'))
										<span class = "invalid-feedback" role="alert">
											{{$errors->first('disciplina_id')}}
										</span>
									@endif
								</div>
								<div class="col-md-4 text-center">
									<select name="dificuldade" class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>
										<option selected hidden value="">Selecione o nível</option>
										<option value="1">Fácil</option>
										<option value="2">Médio</option>
										<option value="3">Dificil</option>
									</select>
								</div>
							</div>

							<br>

							<div class="col-xs-12 col-sm-12 col-md-12 justify-content-center">
								<div class="form-group">
									<strong>Enunciado:</strong>
									<textarea class="form-control summernote" name="enunciado" id="enunciado"></textarea>
								</div>
							</div>

							<br>

							<table class="table form-group justify-content-center" id="dynamic_field" >
								<th style="text-align: center;">#</th>
								<th style="text-align: center;">Alternativas</th>
								<tr>
									<td style="border: 0px; width: 1%; vertical-align:middle; font-weight: bold">A.</td>
									<td style="border: 0px">
										<textarea class="form-control summernote_alt" type="alternativa1" id="alternativa1" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
									</td> 
								</tr>
								<tr>  
									<td style="border: 0px; width: 1%; vertical-align:middle; font-weight: bold">B.</td>
									<td style="border: 0px">
										<textarea class="form-control summernote_alt" type="alternativa2" id="alternativa2" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
									</td>
								</tr>
								<tr>  
									<td style="border: 0px; width: 1%; vertical-align:middle; font-weight: bold">C.</td>
									<td style="border: 0px">
										<textarea class="form-control summernote_alt" type="alternativa3" id="alternativa3" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
									</td>
								</tr>
								<tr>  
									<td style="border: 0px; width: 1%; vertical-align:middle; font-weight: bold">D.</td>
									<td style="border: 0px">
										<textarea class="form-control summernote_alt" type="alternativa4" id="alternativa4" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
									</td>
								</tr>
								<tr>  
									<td style="border: 0px; width: 1%; vertical-align:middle; font-weight: bold">E.</td>
									<td style="border: 0px">
										<textarea class="form-control summernote_alt" type="alternativa5" id="alternativa5" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
									</td>
								</tr>
							</table>

							<div class="wrapper text-center">
								<span style="font-weight: bold">Alternativa correta:&nbsp</span>
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn btn-info active">
										<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="0" checked required> A
									</label>
									<label class="btn btn-info">
										<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="1"> B
									</label>
									<label class="btn btn-info">
										<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="2"> C
									</label>
									<label class="btn btn-info">
										<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="3"> D
									</label>
									<label class="btn btn-info">
										<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="4"> E
									</label>
								</div>
							</div>
						
							<div class="grid">
								<br>
								<div class="row justify-content-center">
									<button type="submit" name="cadastrar" class="btn btn-primary center-block col-md-2">Cadastrar</button>
								</div>
								<br>
							</div>
						</form>
					</div>
				</div>
				<div class="tab-pane fade" id="importar" role="tabpanel" aria-labelledby="importar-tab">
					<div class="list-group list-group-flush mt-3">
						


				<div class="form-group col-md-4">
					<label for="curso_id">Cursos:</label>
					<select name="curso_id" class="form-control{{ $errors->has('curso_id') ? ' is-invalid' : '' }}" required autofocus>
						@foreach ($cursos as $curso)
							<option value="{{$curso->id}}" {{old('curso') == $curso->id ? 'selected' : '' }}>
								{{$curso->curso_nome}} - {{$curso->unidade->nome}} 
							</option>
						@endforeach
					</select>
					@if ($errors->has('curso_id'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('curso_id')}}
						</span>
					@endif
				</div>


				<div class="form-group col-md-4">
					<label for="disciplina_id">Disciplinas:</label>
					<select name="disciplina_id" class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>
						@foreach ($cursos as $curso)
							<option value="{{$curso->id}}" {{old('curso') == $curso->id ? 'selected' : '' }}>
								{{$curso->curso_nome}} - {{$curso->unidade->nome}} 
							</option>
						@endforeach
					</select>
					@if ($errors->has('disciplina_id'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('disciplina_id')}}
						</span>
					@endif
				</div>





					</div>
				</div>
			</div>
		</div>
	</div>

@stop