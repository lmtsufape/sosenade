@extends('layouts.app')
@section('titulo','Montar Simulado')
@section('content')

	<form action = "{{route('add_qst_simulado')}}" method = "post" class="shadow p-3 bg-white rounded">
		
		<h1 class="text-center">Montar Simulado - {{$titulo_simulado}} </h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

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
					<input type="number" class="form-control"  name="numero" id="numero" value="1" max="30" required>
				</div>
			</div>

			<div class="row justify-content-center">
				<input type="submit" value="Adicionar" name="nome" class="btn btn-primary" />
			</div>

		</div>

		<br>
			
		<h1>Lista de Questões Adicionadas</h1><br>
		<table class="table">

			<thead>
				<tr>
					<th>Enunciado</th>
					<th>Nível</th>
					<th>Disciplina</th>
					<th>Funções</th>
				</tr>
			</thead>
			<tbody>
				@if($questaos)
					@foreach($questaos as $qst)
						<tr>
							<td>{{  preg_replace('/<[^>]*>|[&;]/', '', $qst->enunciado) }}</td>
							<td>
								@if($qst->dificuldade == 1)
									Fácil
								@elseif($qst->dificuldade == 2)
									Médio
								@else
									Difícil
								@endif
							</td>
							<td>{{$qst->disc_nome}}</td>
							<td><a href="{{route('remove_qst_simulado', ['sim_qst_id'=>$qst->id])}}">Remover</a></td>
						</tr>
					@endforeach
				@else
					<td colspan="4 ">Não existe questões cadastradas</td>
				@endif
			</tbody>
		</table>
		<div class="form-group col-md-12 text-center">
			<br><a class="btn btn-primary mr-3" href="{{route('list_simulado')}}"> Voltar para lista </a><br>
		</div>
	</form>
@stop
