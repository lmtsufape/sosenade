@extends('layouts.app')
@section('titulo','Usuários Cadastrados')
@section('content')

    <div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">
	
		<h1 class="text-center">Usuários Cadastrados</h1><br>
		
		@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@elseif (session('fail'))
			<div class="alert alert-danger">
				{{ session('fail') }}
			</div>
		@endif

		@if(!$usuarios->isEmpty())
			<table id="tabela_dados" class="table table-hover">
		 		<thead>
					<tr>
						<th>Nome</th>
						<th>Tipo de usuário</th>
						<th>CPF</th>
						<th>E-mail</th>
						<th>Curso</th>
						<th>Unidade</th>
						<th style="width: 7%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach($usuarios as $usuario)
						<tr>
							<td>{{$usuario->nome}}</td>
							<td>{{$usuario->tipousuario->tipo}}</td>
							<td>{{$usuario->cpf}}</td>
							<td>{{$usuario->email}}</td>
							<td>{{$usuario->curso_nome}}</td>
							<td>{{$usuario->curso->unidade->nome}}</td>
							<td class="btn-group">
								<a href="{{route('edit_usuario',['id'=>$usuario->userid])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_usuario',['id'=>$usuario->userid])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem usuários cadastrados até o momento.</p>
		@endif

		<hr class="star-light">

		<div class="justify-content-center text-center">
			<a class="btn btn-primary " href="{{route('new_usuario')}}"> Inserir novo </a><br><br>
		</div>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabela_dados').DataTable({
				"columnDefs": [
					{ "orderable": false, "targets": 6 }
				],
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
				}
			});
		} );
	</script>

@stop
