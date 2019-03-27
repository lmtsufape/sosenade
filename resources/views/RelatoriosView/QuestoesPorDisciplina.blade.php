<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/relatorios.css') }}" rel="stylesheet">
    <title>Relatório de Questões</title>
</head>
<body>
    <h1 class="text-center">Questões Cadastradas Por Disciplina</h1>
	<h2 class="text-center">
		@if (Auth::guard('aluno')->user())
			{{Auth::guard('aluno')->user()->curso->curso_nome}}
		@elseif (Auth::user())
			{{Auth::user()->curso->curso_nome}}
		@endif
		- Emitido em {{$date}}
	</h2><br>

	<table class="table table-bordered">
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

</body>
</html>