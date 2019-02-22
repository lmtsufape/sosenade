@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
	<h1>Lista de Coordenadores</h1>
	<table class="table table-hover table-bordered">
 		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>CPF</th>
				<th>Email</th>
				<th>Curso</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach($usuarios as $usuario)
			<tr>
				<td>{{$usuario->id}}</td>
				<td>{{$usuario->nome}}</td>
				<td>{{$usuario->cpf}}</td>
				<td>{{$usuario->email}}</td>
				<td>{{$usuario->curso_id}}</td>
				
	

				<td> <a href='/editar/usuario/{{$usuario->id}}'>Editar</a> - <a href='/remover/usuario/{{$usuario->id}}'>Remover</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<a class="btn btn-primary " href="/cadastrar/usuario"> Inserir novo </a>
</div>
@stop
