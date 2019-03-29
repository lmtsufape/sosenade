@extends('layouts.app')
@section('titulo','Cadastrar Questão')
@section('content')
    
	<form class="shadow p-3 mb-5 bg-white rounded" action= "{{route('add_qst')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		
		<h1 class="text-center"> Cadastrar Nova Questão </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>	

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
			<th style="text-align: center;">Alternativa correta</th>
			<th>&nbsp</th>
			<tr>
				<td style="border: 0px; width: 1%; vertical-align:middle;">1.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa1" id="alternativa1" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
				</td>  
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="0" checked required>
				</td>  
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">2.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa2" id="alternativa2" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
				</td> 
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="1">
				</td>
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">3.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa3" id="alternativa3" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
				</td> 
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="2">
				</td>
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">4.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa4" id="alternativa4" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
				</td> 
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="3">
				</td>
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">5.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa5" id="alternativa5" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus></textarea>
				</td> 
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="4">
				</td>
			</tr>
		</table>

		<div class="grid">

			<br>

			<div class="row justify-content-center">
				<button type="submit" name="cadastrar" class="btn btn-primary center-block col-md-2">Cadastrar</button>
			</div>

			<br>

		</div>
	</form>

@stop