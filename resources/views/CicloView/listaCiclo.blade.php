@extends('layouts.app')
@section('titulo','Ciclos Cadastrados')
@section('content')
	<div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">
		<h1 class="text-center">Ciclos</h1><br>
		@if(!$ciclos->isEmpty())
			<table class="table table-hover">
		 		<thead>
					<tr>
						<th>Ciclo (nº de cursos)</th>
						<th style="width: 10%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($ciclos as $ciclo)
						<tr>
							<td>{{$ciclo->tipo_ciclo}} <span class="badge badge-primary badge-pill">{{count($ciclo->cursos)}}</span></td>
							<td class="btn-group">
								<a href="{{route('edit_ciclo', ['id' => $ciclo->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_ciclo', ['id' => $ciclo->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem ciclos cadastrados até o momento.</p>
		@endif

		<div class="col-md-12 text-center">
			<br><a class="btn btn-primary" href="{{route('new_ciclo')}}"> Adicionar um novo ciclo </a><br>
		</div>
	</div>
@stop