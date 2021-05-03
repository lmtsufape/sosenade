@extends('layouts.app')
@section('titulo','Lista de Alunos Cadastrados')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Alunos Cadastrados</h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a> >
                    Alunos Cadastradas
                </p>
            </div>
            <div class="col-sm" style="margin-top: 30px; margin-right: 20px">
                <a class="btn btn-primary" href="{{route('new_aluno')}}" style="float: right;"> Inserir Aluno </a><br>
            </div>
        </div>

        @if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
		@elseif (session('fail'))
			<div class="alert alert-danger">
				{{ session('fail') }}
			</div>
		@endif

        @if(!$alunos->isEmpty())
            <table id="tabela_dados" class="table table-hover" style="border-style: groove; border-color: #6cb2eb">
                <thead>
                <tr class="header" style="background: #1B2E4F; color: white">
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th style="width: 15%">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($alunos as $aluno)
                    <tr>
                        <td>{{$aluno->nome}}</td>
                        <td>{{$aluno->cpf}}</td>
                        <td>{{$aluno->email}}</td>
                        <td>
                            <a href="{{route('edit_aluno', ['id' => $aluno->id])}}" class="btn btn-primary"><i
                                    class="fa fa-pencil"></i></a>
                            <a onclick="return confirm('Você tem certeza que deseja excluir?')"
                               href="{{route('delete_aluno', ['id' => $aluno->id])}}" class="btn btn-danger"><i
                                    class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center alert alert-light">Não existem alunos cadastrados até o momento.</p>
        @endif

        <hr>

        <p>Legenda:</p>
        <a class="btn btn-primary"
           data-placement="bottom" rel="tooltip" title="Editar" style="color: white; margin-left: 5px"><i
                class="fa fa-pencil"></i></a>
        Editar Aluno
        <a class="btn btn-danger"
           data-placement="bottom" rel="tooltip" title="Excluir" style="color: white; margin-left: 5px"><i
                class="fa fa-trash"></i></a>
        Deletar Aluno
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabela_dados').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 3}
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>

@stop
