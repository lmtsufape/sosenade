@extends('layouts.default')
@section('content')

	<div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">

		<h1>Ciclos</h1><br>
		<table class="table table-hover">
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
							<a href="{{route('edit_ciclo', ['id' => $ciclo->id])}}">Editar</a> -
							<a href="{{route('delete_ciclo', ['id' => $ciclo->id])}}">Remover</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_ciclo')}}"> Adicionar um novo ciclo </a><br>
		</div>

	</div>
	
@stop