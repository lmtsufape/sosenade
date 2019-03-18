@extends('layouts.default')
@section('content')
    
	<form class="shadow p-3 mb-5 bg-white rounded" action= "{{route('update_qst')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="id" value="{{$questao->id}}">

		<h1 class="text-center"> Editar Questão </h1><br>

	   <div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Enunciado:</strong>
				<textarea class="form-control summernote" name="enunciado" id="enunciado">{{$questao->enunciado}}</textarea>
			</div>
		</div>

		<br>

		<table class="table form-group" id="dynamic_field" >
			<th style="text-align: center;">#</th>
			<th style="text-align: center;">Alternativas</th>
			<th style="text-align: center;">Alternativa correta</th>
			<th>&nbsp</th>
			<tr>
				<td style="border: 0px; width: 1%; vertical-align:middle;">1.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa1" id="alternativa1" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
						{{$questao->alternativa_a}}
					</textarea>
				</td>  
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="0" required {{ ($questao->alternativa_correta == "0") ? 'checked': ''}}>
				</td>  
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">2.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa2" id="alternativa2" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
						{{$questao->alternativa_b}}
					</textarea>
				</td> 
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="1" required {{ ($questao->alternativa_correta == "1") ? 'checked': ''}}>
				</td>
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">3.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa3" id="alternativa3" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
						{{$questao->alternativa_c}}
					</textarea>
				</td> 
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="2" required {{ ($questao->alternativa_correta == "2") ? 'checked': ''}}>
				</td>
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">4.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa4" id="alternativa4" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
						{{$questao->alternativa_d}}
					</textarea>
				</td> 
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="3" required {{ ($questao->alternativa_correta == "3") ? 'checked': ''}}>
				</td>
			</tr>
			<tr>  
				<td style="border: 0px; width: 1%; vertical-align:middle;">5.</td>
				<td style="border: 0px">
					<textarea class="form-control summernote_alt" type="alternativa5" id="alternativa5" name="alternativa[]" placeholder="Escreva aqui a alternativa" required autofocus>
						{{$questao->alternativa_e}}
					</textarea>
				</td> 
				<td style="border: 0px;text-align: center; width: 1%; vertical-align:middle;">
					<input type="radio" class="alt_buttons" name="alternativa_correta" id="alternativa_correta" value="4" required {{ ($questao->alternativa_correta == "4") ? 'checked': ''}}>
				</td>
			</tr>
		</table>

		<br>

		<div class="grid">
			<div class="row justify-content-center">

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
						<option value="1" {{ $questao->dificuldade == 1 ? 'selected' : '' }} >Fácil</option>
						<option value="2" {{ $questao->dificuldade == 2 ? 'selected' : '' }} >Médio</option>
						<option value="3" {{ $questao->dificuldade == 3 ? 'selected' : '' }} >Difícil</option>
					</select>
				</div>

			</div>

			<br>

			<div class="row justify-content-center">
				<button type="submit" name="editar" class="btn btn-primary center-block col-md-1">Editar</button>
			</div>

		</div>
	</form>
	
@stop