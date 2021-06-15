@extends('layouts.app')
@section('titulo','Respostas discursivas')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
            style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Respostas discursivas</h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a>
                    <a href="{{route('listar_simulados_questoes_discursivas')}}" style="color: inherit;">> Simulados com respostas discursivas</a>
                    > Respostas discursivas
                </p>
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

        <div class="list-group list-group-flush">
            <br>
            @if(!$respostas->isEmpty())
                <table class="table table-hover" id="tabela_dados" style="border-style: groove; border-color: #6cb2eb">
                    <thead>
                        <tr class="header" style="background: #1B2E4F; color: white">
                            <th>Questão</th>
                            <th>Corrigida?</th>
                            <th style="width: 15%">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($respostas as $resposta)
                            <tr>
                                <td class="align-middle" style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
                                    {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $resposta->questao_discursiva->enunciado)), $limit = 80, $end = '...') }}
                                </td>

                                <td>
                                    {{$resposta->foi_corrigida()}}
                                </td>

                                <td class="align-middle">
                                    <a class="icons btn btn-info" href="{{route('avaliar_resposta_discursivas',[$resposta->simulado_id, $resposta->id])}}" data-placement="bottom" rel="tooltip" title="Visualizar">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center alert alert-light">Não existem simulados com questões discursivas até o momento.</p>
            @endif
            <hr>
            <div id="legenda">
                <p>Legenda:</p>
                <a class="icons btn btn-info" data-placement="bottom" rel="tooltip" title="Visualizar" style="color: white">
                    <i class="fa fa-eye"></i>
                </a>
                Ver resposta
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
