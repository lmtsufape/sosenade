<div class="list-group list-group-flush">
    <br>

        <form id="form_qst_objetivas" action="{{route('add_qst_simulado')}}" method="get">

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
                                <h5 id="select_qst_objetivas" class="card-title">Adicionar Questões</h5>
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
                                    <input type="submit" value="Adicionar" id="btn_get_questoes_objetivas" name="nome" class="btn btn-success"/>
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
