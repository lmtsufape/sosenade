@extends('layouts.app')
@section('titulo','Disciplinas Cadastradas')
@section('content')

	<div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">
	    
		<h1 class="text-center">Disciplinas/Conteúdos Cadastrados</h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>
		@if(!$disciplinas->isEmpty())
			<table class="table table-hover">
		 		<thead>
					<tr>
						<th>Nome</th>
						<th style="width: 20%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($disciplinas as $disciplina)
						<tr>
							<td style="">{{$disciplina->nome}}</td>
							<td>
								<a href="{{route('list_qst_disciplina', ['id'=>$disciplina->id])}}" class="btn btn-info" data-placement="bottom" rel="tooltip" title="Ver questões"><i class="fa fa-eye"></i></a>
								<a href="{{route('edit_disciplina',['id'=>$disciplina->id])}}" class="btn btn-primary" data-placement="bottom" rel="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_disciplina',['id'=>$disciplina->id])}}" class="btn btn-danger" data-placement="bottom" rel="tooltip" title="Excluir"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem disciplinas cadastradas até o momento.</p>
		@endif

		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_disciplina')}}"> Adicionar uma nova disciplina </a><br>
		</div>

	</div>

	<script type="text/javascript">
		$('[rel="tooltip"]').tooltip();
	</script>

@stop