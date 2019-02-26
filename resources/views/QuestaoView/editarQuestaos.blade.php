@extends('layouts.default')
@section('content')
    
	<form class="shadow p-3 mb-5 bg-white rounded" action= "/atualizar/questao" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$questao->id}}">

		<h1 class="text-center"> Editar Questão </h1><br>

	   <div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Enunciado:</strong>
				<textarea class="form-control summernote" name="enunciado" id="enunciado">{{$questao->enunciado}}</textarea>
			</div>
		</div>

		<table class="table form-group" id="dynamic_field" >
			<th style="text-align: center;">#</th>
			<th>Resposta</th>
			<th style="text-align: center;">Resposta correta</th>
			<th>&nbsp</th>
			<tr>
				<td style="border: 0px; width: 1%; vertical-align:middle;">1.</td>
				<td style="border: 0px">
					<input type="alternativa1" id="alternativa1" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" value="{{$questao->alternativa_a}}" required autofocus>
				</td>  
				<td style="border: 0px;text-align: center; width: 1%">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="0" required {{ ($questao->alternativa_correta == "0") ? 'checked': ''}}>
				</td>  
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">2.</td>
				<td style="border: 0px">
					<input type="alternativa2" id="alternativa2" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" value="{{$questao->alternativa_b}}" required autofocus>
				</td>
				<td style="border: 0px;text-align: center; width: 1%">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="1" {{ ($questao->alternativa_correta == "1") ? 'checked': ''}}>
				</td>
			</tr>

			<script>var x = 2; // numero de alternativas</script>

			@if ($questao->alternativa_c != '')
				<tr id="row2">  
					<td style="border: 0px; width: 1%; vertical-align:middle;">
						<p style="vertical-align:middle; display:inherit;" class="p">3.</p>
					</td>
					<td style="border: 0px">
						<input type="alternativa3" id="alternativa3" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" value="{{$questao->alternativa_c}}" required autofocus>
					</td>
					<td style="border: 0px;text-align: center; width: 1%">
						<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="2" {{ ($questao->alternativa_correta == "2") ? 'checked': ''}}>
					</td>
					<td style="border: 0px; width: 1%">
						<a href="#" name="remove" id="2" class="remove_field">Remover</a>
					</td>
				</tr>
				<script>var x = 3;</script>

 				@if ($questao->alternativa_d != '')
					<tr id="row3">  
						<td style="border: 0px; width: 1%; vertical-align:middle;">
							<p style="vertical-align:middle; display:inherit;" class="p">4.</p>
						</td>
						<td style="border: 0px">
							<input type="alternativa4" id="alternativa4" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" value="{{$questao->alternativa_d}}" required autofocus>
						</td>
						<td style="border: 0px;text-align: center; width: 1%">
							<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="3" {{ ($questao->alternativa_correta == "3") ? 'checked': ''}} >
						</td>
						<td style="border: 0px; width: 1%">
							<a href="#" name="remove" id="3" class="remove_field">Remover</a>
						</td>
					</tr>
					<script>var x = 4;</script>

	 				@if ($questao->alternativa_e != '')
						<tr id="row4">  
							<td style="border: 0px; width: 1%; vertical-align:middle;">5.</td>
							<td style="border: 0px">
								<input type="alternativa5" id="alternativa5" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" value="{{$questao->alternativa_e}}" required autofocus>
							</td>
							<td style="border: 0px;text-align: center; width: 1%">
								<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="4" {{ ($questao->alternativa_correta == "4") ? 'checked': ''}}>
							</td>
							<td style="border: 0px; width: 1%">
								<a href="#" name="remove" id="4" class="remove_field">Remover</a>
							</td>
						</tr>
						<script>var x = 5;</script>
					@endif

				@endif

			@endif

		</table>

		<div id="btt_wrap" class="row justify-content-center">
			<button class="btn btn-primary add_field_button form-group">Adicionar alternativa</button>
		</div>

		<br>

		<div class="grid">
			<div class="row justify-content-center">
				
				<div class="col-md-4 text-center">
					<label for="disciplina_id">Disciplina</label>
					<select name="disciplina_id" class="h-50 form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>	
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
				
				<div class="col-md-4 form-group text-center">
					<label for="dificuldade">Dificuldade:</label>
					<input type="text" id="rangeValue" value="{{$questao->dificuldade}}" disabled size="1" style="border: none; border-color: transparent; background: none">
					<br>
					<input class="h-50" id="dificuldade" name="dificuldade" type="range" min="1" max="5" step="1" onclick="updaterangeValue(this.value);" value="{{$questao->dificuldade}}" />
				</div>
			</div>

			<br>

			<div class="row justify-content-center">
				<button type="submit" name="editar" class="btn btn-primary center-block col-md-1">Editar</button>
			</div>
		</div>
	</form>
@stop