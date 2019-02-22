@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
	<h1> Lista de Simulado </h1><br><br>
	<table class="table">
 		<thead>
		
			<tr>
				<th>Id do simulado</th>
				<th>Descricao</th>
				<th>Nome Usuario</th>
				<th>Nome Curso</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($simulados as $simulado)
			<tr>
				<td>{{$simulado->id}}</td>
				<td>{{$simulado->descricao_simulado}}</td>
				<td>{{$simulado->usuario_id}}</td>
				<td>{{$simulado->curso_id}}</td>
				<td>
					
					<a href="/editar/simulado/{{$simulado->id}}">Editar</a> -
					<a href="/remover/simulado/{{$simulado->id}}">Remover</a> - 
					<a href="/montar/simulado/{{$simulado->id}}">Montar</a> -
					
					
				</td>
			</tr>
			@endforeach
		</tbody>
		
	</table>
	<a href="/cadastrar/simulado"> Adicionar um simulado</a>
@stop