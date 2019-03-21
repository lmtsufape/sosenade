@extends('layouts.default')
@section('content')

    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
	
		<h1 class="text-center">Usuários Cadastrados</h1><br>
		<table class="table table-hover">
	 		<thead>
				<tr>
					<th>Nome</th>
					<th>Tipo de usuário</th>
					<th>CPF</th>
					<th>E-mail</th>
					<th>Curso</th>
					<th>Funções</th>
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
						<td>
							<a href="{{route('edit_usuario',['id'=>$usuario->userid])}}">Editar</a> -
							<a href="{{route('delete_usuario',['id'=>$usuario->userid])}}">Remover</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="form-group justify-content-center row">
			{{$usuarios->links()}}
		</div>

		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary " href="{{route('new_usuario')}}"> Inserir novo </a><br>
		</div>

	</div>

@stop
