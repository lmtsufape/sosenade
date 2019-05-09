@extends('layouts.app')
@section('titulo','Ciclos Cadastrados')
@section('content')
    <div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">

		<h1 class="text-center"> Cursos </h1><br>
		@if(!$cursos->isEmpty())
			<table id="tabela_dados" class="table table-hover">
		 		<thead>
					<tr>
						<th>Nome do Curso</th>
						<th>Ciclo</th>
						<th>Unidade</th>
						<th style="width: 7%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($cursos as $curso)
						<tr>
							<td>{{$curso->curso_nome}}</td>
							<td>{{$curso->tipo_ciclo}}</td>
							<td>{{$curso->unidade->nome}}</td>
							<td class="btn-group">
								<a href="{{route('edit_curso',['id'=>$curso->curso_id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_curso',['id'=>$curso->curso_id])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem cursos cadastrados até o momento.</p>
		@endif

		<hr class="star-light">

		<div class="text-center mt-5">
			<a class="btn btn-primary" href="{{route('new_curso')}}"> Adicionar um novo curso </a><br><br>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabela_dados').DataTable({
				"columnDefs": [
					{ "orderable": false, "targets": 3 }
				],
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
				}
			});
		} );
	</script>

@stop