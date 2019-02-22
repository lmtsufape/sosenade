@extends('layouts.default')
@section('content')
    
	<h1> Lista de Unidades </h1><br><br>
	<table class="table">
 		<thead>
		
			<tr>
				<th>ID da Unidade</th>
				<th>Nome/th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($unidadeAcademicas as $unidadeAcademica)
			<tr>
				<td>{{$unidadeAcademica->id}}</td>
				<td>{{$unidadeAcademica->nome}}</td>
			</tr>
			@endforeach
		</tbody>
		
	</table>
@stop