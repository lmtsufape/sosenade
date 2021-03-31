@extends('layouts.app')
@section('titulo','Instituições Cadastradas')
@section('content')

    <div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">

		<h1 class="text-center">Instituições Cadastradas</h1><br>

		{{-- @if(!$usuarios->isEmpty()) --}}
			<table id="tabela_dados" class="table table-hover">
		 		<thead>
					<tr>
						<th>Nome</th>
						<th>E-mail</th>
						<th>CNPJ</th>
						<th style="width: 7%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach($instituicoes as $instituicao)
						<tr>
							<td>{{ $instituicao->nome }}</td>
							<td>{{ $instituicao->email }}</td>
							<td>{{ $instituicao->cnpj }}</td>
							<td class="btn-group">
								<a href="{{route('edit_instituicao',['id'=>$instituicao->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{ route('delete_instituicao', ['id'=>$instituicao->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		{{-- @else
			<p class="text-center alert alert-light">Não existem Instituições cadastradas até o momento.</p>
		@endif --}}

		<hr class="star-light">

		<div class="justify-content-center text-center">
			<a class="btn btn-primary " href="{{route('new_instituicao')}}"> Inserir nova </a><br><br>
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
