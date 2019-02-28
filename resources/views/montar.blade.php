@extends('layouts.default')
@section('content')

	<form action = "{{route('new_simulado_qst')}}" method = "post" class="shadow p-3 mb-5 bg-white rounded">
		
		<h1 class="text-center">Montar Simulado</h1><br>

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<input type = "hidden" name="_token" value="{{csrf_token()}}">
		<input type = "hidden" name="simulado_id" value="{{$simulado_id}}">
		
		<div class="grid">
			<div class="row">
				<div class="col-md-4">
					<label for="dificuldade">Disciplina</label>
					<select name="disciplina_id" class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>	
						@foreach ($disciplinas as $disciplina)
							<option value="{{$disciplina->id}}" {{ old('disciplina') == $disciplina->id ? 'selected' : '' }}	>{{$disciplina->nome}} </option>
						@endforeach
					</select>
					@if ($errors->has('disciplina_id'))
						<span class = "invalid-feedback" role="alert">
							{{$errors->first('disciplina_id')}}
						</span>
					@endif
				</div>

				<div class="col-md-4">
					<label for="dificuldade">Dificuldade</label>
					<select name="dificuldade" class="form-control{{ $errors->has('dificuldade') ? ' is-invalid' : '' }}" required autofocus>
						<option value="1" {{ old('dificuldade') == 1 ? 'selected' : '' }} >Fácil</option>
						<option value="2" {{ old('dificuldade') == 2 ? 'selected' : '' }} >Médio</option>
						<option value="3" {{ old('dificuldade') == 3 ? 'selected' : '' }} >Difícil</option>
					</select>
				</div>
				<div class="form-group col-md-4 parent">
					<label for="numero">Quantidade de Questões</label>
					<input type="number" class="form-control"  name="numero" id="numero" placeholder="numero" max="30" required>
				</div>
			</div>

			<div class="row justify-content-center">
				<input type="submit" value="Montar" name="nome" class="btn btn-primary" />
			</div>

		</div>

		<br>
			
		<h1>Lista de Questões Selecionadas</h1>
		<table class="table">

			<thead>
				<tr>
					<th>Numº Questao</th>
					<th>Enunciado</th>
					<th>Nivel Questão</th>
					<th>ID da Disciplina</th>
					<th>Funções</th>
				</tr>
			</thead>
			<tbody>
				@if($questaos)
					@foreach($questaos as $qst)
						<tr>
							<td>{{$qst->id}}</td>
							<td>{{  preg_replace('/<[^>]*>|[&;]/', '', $qst->enunciado) }}</td>
							<td>
								@if($qst->dificuldade  == 1)
									Fácil
								@elseif($qst->dificuldade  == 2)
									Médio
								@else
									Difícil
								@endif
							</td>
							<td>{{$qst->disciplina_id}}</td>
							<td><a href="{{route('delete_qst_simulado', ['id'=>$qst->id])}}">Remover</a></td>
						</tr>
					@endforeach
				@else
					<td colspan="4 ">Não existe questões cadastradas</td>
				@endif
			</tbody>
		</table>
	</form>
@stop
