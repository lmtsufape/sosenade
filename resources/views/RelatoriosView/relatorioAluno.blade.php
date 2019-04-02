@extends('layouts.relatorios')
@section('titulo','Relatório geral Aluno')
@section('date',$date)
@section('content')
    <table class="table table-bordered">
 		<thead>
			<tr>
				<th>Nome</th>
			</tr>
		</thead>
		<tbody>
			@foreach($alunos as $aluno)
				<tr>
					<td>{{$aluno->nome}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop