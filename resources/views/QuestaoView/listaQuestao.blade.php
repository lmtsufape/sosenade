@extends('layouts.app')
@section('titulo','Questões Cadastradas')
@section('content')

<div class="shadow p-3 bg-white" style="border-radius: 10px">
    <div class="row" style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
        <div class="col-sm">
            <h1 style="margin-left: 15px; margin-top: 15px">Questões Cadastradas</h1>
            <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px"><a href="{{route('home')}}" style="color: inherit;">Início</a> > Questões Cadastradas</p>
        </div>

        <div class="col-sm" style="margin-top: 30px; margin-right: 20px">
            <a class="btn btn-primary" href="{{route('new_qst')}}" style="float: right;"> Criar questão</a><br>
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

    <div class="card" id="body-tabs">

        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="listar-questao-objetiva-tab" data-toggle="tab" href="#listar_questao_objetiva" role="tab"
                    aria-controls="listar_questao_objetiva" aria-selected="true">Questões Objetivas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="listar-questao-discursiva-tab" data-toggle="tab" href="#listar_questao_discursiva" role="tab"
                    aria-controls="listar_questao_discursiva" aria-selected="false">Questões Discursivas</a>
                </li>
            </ul>
        </div>
        <br>

        <div class="tab-content" id="myTabContent">

            <!-- Questoes Objetivas -->
            <div class="tab-pane fade show active" id="listar_questao_objetiva" role="tabpanel" aria-labelledby="cadastrar-questao-objetiva-tab">
                <div class="list-group list-group-flush">
                    @include('QuestaoView.partialsListaQuestao.objetivas')
                </div>
            </div>

            <!-- Questoes Discursivas -->
            <div class="tab-pane fade" id="listar_questao_discursiva" role="tabpanel" aria-labelledby="cadastrar-questao-discursiva-tab">
                <div class="list-group list-group-flush">
                    @include('QuestaoView.partialsListaQuestao.discursivas')
                </div>
            </div>

            <div id="legenda">
                <p>Legenda:</p>
                <a class="icons btn btn-info"
                data-placement="bottom" rel="tooltip" title="Visualizar" style="color: white"><i class="fa fa-eye"></i></a>
                Mostrar Questão
                <a class="btn btn-primary"
                data-placement="bottom" rel="tooltip" title="Editar" style="color: white; margin-left: 5px"><i
                class="fa fa-pencil"></i></a>
                Editar Questão
                <a class="btn btn-danger"
                data-placement="bottom" rel="tooltip" title="Excluir" style="color: white; margin-left: 5px"><i
                class="fa fa-trash"></i></a>
                Deletar Questão
            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#tabela_dados').DataTable({
            "order": [
                [2, "asc"]
            ],
            "columnDefs": [
                {"orderable": false, "targets": 3}
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
        });
        $('#tabela_dados_').DataTable({
            "order": [
                [2, "asc"]
            ],
            "columnDefs": [
                {"orderable": false, "targets": 3}
            ],
            "language": {
               "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
        });

    });
    $('[rel="tooltip"]').tooltip();
</script>

<style type="text/css">
    .nounderline {
        text-decoration: none !important
    }
</style>

@stop
