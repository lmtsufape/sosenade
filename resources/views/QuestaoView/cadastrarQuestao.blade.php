@extends('layouts.default')
@section('content')
    
	
	<form class="shadow p-3 mb-5 bg-white rounded" action= "/adicionar/questao" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<h1 class="text-center"> Cadastrar Nova Questão </h1><br>	

		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Enunciado:</strong>
				<textarea class="form-control summernote" name="enunciado" id="enunciado"></textarea>
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
					<input type="alternativa1" id="alternativa1" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" required autofocus>
				</td>  
				<td style="border: 0px;text-align: center; width: 1%">
					<input type="radio" name="alternativa_correta" id="alternativa_correta" value="0" checked required>
				</td>  
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">2.</td>
				<td style="border: 0px">
					<input type="alternativa2" id="alternativa2" name="alternativa[]" placeholder="Escreva aqui a alternativa" style="width:100%" required autofocus>
				</td>
				<td style="border: 0px;text-align: center; width: 1%">
					<input type="radio" name="alternativa_correta" id="alternativa_correta" value="1">
				</td>
			</tr>  
		</table>

		<div id="btt_wrap">
			<button class="btn btn-primary add_field_button form-group center-block">Adicionar alternativa</button>
		</div>

		<br>

		<div class="grid">
			<div class="row center-block">
				
				<div class="form-group col-md-4">
					<label for="dificuldade">Dificuldade:</label>
					<input type="text" id="rangeValue" value="1" disabled size="1" style="border: none; border-color: transparent; background: none">
					<input class="h-50" id="dificuldade" name="dificuldade" type="range" min="1" max="5" step="1" onclick="updaterangeValue(this.value);" value="1" />
				</div>

				<div class="form-group col-md-4">
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
				
			</div>

			<br>

			<div class="row">
				<button type="submit" name="cadastrar" class="btn btn-primary center-block col-md-1">Cadastrar</button>
			</div>
		</div>
	</form>

@stop