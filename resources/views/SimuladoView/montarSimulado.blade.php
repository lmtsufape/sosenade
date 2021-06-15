@extends('layouts.app')
@section('titulo','Montar Simulado')
@section('content')
    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="titleHeader row">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px">Montar Simulado - {{$titulo_simulado}}</h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a> >
                    <a href="{{route('list_simulado')}}" style="color: inherit;">Lista de Simulados</a> >
                    Montar Simulado - {{$titulo_simulado}}
                </p>
            </div>
        </div>
        
        <div class="card" id="body-tabs">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="montar-simulado-questoes-objetivas-tab" data-toggle="tab" href="#montar-simulado-questoes-objetivas" role="tab"
                           aria-controls="montar-simulado-questoes-objetivas" aria-selected="true">Questões Objetivas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="montar-simulado-questoes-discursivas-tab" data-toggle="tab" href="#montar-simulado-questoes-discursivas" role="tab"
                           aria-controls="montar-simulado-questoes-discursivas" aria-selected="false">Questões Discursivas</a> 
                    </li>

                    <ul class="nav ml-auto">
                        <li class="nav_item ml-auto" id="switch_qst_objetivas">
                            <!-- Switch Simulado Objetivo -->
                            <input type="checkbox" id="tipo_montagem_objetiva" data-toggle="toggle" data-on="Automático" data-off="Manual" data-onstyle="primary" data-offstyle="secondary" checked>
                            <!--  -->
                        </li>

                        <li class="nav_item" id="switch_qst_discursivas">
                            <!-- Switch Simulado Discursivo -->
                            <input type="checkbox" id="tipo_montagem_discursiva" data-toggle="toggle" data-on="Automático" data-off="Manual" data-onstyle="primary" data-offstyle="secondary" checked>
                        </li>
                    </ul>
                </ul>
            </div>
            <br>

            <div class="tab-content" id="myTabContent">

                <!-- Montar Simulado QSTs Objetivas -->
                <div class="tab-pane fade show active" id="montar-simulado-questoes-objetivas" role="tabpanel" aria-labelledby="montar-simulado-questoes-objetivas-tab">
                    <div class="list-group list-group-flush">
                        <br>

                            <form id="form_qst_objetivas" action="{{route('add_qst_simulado')}}" method="post">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" id="simulado_id" name="simulado_id" value="{{$simulado_id}}">
                                <input type="hidden" id="bool_simulado_montagem_automatica_objetiva" name="bool_simulado_montagem_automatica_objetiva" value="{{$bool_simulado_montagem_automatica_objetiva}}">

                                    <!-- Container: requisicao de simulado -->
                                    <div class="form-group row justify-content-center">
                                        <div class="form-group col-md-2 headerLateral">
                                            <h1 style="font-size: 70px">1º</h1>
                                            <small>Selecione nos campos acima o tipo de questôes que deseja adicionar no
                                                simulado.</small>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <div class="card">
                                                <div class="listaHeader card-header">
                                                    <h5 class="card-title">Procurar Questões</h5>
                                                </div>
                                                
                                                <!-- Simulado Manual -->
                                                <div id="container_requisicao_montagem_manual">

                                                    <div class="card-body row justify-content-center">
                                                        <div class="col-md-4 text-center">
                                                            <label for="dificuldade">Disciplina</label>
                                                            <select name="disciplina_id"
                                                                    class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}"
                                                                    required autofocus>
                                                                <option value="" selected hidden style="text-align: center">Selecione a Disciplina
                                                                </option>
                                                                @foreach ($disciplinas as $disciplina)
                                                                    <option
                                                                        value="{{$disciplina->id}}" {{ old('disciplina') == $disciplina->id ? 'selected' : '' }} >{{$disciplina->nome}} </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('disciplina_id'))
                                                                <span class="invalid-feedback" role="alert">
                                                                {{$errors->first('disciplina_id')}}
                                                            </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-4 text-center">
                                                            <label for="dificuldade">Dificuldade</label>
                                                            <select name="dificuldade"
                                                                    class="form-control{{ $errors->has('dificuldade') ? ' is-invalid' : '' }}"
                                                                    required autofocus>
                                                                <option value="" selected hidden style="text-align: center">Selecione a
                                                                    Dificuldade
                                                                </option>
                                                                <option value="1" {{ old('dificuldade') == 1 ? 'selected' : '' }} >Fácil
                                                                </option>
                                                                <option value="2" {{ old('dificuldade') == 2 ? 'selected' : '' }} >Médio
                                                                </option>
                                                                <option value="3" {{ old('dificuldade') == 3 ? 'selected' : '' }} >Difícil
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Simulado automatico -->
                                                    <div id="container_requisicao_montagem_automatica">

                                                        <div class="card-body row justify-content-center">
                                                            <div class="col-md-4 text-center">
                                                                <label id="label_numero" for="numero">Quantidade de Questões</label>
                                                                <input type="number" class="form-control" name="numero" id="numero" value="1" max="30"
                                                                    required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--  -->

                                                    <div class="col-md-12 row justify-content-center text-center" style="margin-bottom: 10px">
                                                        <input type="submit" value="Adicionar" name="nome" class="btn btn-success"/>
                                                    </div>

                                                </div>
                                                <!--  -->

                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->

                                    <!-- Questoes Exernas -->
                                    <div id="container_montagem_manual" class="form-group row justify-content-center">
                                        <div class="form-group col-md-2 headerLateral">
                                            <h1 style="font-size: 70px">2º</h1>
                                            <small>Selecione as questões para o seu simulado clicando no icone.</small>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <div class="card">
                                                <div class="card-header listaHeader">
                                                    <h5 class="card-title">Questões Não Selecionadas</h5>
                                                </div>
                                                <div id="tabela_externa" class="card-body">
                                                    <table id="tabela_dados1" class="table tabelaBorder">
                                                        <thead>
                                                        <tr class="listaHeader">
                                                            <th>Enunciado</th>
                                                            <th>Nível</th>
                                                            <th>Disciplina</th>
                                                            <th>Opções</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tbody_externa_obj">

                                                        @if( !$questoes_externas_simulado->isEmpty() )
                                                            @foreach($questoes_externas_simulado as $qst)
                                                                    <tr id="questao_objetiva_{{$qst->id}}" class="questoes_externas_obj">
                                                                        <td style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
                                                                            {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $qst->enunciado)), $limit = 180, $end = '...') }}
                                                                        </td>
                                                                        <td>{{$qst->dificuldade}}</td>
                                                                        <td id="disciplina">{{$qst->disciplina->nome}}</td>
                                                                        <td class="btn-group">
                                                                            <a class="icons btn btn-sm btn-info" data-toggle="modal"
                                                                            href="#modal_{{$qst->id}}" data-placement="bottom"
                                                                            rel="tooltip"
                                                                            title="Visualizar"><i class="fa fa-eye"></i></a>
                                                                            <a href="{{route('edit_qst', ['id'=>$qst->id])}}"
                                                                            class="btn btn-sm btn-primary" data-placement="bottom"
                                                                            rel="tooltip"
                                                                            title="Editar"><i class="fa fa-pencil"></i></a>
                                                                            
                                                                            <!-- Button Add Questao -->
                                                                            <button class="btn btn-sm btn-secondary add_qst_obj_async" id="{{'btn_add_qst_obj_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Adicionar ao Simulado">
                                                                                <i class="fa fa-angle-down"></i>
                                                                            </button>
                                                                            <!-- End Button -->

                                                                            <!-- Button Remove Questao -->
                                                                            <button class="btn btn-sm btn-secondary btn_hide_on_ready remove_qst_obj_async" id="{{'btn_remove_qst_obj_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Remover do Simulado">
                                                                                <i class="fa fa-angle-up"></i>
                                                                            </button>
                                                                            <!-- End Button -->

                                                                            <!-- Button Excluir Questao -->
                                                                            <button class="btn btn-sm btn-danger excluir_qst_obj_async" id="{{'btn_excluir_qst_obj_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Excluir do Simulado">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                            <!-- End Button -->

                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="modal_{{$qst->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="modalTitle_{{$qst->id}}">{{$qst->disciplina->nome}}
                                                                                                - {{$qst->dificuldade}}</h5>
                                                                                            <button type="button" class="close"
                                                                                                    data-dismiss="modal"
                                                                                                    aria-label="Voltar">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body" style="overflow: hidden; word-wrap: break-word;">
                                                                                            <div class="row">
                                                                                                <div class="card-header w-100">
                                                                                                    <span> {!! $qst->toArray()['enunciado'] !!} </span>
                                                                                                </div>
                                                                                                <div class="card-body">
                                                                                                    <h5 class="card-title">Alternativas:</h5>
                                                                                                    <div class="list-group container">
                                                                                                        <span
                                                                                                            class="list-group-item {{  $qst->alternativa_correta == '0' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_a'] !!}</span>
                                                                                                        <span
                                                                                                            class="list-group-item {{  $qst->alternativa_correta == '1' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_b'] !!}</span>
                                                                                                        <span
                                                                                                            class="list-group-item {{  $qst->alternativa_correta == '2' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_c'] !!}</span>
                                                                                                        <span
                                                                                                            class="list-group-item {{  $qst->alternativa_correta == '3' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_d'] !!}</span>
                                                                                                        <span
                                                                                                            class="list-group-item {{  $qst->alternativa_correta == '4' ? 'list-group-item-success' : '' }}">{!! $qst->toArray()['alternativa_e'] !!}</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">

                                                                                            <a href="{{route('edit_qst', ['id'=>$qst->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                                                                            <!-- Button Add Questao Modal -->
                                                                                            <button class="btn btn-secondary add_qst_obj_async" id="{{'btn_add_qst_obj_modal_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Adicionar ao Simulado">
                                                                                                <i class="fa fa-angle-down"></i>
                                                                                            </button>
                                                                                            <!-- End Button -->

                                                                                            <!-- Button Remove Questao Modal -->
                                                                                            <button class="btn btn-secondary btn_hide_on_ready remove_qst_obj_async" id="{{'btn_remove_qst_obj_modal_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Remover do Simulado">
                                                                                                <i class="fa fa-angle-up"></i>
                                                                                            </button>
                                                                                            <!-- End Button -->

                                                                                            <!-- Button Excluir Questao Modal -->
                                                                                            <button class="btn btn-danger excluir_qst_obj_async" id="{{'btn_excluir_qst_obj_modal_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Excluir do Simulado">
                                                                                                <i class="fa fa-trash"></i>
                                                                                            </button>
                                                                                            <!-- End Button -->

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Fim Modal -->
                                                                        </td>
                                                                    </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="questoes_obj_externas_empty" class="card-body">
                                                    <p class="text-center alert alert-light">Não existem questões dessa categoria fora do simulado.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->

                                    <!-- Questoes do Simulado -->
                                    <div class="form-group row justify-content-center">
                                        <div class="form-group col-md-2 headerLateral">
                                            <h1 id="cabecalho_03" style="font-size: 70px">3º</h1>
                                            <small>Clique no botão Pronto para finalizar.</small>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <div class="card">
                                                <div class="card-header listaHeader">
                                                    <h5 class="card-title">Questões Adicionadas</h5>
                                                </div>
                                                <div id="tabela_simulado" class="card-body">
                                                        <table id="tabela_dados2" class="table tabelaBorder">
                                                            <thead>
                                                            <tr class="listaHeader">
                                                                <th>Enunciado</th>
                                                                <th>Nível</th>
                                                                <th>Disciplina</th>
                                                                <th>Opções</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="tbody_simulado_obj">
                                                            @if($questaos->all())
                                                                @foreach($questaos as $qst)
                                                                <tr id="{{'questao_objetiva_'.$qst->questao->id}}" class="questoes_simulado_obj">
                                                                    <td style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
                                                                        {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $qst->questao->enunciado)), $limit = 180, $end = '...') }}
                                                                    </td>
                                                                    <td>{{$qst->questao->dificuldade}}</td>
                                                                    <td id="disciplina">{{$qst->questao->disciplina->nome}}</td>
                                                                    <td class="btn-group">
                                                                        <a class="icons btn btn-sm btn-info" data-toggle="modal"
                                                                        href="#modal_{{$qst->questao->id}}" data-placement="bottom"
                                                                        rel="tooltip"
                                                                        title="Visualizar"><i class="fa fa-eye"></i></a>
                                                                        <a href="{{route('edit_qst', ['id'=>$qst->questao->id])}}"
                                                                        class="btn btn-sm btn-primary" data-placement="bottom"
                                                                        rel="tooltip"
                                                                        title="Editar"><i class="fa fa-pencil"></i></a>

                                                                        <!-- Button Add Questao -->
                                                                        <button class="btn btn-sm btn-secondary btn_hide_on_ready add_qst_obj_async" id="{{'btn_add_qst_obj_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Adicionar ao Simulado">
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <!-- End Button -->

                                                                        <!-- Button Remove Questao -->
                                                                        <button class="btn btn-sm btn-secondary remove_qst_obj_async" id="{{'btn_remove_qst_obj_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Remover do Simulado">
                                                                            <i class="fa fa-angle-up"></i>
                                                                        </button>
                                                                        <!-- End Button -->

                                                                        <!-- Button Excluir Questao -->
                                                                        <button class="btn btn-sm btn-danger excluir_qst_obj_async" id="{{'btn_excluir_qst_obj_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Excluir do Simulado">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                        <!-- End Button -->

                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="modal_{{$qst->questao->id}}"
                                                                            tabindex="-1"
                                                                            role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                                role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="modalTitle_{{$qst->questao->id}}">{{$qst->questao->disciplina->nome}}
                                                                                            - {{$qst->questao->dificuldade}}</h5>
                                                                                        <button type="button" class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Voltar">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body"
                                                                                        style="overflow: hidden; word-wrap: break-word;">
                                                                                        <div class="row">
                                                                                            <div class="card-header w-100">
                                                                                                <span> {!! $qst->questao->toArray()['enunciado'] !!} </span>
                                                                                            </div>
                                                                                            <div class="card-body">
                                                                                                <h5 class="card-title">Alternativas:</h5>
                                                                                                <div class="list-group container">
                                                                                                    <span
                                                                                                        class="list-group-item {{  $qst->questao->alternativa_correta == '0' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_a'] !!}</span>
                                                                                                    <span
                                                                                                        class="list-group-item {{  $qst->questao->alternativa_correta == '1' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_b'] !!}</span>
                                                                                                    <span
                                                                                                        class="list-group-item {{  $qst->questao->alternativa_correta == '2' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_c'] !!}</span>
                                                                                                    <span
                                                                                                        class="list-group-item {{  $qst->questao->alternativa_correta == '3' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_d'] !!}</span>
                                                                                                    <span
                                                                                                        class="list-group-item {{  $qst->questao->alternativa_correta == '4' ? 'list-group-item-success' : '' }}">{!! $qst->questao->toArray()['alternativa_e'] !!}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                        <a href="{{route('edit_qst', ['id'=>$qst->questao->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                                                                        <!-- Button Add Questao Modal -->
                                                                                        <button class="btn btn-secondary btn_hide_on_ready add_qst_obj_async" id="{{'btn_add_qst_obj_modal_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Adicionar ao Simulado">
                                                                                            <i class="fa fa-angle-down"></i>
                                                                                        </button>
                                                                                        <!-- End Button -->

                                                                                        <!-- Button Remove Questao Modal -->
                                                                                        <button class="btn btn-secondary remove_qst_obj_async" id="{{'btn_remove_qst_obj_modal_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Remover do Simulado">
                                                                                            <i class="fa fa-angle-up"></i>
                                                                                        </button>
                                                                                        <!-- End Button -->

                                                                                        <!-- Button Excluir Questao Modal -->
                                                                                        <button class="btn btn-danger excluir_qst_obj_async" id="{{'btn_excluir_qst_obj_modal_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Excluir do Simulado">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </button>
                                                                                        <!-- End Button -->

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            @endif
                                                            <tbody>
                                                    </table>
                                                </div>
                                                <div id="questoes_obj_simulado_empty" class="card-body">
                                                    <p class="text-center alert alert-light">Não existem questões dentro do simulado.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                            </form>
                            <hr>
                            <div class="row">
                                <div class="col-sm-9">
                                    <p>Legenda:</p>
                                    <a class="icons btn btn-info"
                                    data-placement="bottom" rel="tooltip" title="Visualizar" style="color: white"><i
                                            class="fa fa-eye"></i></a>
                                    Mostrar Questão
                                    <a class="btn btn-primary"
                                    data-placement="bottom" rel="tooltip" title="Editar" style="color: white; margin-left: 5px"><i
                                            class="fa fa-pencil"></i></a>
                                    Editar Questão
                                    <a class="btn btn-danger"
                                    data-placement="bottom" rel="tooltip" title="Excluir" style="color: white; margin-left: 5px"><i
                                            class="fa fa-trash"></i></a>
                                    Deletar Questão
                                    <a class="btn btn-secondary"
                                    data-placement="bottom" rel="tooltip" title="Adicionar" style="color: white; margin-left: 5px"><i
                                            class="fa fa-angle-down"></i></a>
                                    Adicionar Questão
                                    <a class="btn btn-secondary"
                                    data-placement="bottom" rel="tooltip" title="Remover" style="color: white; margin-left: 5px"><i
                                            class="fa fa-angle-up"></i></a>
                                    Remover Questão
                                </div>

                                <div class="text-center justify-content-center col-sm-3">
                                    <a class="btn btn-primary mr-3" href="{{route('list_simulado')}}"
                                    style="margin-top: 30px; width: 200px"> Pronto </a>
                                </div>
                            </div>
                    </div>
                </div>
                <!--  -->

                <!-- Montar Simulado QSTs Dicursivas -->
                <div class="tab-pane fade show active hide_simulado_discursiva" id="montar-simulado-questoes-discursivas" role="tabpanel" aria-labelledby="montar-simulado-questoes-discursivas-tab">
                    <div class="list-group list-group-flush">
                        <br>

                            <form id="form_qst_discursivas" action="{{route('add_qst_disc_simulado_auto')}}" method="post">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" id="simulado_id_disc" name="simulado_id" value="{{$simulado_id}}">
                                <input type="hidden" id="bool_simulado_montagem_automatica_discursiva" name="bool_simulado_montagem_automatica_discursiva" value="{{$bool_simulado_montagem_automatica_discursiva}}">

                                    <!-- Container: requisicao de simulado -->
                                    <div class="form-group row justify-content-center">
                                        <div class="form-group col-md-2 headerLateral">
                                            <h1 style="font-size: 70px">1º</h1>
                                            <small>Selecione nos campos acima o tipo de questôes que deseja adicionar no
                                                simulado.</small>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <div class="card">
                                                <div class="listaHeader card-header">
                                                    <h5 class="card-title">Procurar Questões</h5>
                                                </div>
                                                
                                                <!-- Simulado Manual -->
                                                <div id="container_requisicao_montagem_manual_disc">

                                                    <div class="card-body row justify-content-center">
                                                        <div class="col-md-4 text-center">
                                                            <label for="dificuldade">Disciplina</label>
                                                            <select name="disciplina_id"
                                                                    class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}"
                                                                    required autofocus>
                                                                <option value="" selected hidden style="text-align: center">Selecione a Disciplina
                                                                </option>
                                                                @foreach ($disciplinas as $disciplina)
                                                                    <option
                                                                        value="{{$disciplina->id}}" {{ old('disciplina') == $disciplina->id ? 'selected' : '' }} >{{$disciplina->nome}} </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('disciplina_id'))
                                                                <span class="invalid-feedback" role="alert">
                                                                {{$errors->first('disciplina_id')}}
                                                            </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-4 text-center">
                                                            <label for="dificuldade">Dificuldade</label>
                                                            <select name="dificuldade"
                                                                    class="form-control{{ $errors->has('dificuldade') ? ' is-invalid' : '' }}"
                                                                    required autofocus>
                                                                <option value="" selected hidden style="text-align: center">Selecione a
                                                                    Dificuldade
                                                                </option>
                                                                <option value="1" {{ old('dificuldade') == 1 ? 'selected' : '' }} >Fácil
                                                                </option>
                                                                <option value="2" {{ old('dificuldade') == 2 ? 'selected' : '' }} >Médio
                                                                </option>
                                                                <option value="3" {{ old('dificuldade') == 3 ? 'selected' : '' }} >Difícil
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Simulado automatico -->
                                                    <div id="container_requisicao_montagem_automatica_disc">

                                                        <div class="card-body row justify-content-center">
                                                            <div class="col-md-4 text-center">
                                                                <label id="label_numero" for="numero">Quantidade de Questões</label>
                                                                <input type="number" class="form-control" name="numero" id="numero_disc" value="1" max="30"
                                                                    required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--  -->

                                                    <div class="col-md-12 row justify-content-center text-center" style="margin-bottom: 10px">
                                                        <input type="submit" value="Adicionar" name="nome" class="btn btn-success"/>
                                                    </div>

                                                </div>
                                                <!--  -->

                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->

                                    <!-- Questoes Exernas -->
                                    <div id="container_montagem_manual_disc" class="form-group row justify-content-center">
                                        <div class="form-group col-md-2 headerLateral">
                                            <h1 style="font-size: 70px">2º</h1>
                                            <small>Selecione as questões para o seu simulado clicando no icone.</small>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <div class="card">
                                                <div class="card-header listaHeader">
                                                    <h5 class="card-title">Questões Não Selecionadas</h5>
                                                </div>
                                                <div id="tabela_externa_disc" class="card-body">
                                                    <table id="tabela_dados3" class="table tabelaBorder">
                                                        <thead>
                                                        <tr class="listaHeader">
                                                            <th>Enunciado</th>
                                                            <th>Nível</th>
                                                            <th>Disciplina</th>
                                                            <th>Opções</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tbody_externa_disc">

                                                        @if( !$questoes_discursivas_externas_simulado->isEmpty() ) 
                                                            @foreach($questoes_discursivas_externas_simulado as $qst)
                                                                    <tr id="questao_discursiva_{{$qst->id}}" class="questoes_externas_disc">
                                                                        <td style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
                                                                            {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $qst->enunciado)), $limit = 180, $end = '...') }}
                                                                        </td>
                                                                        <td>{{$qst->dificuldade}}</td>
                                                                        <td id="disciplina">{{$qst->disciplina->nome}}</td>
                                                                        <td class="btn-group">
                                                                            <a class="icons btn btn-sm btn-info" data-toggle="modal"
                                                                            href="#modal_disc_{{$qst->id}}" data-placement="bottom"
                                                                            rel="tooltip"
                                                                            title="Visualizar"><i class="fa fa-eye"></i></a>
                                                                            <a href="{{route('edit_qst', ['id'=>$qst->id])}}"
                                                                            class="btn btn-sm btn-primary" data-placement="bottom"
                                                                            rel="tooltip"
                                                                            title="Editar"><i class="fa fa-pencil"></i></a>
                                                                            
                                                                            <!-- Button Add Questao -->
                                                                            <button class="btn btn-sm btn-secondary add_qst_disc_async" id="{{'btn_add_qst_disc_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Adicionar ao Simulado">
                                                                                <i class="fa fa-angle-down"></i>
                                                                            </button>
                                                                            <!-- End Button -->

                                                                            <!-- Button Remove Questao -->
                                                                            <button class="btn btn-sm btn-secondary remove_qst_disc_async btn_hide_on_ready_disc" id="{{'btn_remove_qst_disc_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Remover do Simulado">
                                                                                <i class="fa fa-angle-up"></i>
                                                                            </button>
                                                                            <!-- End Button -->

                                                                            <!-- Button Excluir Questao -->
                                                                            <button class="btn btn-sm btn-danger excluir_qst_disc_async" id="{{'btn_excluir_qst_disc_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Excluir do Simulado">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                            <!-- End Button -->

                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="modal_disc_{{$qst->id}}"
                                                                                tabindex="-1"
                                                                                role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="modalTitle_{{$qst->id}}">{{$qst->disciplina->nome}}
                                                                                                - {{$qst->dificuldade}}</h5>
                                                                                            <button type="button" class="close"
                                                                                                    data-dismiss="modal"
                                                                                                    aria-label="Voltar">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body"
                                                                                            style="overflow: hidden; word-wrap: break-word;">
                                                                                            <div class="row">
                                                                                                <div class="card-header w-100">
                                                                                                    <span> {!! $qst->toArray()['enunciado'] !!} </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">

                                                                                            <a href="{{route('edit_qst_disc', ['id'=>$qst->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                                                                            <!-- Button Add Questao Modal -->
                                                                                            <button class="btn btn-secondary add_qst_disc_async" id="{{'btn_add_qst_disc_modal_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Adicionar ao Simulado">
                                                                                                <i class="fa fa-angle-down"></i>
                                                                                            </button>
                                                                                            <!-- End Button -->

                                                                                            <!-- Button Remove Questao Modal -->
                                                                                            <button class="btn btn-secondary btn_hide_on_ready_disc remove_qst_disc_async" id="{{'btn_remove_qst_disc_modal_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Remover do Simulado">
                                                                                                <i class="fa fa-angle-up"></i>
                                                                                            </button>
                                                                                            <!-- End Button -->

                                                                                            <!-- Button Excluir Questao Modal -->
                                                                                            <button class="btn btn-danger excluir_qst_disc_async" id="{{'btn_excluir_qst_disc_modal_'.$qst->id}}" data-placement="bottom" rel="tooltip" title="Excluir do Simulado">
                                                                                                <i class="fa fa-trash"></i>
                                                                                            </button>
                                                                                            <!-- End Button -->

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Fim Modal -->
                                                                        </td>
                                                                    </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="questoes_disc_externas_empty" class="card-body">
                                                    <p class="text-center alert alert-light">Não existem questões dessa categoria fora do simulado.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->

                                    <!-- Questoes do Simulado -->
                                    <div class="form-group row justify-content-center">
                                        <div class="form-group col-md-2 headerLateral">
                                            <h1 id="cabecalho_03_disc" style="font-size: 70px">3º</h1>
                                            <small>Clique no botão Pronto para finalizar.</small>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <div class="card">
                                                <div class="card-header listaHeader">
                                                    <h5 class="card-title">Questões Adicionadas</h5>
                                                </div>
                                                <div id="tabela_simulado_disc" class="card-body">
                                                        <table id="tabela_dados4" class="table tabelaBorder">
                                                            <thead>
                                                            <tr class="listaHeader">
                                                                <th>Enunciado</th>
                                                                <th>Nível</th>
                                                                <th>Disciplina</th>
                                                                <th>Opções</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="tbody_simulado_disc">
                                                            @if($questoes_discursivas->all())
                                                                @foreach($questoes_discursivas as $qst)
                                                                <tr id="{{'questao_discursiva_'.$qst->questao->id}}" class="questoes_simulado_disc">
                                                                    <td style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
                                                                        {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $qst->questao->enunciado)), $limit = 180, $end = '...') }}
                                                                    </td>
                                                                    <td>{{$qst->questao->dificuldade}}</td>
                                                                    <td id="disciplina">{{$qst->questao->disciplina->nome}}</td>
                                                                    <td class="btn-group">
                                                                        <a class="icons btn btn-sm btn-info" data-toggle="modal"
                                                                        href="#modal_disc_{{$qst->questao->id}}" data-placement="bottom"
                                                                        rel="tooltip"
                                                                        title="Visualizar"><i class="fa fa-eye"></i></a>
                                                                        <a href="{{route('edit_qst_disc', ['id'=>$qst->questao->id])}}"
                                                                        class="btn btn-sm btn-primary" data-placement="bottom"
                                                                        rel="tooltip"
                                                                        title="Editar"><i class="fa fa-pencil"></i></a>

                                                                        <!-- Button Add Questao -->
                                                                        <button class="btn btn-sm btn-secondary btn_hide_on_ready_disc add_qst_disc_async" id="{{'btn_add_qst_disc_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Adicionar ao Simulado">
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <!-- End Button -->

                                                                        <!-- Button Remove Questao -->
                                                                        <button class="btn btn-sm btn-secondary remove_qst_disc_async" id="{{'btn_remove_qst_disc_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Remover do Simulado">
                                                                            <i class="fa fa-angle-up"></i>
                                                                        </button>
                                                                        <!-- End Button -->

                                                                        <!-- Button Excluir Questao -->
                                                                        <button class="btn btn-sm btn-danger excluir_qst_disc_async" id="{{'btn_excluir_qst_disc_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Excluir do Simulado">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                        <!-- End Button -->

                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="modal_disc_{{$qst->questao->id}}"
                                                                            tabindex="-1"
                                                                            role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                                role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="modalTitle_{{$qst->questao->id}}">{{$qst->questao->disciplina->nome}}
                                                                                            - {{$qst->questao->dificuldade}}</h5>
                                                                                        <button type="button" class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Voltar">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body"
                                                                                        style="overflow: hidden; word-wrap: break-word;">
                                                                                        <div class="row">
                                                                                            <div class="card-header w-100">
                                                                                                <span> {!! $qst->questao->toArray()['enunciado'] !!} </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                        <a href="{{route('edit_qst_disc', ['id'=>$qst->questao->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                                                                        <!-- Button Add Questao Modal -->
                                                                                        <button class="btn btn-secondary btn_hide_on_ready_disc add_qst_disc_async" id="{{'btn_add_qst_disc_modal_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Adicionar ao Simulado">
                                                                                            <i class="fa fa-angle-down"></i>
                                                                                        </button>
                                                                                        <!-- End Button -->

                                                                                        <!-- Button Remove Questao Modal -->
                                                                                        <button class="btn btn-secondary remove_qst_disc_async" id="{{'btn_remove_qst_disc_modal_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Remover do Simulado">
                                                                                            <i class="fa fa-angle-up"></i>
                                                                                        </button>
                                                                                        <!-- End Button -->

                                                                                        <!-- Button Excluir Questao Modal -->
                                                                                        <button class="btn btn-danger excluir_qst_disc_async" id="{{'btn_excluir_qst_disc_modal_'.$qst->questao->id}}" data-placement="bottom" rel="tooltip" title="Excluir do Simulado">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </button>
                                                                                        <!-- End Button -->

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            @endif
                                                            <tbody>
                                                    </table>
                                                </div>
                                                <div id="questoes_disc_simulado_empty" class="card-body">
                                                    <p class="text-center alert alert-light">Não existem questões dentro do simulado.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                            </form>
                            <hr>
                            <div class="row">
                                <div class="col-sm-9">
                                    <p>Legenda:</p>
                                    <a class="icons btn btn-info"
                                    data-placement="bottom" rel="tooltip" title="Visualizar" style="color: white"><i
                                            class="fa fa-eye"></i></a>
                                    Mostrar Questão
                                    <a class="btn btn-primary"
                                    data-placement="bottom" rel="tooltip" title="Editar" style="color: white; margin-left: 5px"><i
                                            class="fa fa-pencil"></i></a>
                                    Editar Questão
                                    <a class="btn btn-danger"
                                    data-placement="bottom" rel="tooltip" title="Excluir" style="color: white; margin-left: 5px"><i
                                            class="fa fa-trash"></i></a>
                                    Deletar Questão
                                    <a class="btn btn-secondary"
                                    data-placement="bottom" rel="tooltip" title="Adicionar" style="color: white; margin-left: 5px"><i
                                            class="fa fa-angle-down"></i></a>
                                    Adicionar Questão
                                    <a class="btn btn-secondary"
                                    data-placement="bottom" rel="tooltip" title="Remover" style="color: white; margin-left: 5px"><i
                                            class="fa fa-angle-up"></i></a>
                                    Remover Questão
                                </div>

                                <div class="text-center justify-content-center col-sm-3">
                                    <a class="btn btn-primary mr-3" href="{{route('list_simulado')}}"
                                    style="margin-top: 30px; width: 200px"> Pronto </a>
                                </div>
                            </div>
                    </div>
                </div>
                <!--  -->

            </div>
        </div>

    <style>
        label{
            font-weight: bold;
        }
    </style>

    <script type="text/javascript" async="async">
        $(document).ready(function () {
            $('#tabela_dados1').DataTable({
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

            $('#tabela_dados2').DataTable({
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

            $('#tabela_dados3').DataTable({
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

            $('#tabela_dados4').DataTable({
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

        // ---- Toogle Button / Tabs -------------------------------------------------------------
        $(document).ready(function() {
            
            $('#montar-simulado-questoes-objetivas-tab').on('click', function() {
                $('#switch_qst_objetivas').show()
                $('#switch_qst_discursivas').hide()
                $('.hide_simulado_discursiva').hide()
            })

            $('#montar-simulado-questoes-discursivas-tab').on('click', function() {
                $('#switch_qst_objetivas').hide()
                $('#switch_qst_discursivas').show()
                $('.hide_simulado_discursiva').show()
            })

            $('#tipo_montagem_objetiva').on('change', function(){

                var isChecked = $('#tipo_montagem_objetiva').prop('checked')

                const route_add_qst_obj_auto = "{{route('add_qst_simulado')}}"
                const route_add_qst_obj_manual = "{{route('add_qst_simulado_obj')}}"

                if(isChecked) {
                    $('#form_qst_objetivas').attr('action', route_add_qst_obj_auto)
                    $('#container_montagem_manual').hide()
                    $('#cabecalho_03').text('2º')
                    $('#container_requisicao_montagem_manual').show()
                    $('#container_requisicao_montagem_automatica').show()
                    $('.remove_qst_obj_async').hide()
                    $('.excluir_qst_obj_async').show()
                    $('#bool_simulado_montagem_automatica_objetiva').val(Number(isChecked))
                } else {
                    $('#form_qst_objetivas').attr('action', route_add_qst_obj_manual)
                    $('#container_montagem_manual').show()
                    $('#cabecalho_03').text('3º')
                    $('#container_requisicao_montagem_manual').show()
                    $('#container_requisicao_montagem_automatica').hide()
                    $('.remove_qst_obj_async').show()
                    $('.excluir_qst_obj_async').hide()
                    $('.btn_hide_on_ready').hide()
                    $('#bool_simulado_montagem_automatica_objetiva').val(Number(isChecked))
                }

            });

            $('#tipo_montagem_discursiva').on('change', function(){
                var isChecked = $('#tipo_montagem_discursiva').prop('checked')

                const route_add_qst_disc_auto = "{{route('add_qst_disc_simulado_auto')}}"
                const route_add_qst_disc_manual = "{{route('add_qst_disc_simulado_manual')}}"

                if(isChecked) {
                    $('#form_qst_discursivas').attr('action', route_add_qst_disc_auto)
                    $('#container_montagem_manual_disc').hide()
                    $('#cabecalho_03_disc').text('2º')
                    $('#container_requisicao_montagem_manual_disc').show()
                    $('#container_requisicao_montagem_automatica_disc').show()
                    $('.remove_qst_disc_async').hide()
                    $('.excluir_qst_disc_async').show()
                    $('#bool_simulado_montagem_automatica_discursiva').val(Number(isChecked))
                } else {
                    $('#form_qst_discursivas').attr('action', route_add_qst_disc_manual)
                    $('#container_montagem_manual_disc').show()
                    $('#cabecalho_03_disc').text('3º')
                    $('#container_requisicao_montagem_manual_disc').show()
                    $('#container_requisicao_montagem_automatica_disc').hide()
                    $('.remove_qst_disc_async').show()
                    $('.excluir_qst_disc_async').hide()
                    $('.btn_hide_on_ready_disc').hide()
                    $('#bool_simulado_montagem_automatica_discursiva').val(Number(isChecked))
                }
                
            });

        });

        // ---- Load inicial --------------------------------------------------------------
        $(document).ready(function(){

            if($('#montar-simulado-questoes-objetivas-tab').attr('aria-selected')) {
                $('#switch_qst_objetivas').show()
                $('#switch_qst_discursivas').hide()
                $('.hide_simulado_discursiva').hide()
            } else {
                $('#switch_qst_objetivas').hide()
                $('#switch_qst_discursivas').show()
                $('.hide_simulado_discursiva').show()
            }

            // ----- Montagem Simulado Objetivo ----------
            const route_add_qst_obj_auto = "{{route('add_qst_simulado')}}"
            const route_add_qst_obj_manual = "{{route('add_qst_simulado_obj')}}"

            var bool_simulado_montagem_automatica_objetiva = $('#bool_simulado_montagem_automatica_objetiva').val()
            $('#tipo_montagem_objetiva').prop('checked', bool_simulado_montagem_automatica_objetiva)

            $('.btn_hide_on_ready').hide()

            if($('.questoes_externas_obj').length > 0) {
                $('#tabela_externa').show()
                $('#questoes_obj_externas_empty').hide()
            } else {
                $('#tabela_externa').hide()
                $('#questoes_obj_externas_empty').show()
            }

            if($('.questoes_simulado_obj').length > 0) {
                $('#tabela_simulado').show()                
                $('#questoes_obj_simulado_empty').hide()
            } else {
                $('#tabela_simulado').show()
                $('#questoes_obj_simulado_empty').hide()
            }

            // Switch Montagem Objetiva
            if($('#tipo_montagem_objetiva').prop('checked')) {
                $('#form_qst_objetivas').attr('action', route_add_qst_obj_auto)
                $('#tipo_montagem_objetiva').bootstrapToggle('on')
                $('#container_montagem_manual').hide()
                $('#cabecalho_03').text('2º')
                $('#container_requisicao_montagem_manual').show()
                $('#container_requisicao_montagem_automatica').show()
            } else {
                $('#form_qst_objetivas').attr('action', route_add_qst_obj_manual)
                $('#tipo_montagem_objetiva').bootstrapToggle('off')
                $('#container_montagem_manual').show()
                $('#cabecalho_03').text('3º')
                $('.btn_hide_on_ready').hide()
                $('#container_requisicao_montagem_manual').show()
                $('#container_requisicao_montagem_automatica').hide()
            }

            // ----- Montagem Simulado Dicursivo ----------

            const route_add_qst_disc_auto = "{{route('add_qst_disc_simulado_auto')}}"
            const route_add_qst_disc_manual = "{{route('add_qst_disc_simulado_manual')}}"

            var bool_simulado_montagem_automatica_discursiva = $('#bool_simulado_montagem_automatica_discursiva').val()
            $('#tipo_montagem_discursiva').prop('checked', bool_simulado_montagem_automatica_discursiva)

            $('.btn_hide_on_ready_disc').hide()

            if($('.questoes_externas_disc').length > 0) {
                $('#tabela_externa_disc').show()
                $('#questoes_disc_externas_empty').hide()
            } else {
                $('#tabela_externa_disc').hide()
                $('#questoes_disc_externas_empty').show()
            }

            if($('.questoes_simulado_disc').length > 0) {
                $('#tabela_simulado_disc').show()                
                $('#questoes_disc_simulado_empty').hide()
            } else {
                $('#tabela_simulado_disc').show()
                $('#questoes_disc_simulado_empty').hide()
            }

            // Switch Montagem Discursiva
            if($('#tipo_montagem_discursiva').prop('checked')) {
                $('#form_qst_discursivas').attr('action', route_add_qst_disc_auto)
                $('#tipo_montagem_discursiva').bootstrapToggle('on')
                $('#container_montagem_manual_disc').hide()
                $('#cabecalho_03_disc').text('2º')
                $('#container_requisicao_montagem_manual_disc').show()
                $('#container_requisicao_montagem_automatica_disc').show()
            } else {
                $('#form_qst_discursivas').attr('action', route_add_qst_disc_manual)
                $('#tipo_montagem_discursiva').bootstrapToggle('off')
                $('#container_montagem_manual_disc').show()
                $('#cabecalho_03_disc').text('3º')
                $('.btn_hide_on_ready_disc').hide()
                $('#container_requisicao_montagem_manual_disc').show()
                $('#container_requisicao_montagem_automatica_disc').hide()
            }
            // --------------------------------------------
        });

        // ---- Funcoes assicronas add / remove / excluir --------------------------------------------
        $(document).ready(function() {

            // ---- Questoes Objetivas ---------------------------------------------------------------
            $('.add_qst_obj_async').click(function(){
                var isAdd = confirm('Você tem certeza que deseja adicionar essa questão ao simulado?')

                const id = this.id.split('_').pop()

                const btn_add_qst = $('#btn_add_qst_obj_'+id)
                const btn_remove_qst = $('#btn_remove_qst_obj_'+id)
                
                const btn_add_qst_modal = $('#btn_add_qst_obj_modal_'+id)
                const btn_remove_qst_modal = $('#btn_remove_qst_obj_modal_'+id)

                var tr = $('#questao_objetiva_'+id)
                var modal = $('#modal_'+id)

                var tabela_simulado = $('#tbody_simulado_obj')
                var tabela_externa = $('#tbody_externa_obj')
                var data_table_empty = $('.dataTables_empty')

                if(isAdd) {

                    $.ajax({
                        url: '/addQuestaoSimulado/Async/',
                        data: {
                            questao_id: id,
                            simulado_id: $('#simulado_id').val()
                        },
                        success: function(result) {
                            $('#tipo_montagem_objetiva').prop('checked', false)

                            if(result){
                                tr = tr.detach()
                                modal.modal('hide')

                                tr.removeClass('questoes_externas_obj')
                                tr.addClass('questoes_simulado_obj')

                                btn_add_qst.hide()
                                btn_remove_qst.show()

                                btn_add_qst_modal.hide()
                                btn_remove_qst_modal.show()

                                btn_remove_qst.removeClass('btn_hide_on_ready')
                                btn_remove_qst_modal.removeClass('btn_hide_on_ready')

                                data_table_empty.detach()
                                tabela_simulado.append(tr)

                                alert('Questão adicionada com sucesso!')
                            }

                            if($('.questoes_externas_obj').length == 0) {
                                $('#tabela_externa').hide()
                                $('#questoes_obj_externas_empty').show()
                            }

                            if($('.questoes_simulado_obj').length > 0) {
                                $('#tabela_simulado').show()
                                $('#questoes_obj_simulado_empty').hide()
                            }
                        }
                    });
                }
            });
            
            $('.remove_qst_obj_async').click(function() {
                var isRemove = confirm('Você tem certeza que deseja remover essa questão do simulado?')
                
                const id = this.id.split('_').pop()

                const btn_add_qst = $('#btn_add_qst_obj_'+id)
                const btn_remove_qst = $('#btn_remove_qst_obj_'+id)

                const btn_add_qst_modal = $('#btn_add_qst_obj_modal_'+id)
                const btn_remove_qst_modal = $('#btn_remove_qst_obj_modal_'+id)

                var modal = $('#modal_'+id)
                var tr = $('#questao_objetiva_'+id)

                var tabela_externa = $('#tbody_externa_obj')
                var tabela_simulado = $('#tbody_simulado_obj')
                var data_table_empty = $('.dataTables_empty')

                
                // $('.questoes_simulado_obj').length
                // alert($('.questoes_externas_obj'))

                if(isRemove) {
                    $.ajax({
                        url: '/removeQuestaoSimulado/Async/',
                        data: {
                            questao_id: id,
                            simulado_id: $('#simulado_id').val(),
                        },
                        success: function(result) {
                            $('#tipo_montagem_objetiva').prop('checked', false)

                            if(result) {

                                tr = tr.detach()
                                modal.modal('hide')

                                tr.addClass('questoes_externas_obj')
                                tr.removeClass('questoes_simulado_obj')

                                btn_add_qst.show()
                                btn_remove_qst.hide()

                                btn_add_qst_modal.show()
                                btn_remove_qst_modal.hide()

                                btn_add_qst.removeClass('btn_hide_on_ready')
                                btn_add_qst_modal.removeClass('btn_hide_on_ready')

                                btn_remove_qst.addClass('btn_hide_on_ready')
                                btn_remove_qst_modal.addClass('btn_hide_on_ready')

                                data_table_empty.detach()
                                tabela_externa.append(tr)
                                
                                alert('Questão removida com sucesso!')
                            }

                            if($('.questoes_simulado_obj').length == 0) {
                                $('#tabela_simulado').hide()
                                $('#questoes_obj_simulado_empty').show()
                            }

                            if($('.questoes_externas_obj').length > 0) {
                                $('#tabela_externa').show()
                                $('#questoes_obj_externas_empty').hide()
                            }
                        }
                    });
                }
            });

            $('.excluir_qst_obj_async').click(function() {
                
                var isDel = confirm('Você tem certeza que deseja remover?')

                const id = this.id.split('_').pop()

                var modal = $('#modal_'+id)
                var tr = $('#questao_objetiva_'+id)

                if(isDel) {

                    $.ajax({
                        url: '/removeQuestaoSimulado/Async/',
                        data: {
                            questao_id: id,
                            simulado_id: $('#simulado_id').val(),
                        },
                        success: function(result) {
                            $('#tipo_montagem_objetiva').prop('checked', true)

                            if(result) {

                                tr.detach()
                                modal.modal('hide')

                                tr.removeClass('questoes_simulado_obj')

                                alert('Questão removida com sucesso!')
                            }

                            if($('.questoes_simulado_obj').length == 0) {
                                $('#tabela_simulado').hide()
                                $('#questoes_obj_simulado_empty').show()
                            }

                            if($('.questoes_externas_obj').length > 0) {
                                $('#tabela_externa').show()
                                $('#questoes_obj_externas_empty').hide()
                            }
                        }
                    });
                }
            });
            
            // ---------------------------------------------------------------------------------------

            // ---- Questoes Dicursivas --------------------------------------------------------------

            $('.add_qst_disc_async').click(function(){
                var isAdd = confirm('Você tem certeza que deseja adicionar essa questão ao simulado?')

                const id = this.id.split('_').pop()

                const btn_add_qst = $('#btn_add_qst_disc_'+id)
                const btn_remove_qst = $('#btn_remove_qst_disc_'+id)
                
                const btn_add_qst_modal = $('#btn_add_qst_disc_modal_'+id)
                const btn_remove_qst_modal = $('#btn_remove_qst_disc_modal_'+id)

                var tr = $('#questao_discursiva_'+id)
                var modal = $('#modal_disc_'+id)

                var tabela_simulado = $('#tbody_simulado_disc')
                var tabela_externa = $('#tbody_externa_disc')
                var data_table_empty = $('.dataTables_empty')

                if(isAdd) {

                    $.ajax({
                        url: '/addQuestaoDiscursivaSimulado/Async/',
                        data: {
                            questao_id: id,
                            simulado_id: $('#simulado_id').val()
                        },
                        success: function(result) {
                            $('#tipo_montagem_discursiva').prop('checked', false)

                            if(result){
                                tr = tr.detach()
                                modal.modal('hide')

                                tr.removeClass('questoes_externas_disc')
                                tr.addClass('questoes_simulado_disc')

                                btn_add_qst.hide()
                                btn_remove_qst.show()

                                btn_add_qst_modal.hide()
                                btn_remove_qst_modal.show()

                                btn_remove_qst.removeClass('btn_hide_on_ready_disc')
                                btn_remove_qst_modal.removeClass('btn_hide_on_ready_disc')

                                data_table_empty.detach()
                                tabela_simulado.append(tr)

                                alert('Questão adicionada com sucesso!')
                            }

                            if($('.questoes_externas_disc').length == 0) {
                                $('#tabela_externa_disc').hide()
                                $('#questoes_disc_externas_empty').show()
                            }

                            if($('.questoes_simulado_disc').length > 0) {
                                $('#tabela_simulado_disc').show()
                                $('#questoes_disc_simulado_empty').hide()
                            }
                        }
                    });
                }
            });

            $('.remove_qst_disc_async').click(function() {
                var isRemove = confirm('Você tem certeza que deseja remover essa questão do simulado?')

                const id = this.id.split('_').pop()

                const btn_add_qst = $('#btn_add_qst_disc_'+id)
                const btn_remove_qst = $('#btn_remove_qst_disc_'+id)

                const btn_add_qst_modal = $('#btn_add_qst_disc_modal_'+id)
                const btn_remove_qst_modal = $('#btn_remove_qst_disc_modal_'+id)

                var modal = $('#modal_disc_'+id)
                var tr = $('#questao_discursiva_'+id)

                var tabela_externa = $('#tbody_externa_disc')
                var tabela_simulado = $('#tbody_simulado_disc')
                var data_table_empty = $('.dataTables_empty')

                if(isRemove) {
                    $.ajax({
                        url: '/removeQuestaoDiscursivaSimulado/Async/',
                        data: {
                            questao_id: id,
                            simulado_id: $('#simulado_id').val(),
                        },
                        success: function(result) {
                            $('#tipo_montagem_discursiva').prop('checked', false)

                            if(result) {

                                tr = tr.detach()
                                modal.modal('hide')

                                tr.addClass('questoes_externas_disc')
                                tr.removeClass('questoes_simulado_disc')

                                btn_add_qst.show()
                                btn_remove_qst.hide()

                                btn_add_qst_modal.show()
                                btn_remove_qst_modal.hide()

                                btn_add_qst.removeClass('btn_hide_on_ready_disc')
                                btn_add_qst_modal.removeClass('btn_hide_on_ready_disc')

                                btn_remove_qst.addClass('btn_hide_on_ready_disc')
                                btn_remove_qst_modal.addClass('btn_hide_on_ready_disc')

                                data_table_empty.detach()
                                tabela_externa.append(tr)
                                
                                alert('Questão removida com sucesso!')
                            }

                            if($('.questoes_simulado_disc').length == 0) {
                                $('#tabela_simulado_disc').hide()
                                $('#questoes_disc_simulado_empty').show()
                            }

                            if($('.questoes_externas_disc').length > 0) {
                                $('#tabela_externa_disc').show()
                                $('#questoes_disc_externas_empty').hide()
                            }
                        }
                    });
                }
            });

            $('.excluir_qst_disc_async').click(function() {
                
                var isDel = confirm('Você tem certeza que deseja remover?')

                const id = this.id.split('_').pop()

                var modal = $('#modal_disc_'+id)
                var tr = $('#questao_discursiva_'+id)

                if(isDel) {

                    $.ajax({
                        url: '/removeQuestaoDiscursivaSimulado/Async/',
                        data: {
                            questao_id: id,
                            simulado_id: $('#simulado_id').val(),
                        },
                        success: function(result) {
                            $('#tipo_montagem_discursiva').prop('checked', true)

                            if(result) {
                                
                                tr.detach()
                                modal.modal('hide')

                                tr.removeClass('questoes_simulado_disc')

                                alert('Questão removida com sucesso!')
                            }

                            if($('.questoes_simulado_disc').length == 0) {
                                $('#tabela_simulado_disc').hide()
                                $('#questoes_disc_simulado_empty').show()
                            }

                            if($('.questoes_externas_disc').length > 0) {
                                $('#tabela_externa_disc').show()
                                $('#questoes_disc_externas_empty').hide()
                            }
                        }
                    });
                }
            });

            // ---------------------------------------------------------------------------------------

        });

    </script>

@stop
