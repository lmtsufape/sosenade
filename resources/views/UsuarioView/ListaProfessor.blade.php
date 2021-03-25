@extends('layouts.app')
@section('titulo','Professores Cadastrados')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Professores Cadastrados</h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Inicio</a> >
                    Professores Cadastrados
                </p>
            </div>

            <div class="col-sm" style="margin-top: 30px; margin-right: 20px">
                <a class="btn btn-primary" href="{{route('new_professor')}}" style="float: right;"> Inserir Professor</a><br>
            </div>

        </div>

		@if(!$usuarios->isEmpty())
            <table class="table table-hover" id="tabela_dados" style="border-style: groove; border-color: #6cb2eb">
		 		<thead>
                <tr class="header" style="background: #1B2E4F; color: white">
						<th>Nome</th>
						<th>CPF</th>
						<th>E-mail</th>
						<th style="width: 15%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach($usuarios as $usuario)
						<tr>
                            <td class="align-middle" style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">{{$usuario->nome}}</td>
							<td class="align-middle">{{$usuario->cpf}}</td>
							<td class="align-middle">{{$usuario->email}}</td>
							<td>
								<a href="{{route('edit_professor',['id'=>$usuario->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_professor',['id'=>$usuario->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem professores cadastrados até o momento.</p>
		@endif

        <hr>

        <p>Legenda:</p>
        <a class="btn btn-primary"
           data-placement="bottom" rel="tooltip" title="Editar" style="color: white; margin-left: 5px"><i
                class="fa fa-pencil"></i></a>
        Editar Professor
        <a class="btn btn-danger"
           data-placement="bottom" rel="tooltip" title="Excluir" style="color: white; margin-left: 5px"><i
                class="fa fa-trash"></i></a>
        Deletar Professor

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabela_dados').DataTable({
                "order": [
                    [2, "asc"]
                ],
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
