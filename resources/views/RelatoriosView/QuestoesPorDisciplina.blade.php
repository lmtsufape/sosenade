@extends('layouts.relatorios')
@section('titulo','Questões Cadastradas Por Disciplina')
@section('date',$date)
@section('content')
    <table class="table table-bordered table-striped">
 		<thead>
			<tr>
				<th>Disciplina</th>
				<th>Nível</th>
				<th>Nº de Questões</th>
			</tr>
		</thead>
		<tbody>
			@foreach($disciplinas as $disciplina)
				<tr>
					<td>{{$disciplina->nome}}</td>
					<td>
						@if($disciplina->dificuldade == 1)
							Fácil
						@elseif($disciplina->dificuldade == 2)
							Médio
						@else
							Difícil
						@endif
					</td>
					<td>{{$disciplina->questaos_count}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop