@extends('layouts.app')
@section('titulo','Usuários Cadastrados')
@section('content')

    <div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">
	
		<h1 class="text-center">Usuários Cadastrados</h1><br>
		
		@if(!$usuarios->isEmpty())
			<table class="table table-hover">
		 		<thead>
					<tr>
						<th>Nome</th>
						<th>Tipo de usuário</th>
						<th>CPF</th>
						<th>E-mail</th>
						<th>Curso</th>
						<th style="width: 15%">Opções</th>
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
							<td class="btn-group">
								<a href="{{route('edit_usuario',['id'=>$usuario->userid])}}" class="btn btn-sm btn-primary">Editar</a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_usuario',['id'=>$usuario->userid])}}" class="btn btn-sm btn-danger">Remover</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem usuários cadastrados até o momento.</p>
		@endif

		<hr class="star-light">

		<div class="form-group justify-content-center row">
			{{$usuarios->links()}}
		</div>

		<div class="col-md-6 left">
			<a class="btn btn-primary " href="{{route('new_usuario')}}"> Inserir novo </a><br><br>
		</div>

	</div>

@stop
