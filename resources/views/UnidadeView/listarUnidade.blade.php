@extends('layouts.app')
@section('titulo','Instituições Cadastradas')
@section('content')

    <div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">

		<h1 class="text-center">Unidades Cadastradas</h1><br>

		@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@elseif (session('fail'))
			<div class="alert alert-danger">
				{{ session('fail') }}
			</div>
		@endif

		@if(!$unidades->isEmpty())
			<table id="tabela_dados" class="table table-hover">
		 		<thead>
					<tr>
						<th>Nome</th>
					</tr>
				</thead>
				<tbody>
					@foreach($unidades as $unidade)
						<tr>
							<td>{{ ($instituicao->nome. ' - ' .$unidade->nome) }}</td>
							<td class="btn-group">
								<a href="{{route('edit_unidade', ['id'=>$unidade->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{ route('delete_unidade', ['id'=>$unidade->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem Unidades cadastradas até o momento.</p>
		@endif

		<hr class="star-light">

		<div class="justify-content-center text-center">
			<a class="btn btn-primary " href="{{route('new_unidade')}}"> Inserir nova </a><br><br>
		</div>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabela_dados').DataTable({
				"columnDefs": [
					{ "orderable": false, "targets": 6 }
				],
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
				}
			});
		} );
	</script>

@stop
