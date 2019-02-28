@extends('layouts.default')
@section('content')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
	<h1> Simulados Cadastrados </h1><br><br>
	<table class="table">
 		<thead>
			<tr>
				<th>#</th>
				<th>Descrição</th>
				<th>Criado por</th>
				<th>Curso</th>
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
  
	<div class="col-md-12 text-center">
		<br><a class="btn btn-primary" href="{{route('new_simulado')}}">Adicionar um simulado</a><br>
	</div>
@stop