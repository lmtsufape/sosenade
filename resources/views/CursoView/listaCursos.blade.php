@extends('layouts.app')
@section('titulo','Ciclos Cadastrados')
@section('content')
    <div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">

		<h1 class="text-center"> Cursos </h1><br>
		@if(!$cursos->isEmpty())
			<table class="table table-hover">
		 		<thead>
					<tr>
						<th>Nome do Curso</th>
						<th>Ciclo</th>
						<th>Unidade</th>
						<th style="width: 10%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($cursos as $curso)
						<tr>
							<td>{{$curso->curso_nome}}</td>
							<td>{{$curso->tipo_ciclo}}</td>
							<td>{{$curso->unidade->nome}}</td>
							<td class="btn-group">
								<a href="{{route('edit_curso',['id'=>$curso->curso_id])}}" class="btn btn-sm btn-primary">Editar</a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_curso',['id'=>$curso->curso_id])}}" class="btn btn-sm btn-danger">Remover</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem cursos cadastrados até o momento.</p>
		@endif

		<hr class="star-light">
		
		<div class="form-group float-right row mr-1">
			{{$cursos->links()}}
		</div>

		<div class="col-md-6 left">
			<a class="btn btn-primary" href="{{route('new_curso')}}"> Adicionar um novo curso </a><br><br>
		</div>
	</div>
@stop