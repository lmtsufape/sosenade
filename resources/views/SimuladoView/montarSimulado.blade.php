@extends('layouts.app')
@section('titulo','Montar Simulado')
@section('content')
	<form action = "{{route('add_qst_simulado')}}" method = "post" class="shadow p-4 bg-white rounded">
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
		
		<div class="card mb-3">
			<div class="card-header">
				<h3 class="card-title">Adicionar Questões</h3>
			</div>
			<div class="card-body">
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

					<div class="col-md-12 row justify-content-center text-center">
						<input type="submit" value="Adicionar" name="nome" class="btn btn-success"/>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<small class="text-muted">Selecione nos campos acima o tipo de questôes que deseja adicionar no simulado.</small>
			</div>
		</div>
		
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Questões Adicionadas</h3>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Enunciado</th>
							<th>Nível</th>
							<th>Disciplina</th>
							<th>Opções</th>
						</tr>
					</thead>
					<tbody>
						@if($questaos)
							@foreach($questaos as $qst)
								<tr>
									<td style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
										{{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $qst->questao->enunciado)), $limit = 180, $end = '...') }}
									</td>
									<td>{{$qst->questao->dificuldade}}</td>
									<td id="disciplina">{{$qst->questao->disciplina->nome}}</td>
									<td>
										<a class="icons btn btn-info" data-toggle="modal" href="#modal_{{$qst->questao->id}}"><i class="fa fa-info-circle"></i></a>
										<a href="{{route('edit_qst', ['id'=>$qst->questao->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
										<a onclick="return confirm('Você tem certeza que deseja remover?')" href="{{route('remove_qst_simulado', ['sim_qst_id'=>$qst->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
									</td>
								</tr>

								<!-- Modal -->
								<div class="modal fade" id="modal_{{$qst->questao->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="modalTitle_{{$qst->questao->id}}">{{$qst->questao->disciplina->nome}} - {{$qst->questao->dificuldade}}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Voltar">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" style="overflow: hidden; word-wrap: break-word;">
												<div class="row">
													<div class="card-header w-100">
														<span> {!! $qst->questao->toArray()['enunciado'] !!} </span>
													</div>
													<div class="card-body">
														<h5 class="card-title">Alternativas:</h5>
														<div class="list-group container">
															<span class="list-group-item {{  $qst->questao->alternativa_correta == '0' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_a'] !!}</span>
															<span class="list-group-item {{  $qst->questao->alternativa_correta == '1' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_b'] !!}</span>
															<span class="list-group-item {{  $qst->questao->alternativa_correta == '2' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_c'] !!}</span>
															<span class="list-group-item {{  $qst->questao->alternativa_correta == '3' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_d'] !!}</span>
															<span class="list-group-item {{  $qst->questao->alternativa_correta == '4' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_e'] !!}</span>
														</div>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<a href="{{route('edit_qst', ['id'=>$qst->questao->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
												<a onclick="return confirm('Você tem certeza que deseja remover?')" href="{{route('remove_qst_simulado', 	['sim_qst_id'=>$qst->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						@else
							<td colspan="4 ">Não existe questões cadastradas</td>
						@endif
					</tbody>
				</table>
				<hr class="my-4">
				<div class="text-center justify-content-center">
					<a class="btn btn-primary mr-3" href="{{route('list_simulado')}}"> Pronto </a>
				</div>
			</div>
			<div class="card-footer">
				<small class="text-muted">Clique no botão Pronto para finalizar.</small>
			</div>
		</div>
	</form>
@stop
