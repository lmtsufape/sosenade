@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">

		<h1 class="text-center"> Cursos </h1><br>
		<table class="table table-hover">
	 		<thead>
				<tr>
					<th>Nome do Curso</th>
					<th>Ciclo</th>
					<th>Unidade</th>
					<th>Funções</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($cursos as $curso)
					<tr>
						<td>{{$curso->curso_nome}}</td>
						<td>{{$curso->tipo_ciclo}}</td>
						<td>{{$curso->unidade->nome}}</td>
						<td> 
							<a href="{{route('edit_curso',['id'=>$curso->curso_id])}}">Editar</a> - 
							<a href="{{route('delete_curso',['id'=>$curso->curso_id])}}">Remover</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_curso')}}"> Adicionar um novo curso </a><br>
		</div>

	</div>
	
@stop