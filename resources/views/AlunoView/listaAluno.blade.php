@extends('layouts.app')
@section('titulo','Lista de Alunos Cadastrados')
@section('content')
    
    <div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">
		<h1 class="text-center">Alunos Cadastrados</h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>
		@if(!$alunos->isEmpty())
			<table id="tabela_dados" class="table table-hover">
		 		<thead>
					<tr>
						<th>Nome</th>
						<th>CPF</th>
						<th>E-mail</th>
						<th style="width: 10%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach($alunos as $aluno)
						<tr>
							<td>{{$aluno->nome}}</td>
							<td>{{$aluno->cpf}}</td>
							<td>{{$aluno->email}}</td>
							<td class="btn-group">
								<a href="{{route('edit_aluno', ['id' => $aluno->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_aluno', ['id' => $aluno->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem alunos cadastrados até o momento.</p>
		@endif
		
		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_aluno')}}"> Inserir novo </a><br>
		</div>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabela_dados').DataTable({
				"columnDefs": [
					{ "orderable": false, "targets": 3 }
				],
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
				}
			});
		} );
	</script>

@stop