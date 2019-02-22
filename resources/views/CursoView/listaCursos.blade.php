@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">

	<h1> Lista de Cursos </h1><br><br>
	<table class="table">
 		<thead>
			<tr>
				<th>Id</th>
				<th>Nome do Curso</th>
				<th>ID do Ciclo</th>
				<th>Unidade</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cursos as $curso)
			<tr>
				<td>{{$curso->id}}</td>
				<td>{{$curso->curso_nome}}</td>
				<td>{{$curso->ciclo_id}}</td>
				<td>{{$curso->unidade->nome}}</td>
				<td> 
					<a href="/editar/curso/{{$curso->id}}">Editar</a> - 
					<a href="/remover/curso/{{$curso->id}}">Remover</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<a href="/cadastrar/curso"> Adicionar um Curso</a>
@stop