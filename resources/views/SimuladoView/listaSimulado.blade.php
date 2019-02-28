@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
	<h1> Simulados Cadastrados </h1><br><br>
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
					<a href="{{route('edit_simulado', ['id'=>$simulado->id])}}">Editar</a> -
					<a href="{{route('delete_simulado', ['id'=>$simulado->id])}}">Remover</a> - 
					<a href="{{route('set_simulado', ['id'=>$simulado->id])}}">Montar</a>
				</td>
			</tr>
			@endforeach
		</tbody>
		
	</table>
	<a href="{{route('new_simulado')}}">Adicionar um simulado</a>
@stop