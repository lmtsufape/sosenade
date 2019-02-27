@extends('layouts.default')
@section('content')
    
	<form class="shadow p-3 mb-5 bg-white rounded" action= "/adicionar/questao" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<h1 class="text-center"> Cadastrar Nova Questão </h1><br>	

		<div class="col-xs-12 col-sm-12 col-md-12 justify-content-center">
			<div class="form-group">
				<strong>Enunciado:</strong>
				<textarea class="form-control summernote" name="enunciado" id="enunciado"></textarea>
			</div>
		</div>

		<table class="table form-group justify-content-center" id="dynamic_field" >
			<th style="text-align: center;">#</th>
			<th>Resposta</th>
			<th style="text-align: center;">Resposta correta</th>
			<th>&nbsp</th>
			<tr>
				<td style="border: 0px; width: 1%; vertical-align:middle;">1.</td>
				<td style="border: 0px">
					<input type="alternativa1" id="alternativa1" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" required autofocus>
				</td>  
				<td style="border: 0px;text-align: center; width: 1%">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="0" checked required>
				</td>  
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">2.</td>
				<td style="border: 0px">
					<input type="alternativa2" id="alternativa2" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" required autofocus>
				</td>
				<td style="border: 0px;text-align: center; width: 1%">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="1">
				</td>
			</tr>  
		</table>

		<script>
			var x = 2; // numero de alternativas
		</script>	

		<div id="btt_wrap" class="row justify-content-center">
			<button class="btn btn-primary add_field_button form-group">Adicionar alternativa</button>
		</div>

		<div class="grid">
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

			<div class="row justify-content-center">
				<button type="submit" name="cadastrar" class="btn btn-primary center-block col-md-1">Cadastrar</button>
			</div>
		</div>
	</form>

@stop