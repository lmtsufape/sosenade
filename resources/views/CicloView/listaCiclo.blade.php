@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
   
	<h1> Lista de ciclo </h1><br><br>
	<table class="table">
 		<thead>
		
			<tr>
				<th>Id do ciclo</th>
				<th>Tipo do ciclo</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($ciclos as $ciclo)
			<tr>
				<td>{{$ciclo->id}}</td>
				<td>{{$ciclo->tipo_ciclo}}</td>
				<td>
					<a href="/editar/ciclo/{{$ciclo->id}}">Editar</a> -
					<a href="/remover/ciclo/{{$ciclo->id}}">Remover</a>
				</td>
			</tr>
			@endforeach
		</tbody>
		
	</table>
	<a href="/cadastrar/ciclo"> Adicionar um ciclo</a>
@stop