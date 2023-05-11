@extends('layouts.app')
@section('titulo','Questões Cadastradas')
@section('content')

<div class="shadow p-3 bg-white" style="border-radius: 10px">
    <div class="row" style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
        <div class="col-sm">
            <h1 style="margin-left: 15px; margin-top: 15px">Questões Cadastradas</h1>
            <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px"><a href="{{route('home')}}" style="color: inherit;">Início</a> > Questões Cadastradas</p>
        </div>
    </div>

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
                    <table class="table table-hover" id="tabela_dados" style="border-style: groove; border-color: #6cb2eb">
                        <thead>
                            <tr class="header" style="background: #1B2E4F; color: white">
                                <th>Enunciado</th>
                                <th>Nível</th>
                                <th>Disciplinas</th>
                                <th class="text-center" style="width: 15%">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questaos as $questao)
                                <tr>
                                    <td class="align-middle" style="overflow: hidden; word-wrap: break-word; max-width: 38rem;" href="#modal_{{$questao->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip">
                                        {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao->enunciado)), $limit = 240, $end = '...') }}
                                    </td>
                                    <td class="align-middle" href="#modal_{{$questao->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip">{{$questao->dificuldade}}</td>
                                    <td class="align-middle" href="#modal_{{$questao->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip" id="disciplina">{{$questao->disciplina->nome}}</td>

                                    <td class="align-middle text-center">
                                        <a class="icons btn btn-info" href="#modal_{{$questao->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip" title="Visualizar"><i class="fa fa-eye"></i></a>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal_{{$questao->qstid}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitle_{{$questao->qstid}}">{{$questao->disciplina->nome}} - {{$questao->dificuldade}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Voltar">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body" style="overflow: hidden; word-wrap: break-word;">
                                                        <div class="row">
                                                            <div class="card-header w-100">
                                                                <span> {!! $questao->toArray()['enunciado'] !!} </span>
                                                            </div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">Alternativas:</h5>
                                                                    <div class="list-group container">
                                                                        <span
                                                                            class="list-group-item {{  $questao->alternativa_correta == '0' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_a'] !!}</span>
                                                                        <span
                                                                            class="list-group-item {{  $questao->alternativa_correta == '1' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_b'] !!}</span>
                                                                        <span
                                                                            class="list-group-item {{  $questao->alternativa_correta == '2' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_c'] !!}</span>
                                                                        <span
                                                                            class="list-group-item {{  $questao->alternativa_correta == '3' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_d'] !!}</span>
                                                                        <span
                                                                            class="list-group-item {{  $questao->alternativa_correta == '4' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_e'] !!}</span>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Questoes Discursivas -->
            <div class="tab-pane fade" id="listar_questao_discursiva" role="tabpanel" aria-labelledby="cadastrar-questao-discursiva-tab">
                <div class="list-group list-group-flush">
                    <table class="table table-hover" id="tabela_dados_" style="border-style: groove; border-color: #6cb2eb">
                        <thead>
                            <tr class="header" style="background: #1B2E4F; color: white">
                                <th>Enunciado</th>
                                <th>Nível</th>
                                <th>Disciplinas</th>
                                <th class="text-center" style="width: 15%">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questoes_discursivas as $questao_discursiva)
                                <tr>
                                    <td class="align-middle" style="overflow: hidden; word-wrap: break-word; max-width: 38rem;" href="#modal-questao-discursiva-{{$questao_discursiva->qsdtid}}" data-toggle="modal" data-placement="bottom" rel="tooltip">
                                        {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao_discursiva->enunciado)), $limit = 240, $end = '...') }}
                                    </td>
                                    <td class="align-middle" href="#modal-questao-discursiva-{{$questao_discursiva->qsdtid}}" data-toggle="modal" data-placement="bottom" rel="tooltip">{{$questao_discursiva->dificuldade}}</td>
                                    <td class="align-middle" href="#modal-questao-discursiva-{{$questao_discursiva->qsdtid}}" data-toggle="modal" data-placement="bottom" rel="tooltip" id="disciplina">{{$questao_discursiva->disciplina->nome}}</td>

                                    <td class="align-middle text-center">
                                        <a class="icons btn btn-info" href="#modal-questao-discursiva-{{$questao_discursiva->qsdtid}}" data-toggle="modal" data-placement="bottom" rel="tooltip" title="Visualizar"><i class="fa fa-eye"></i></a>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-questao-discursiva-{{$questao_discursiva->qsdtid}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitle_{{$questao_discursiva->qsdtid}}">{{$questao_discursiva->disciplina->nome}} - {{$questao_discursiva->dificuldade}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Voltar">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body" style="overflow: hidden; word-wrap: break-word;">
                                                        <div class="row">
                                                            <div class="card-header w-100">
                                                                <span> {!! $questao_discursiva->toArray()['enunciado'] !!} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="legenda">
                <p>Legenda:</p>
                <a class="icons btn btn-info"
                    data-placement="bottom" rel="tooltip" title="Visualizar" style="color: white"><i class="fa fa-eye"></i></a>
                Mostrar Questão
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
