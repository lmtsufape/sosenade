@extends('AlunoBlade/css')
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
	<h1> Lista de Simulado </h1><br><br>
	<table class="table">
 		<thead>
		
			<tr>
				<th>Descricao</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($simulados as $simulado)
			<tr>
				<td>{{$simulado->descricao_simulado}}</td>>
				<td>
					<a href="/questao/simulado/{{$simulado->id}}">Responder</a>
				</td>
			</tr>
			@endforeach
		</tbody>
		
	</table>
