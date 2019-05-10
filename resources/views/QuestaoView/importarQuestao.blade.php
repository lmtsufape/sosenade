@extends('layouts.app')
@section('titulo','Importar Questão')
@section('content')
	
	@if(Session::has('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ Session::get('message', '') }}
		</div>
	@elseif(Session::has('fail'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ Session::get('message', '') }}
		</div>
	@endif

	<div class="shadow p-3 bg-white rounded">
		<h1 class="text-center">Importar Questão</h1>
		<h2 class="text-center mb-4">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2>

		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Filtrar Questões Por Curso</h5>
			</div>
			<form class="card-body" action="{{route('import_qst_post')}}" method="post">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="d-flex w-100 justify-content-center">
					<div class="col-md-4 text-center">
						<label for="curso_id">Cursos:</label>
						<select id='curso_id' name="curso_id" class="form-control{{ $errors->has('curso_id') ? ' is-invalid' : '' }}" required autofocus>
							<option selected hidden value="null"></option>
							@foreach ($cursos as $curso)
								<option value="{{$curso->id}}" {{old('curso') == $curso->id ? 'selected' : '' }}>
									{{$curso->curso_nome}} - {{$curso->unidade->nome}} 
								</option>
							@endforeach
						</select>
					</div>

					<div class="col-md-4 text-center">
						<label for="disciplina_id">Disciplinas:</label>
						<select id='disciplina_id' name="disciplina_id" class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required autofocus>
							<option selected hidden value="null"></option>
							@foreach ($disciplinas as $disciplina)
								<option rel="{{$disciplina->curso->id}}" value="{{$disciplina->id}}" {{old('disciplina') == $disciplina->id ? 'selected' : '' }}>
									{{$disciplina->nome}} - {{$disciplina->curso->curso_nome}} 
								</option>
							@endforeach
						</select>
						<small id="message_small" class="text-muted" hidden>Nenhuma disciplina disponível neste curso.</small>
					</div>
				</div>

				<div class="justify-content-center text-center mt-4 mb-2">
					<input id="lista_btn" type="submit" value="Listar" name="nome" class="btn btn-success" disabled />
				</div>
			</form>
			<div class="card-footer">
				<small class="text-muted">Selecione o curso, a disciplina/conteúdo da questão e clique em Listar para ver as questões disponíveis para importação.</small>
			</div>
		</div>
		<div class="card my-3">
			<div class="card-header">
				<h5 class="card-title">Questões Adicionadas</h5>
			</div>
			<div class="card-body">
				@if($questaos->count())
					<table id="tabela_dados" class="table">
						<thead>
							<tr>
								<th>Enunciado</th>
								<th>Nível</th>
								<th>Disciplina</th>
								<th>Opções</th>
							</tr>
						</thead>
						<tbody>
								@foreach($questaos as $qst)
									<tr>
										<td style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
											{{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $qst->enunciado)), $limit = 180, $end = '...') }}
										</td>
										<td>{{$qst->dificuldade}}</td>
										<td id="disciplina">{{$qst->disciplina->nome}}</td>
										<td>
											<a class="icons btn btn-info" data-toggle="modal" href="#modal_{{$qst->id}}" data-placement="bottom" rel="tooltip" title="Visualizar"><i class="fa fa-eye"></i></a>
											
										</td>
									</tr>

									<!-- Modal -->
									<div class="modal fade" id="modal_{{$qst->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modalTitle_{{$qst->id}}">{{$qst->disciplina->nome}} - {{$qst->dificuldade}}</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Voltar">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body" style="overflow: hidden; word-wrap: break-word;">
													<div class="row">
														<div class="card-header w-100">
															<span> {!! $qst->toArray()['enunciado'] !!} </span>
														</div>
														<div class="card-body">
															<h5 class="card-title">Alternativas:</h5>
															<div class="list-group container">
																<span class="list-group-item {{  $qst->alternativa_correta == '0' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_a'] !!}</span>
																<span class="list-group-item {{  $qst->alternativa_correta == '1' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_b'] !!}</span>
																<span class="list-group-item {{  $qst->alternativa_correta == '2' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_c'] !!}</span>
																<span class="list-group-item {{  $qst->alternativa_correta == '3' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_d'] !!}</span>
																<span class="list-group-item {{  $qst->alternativa_correta == '4' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_e'] !!}</span>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<a href="{{route('edit_qst', ['id'=>$qst->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
													<a onclick="return confirm('Você tem certeza que deseja remover?')" href="{{route('remove_qst_simulado', 	['sim_qst_id'=>$qst->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
												</div>
											</div>
										</div>
									</div>
								@endforeach
						</tbody>
					</table>
				@else
					<p class="text-center alert alert-light">Nenhuma questão para mostrar.</p>
				@endif
				<hr class="my-4">
				<div class="text-center justify-content-center">
					<a class="btn btn-primary mr-3 {{($questaos->count() == 0) ? 'disabled' : ''}}" href="#">Importar</a>
				</div>
			</div>
			<div class="card-footer">
				<small class="text-muted">Marque as questões que deseja importar para seu curso, e clique no botão Importar para finalizar.</small>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		//Reference: https://jsfiddle.net/fwv18zo1/
		var $select1 = $('#curso_id'),
			$select2 = $('#disciplina_id'),
			$options = $select2.find('option');
			
		$select1.on('change', function() {
			$select2.html( 
				$options.filter('[rel="' + this.value + '"]')
			);
			if($options.filter('[rel="' + this.value + '"]').length == 0) {
				$select2.prop('disabled', 'disabled');
				if (this.value != 'null') {
					$('#message_small').prop('hidden', false);
				}
				$('#lista_btn').prop('disabled', 'disabled');
				$select2.val('null');
			} else {
				$select2.prop('disabled', false);
				$('#message_small').prop('hidden', 'hidden');
				$('#lista_btn').prop('disabled', false);
			};
		}).trigger('change');

		$(document).ready(function() {
			$('#tabela_dados').DataTable({
				"order": [
					[ 2, "asc" ]
				],
				"columnDefs": [
					{ "orderable": false, "targets": 3 }
				],
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
				}
			});
		});
		$('[rel="tooltip"]').tooltip();
	</script>

@stop