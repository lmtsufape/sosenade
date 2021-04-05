@extends('layouts.app')
@section('titulo','Montar Simulado')
@section('content')
    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="titleHeader row">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px">Montar Simulado - {{$titulo_simulado}}</h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Inicio</a> >
                    <a href="{{route('list_simulado')}}" style="color: inherit;">Lista de Simulados</a> >
                    Montar Simulado - {{$titulo_simulado}}
                </p>
            </div>
        </div>
        <form action="{{route('add_qst_simulado')}}" method="post">


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
            <input type="hidden" name="simulado_id" value="{{$simulado_id}}">


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
                        <div class="card-body row justify-content-center">
                            <div class="col-md-4 text-center">
                                <label for="dificuldade">Disciplina</label>
                                <select name="disciplina_id"
                                        class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}"
                                        required autofocus>
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

                            <div class="col-md-4">
                                <label for="dificuldade">Dificuldade</label>
                                <select name="dificuldade"
                                        class="form-control{{ $errors->has('dificuldade') ? ' is-invalid' : '' }}"
                                        required autofocus>
                                    <option value="1" {{ old('dificuldade') == 1 ? 'selected' : '' }} >Fácil
                                    </option>
                                    <option value="2" {{ old('dificuldade') == 2 ? 'selected' : '' }} >Médio
                                    </option>
                                    <option value="3" {{ old('dificuldade') == 3 ? 'selected' : '' }} >Difícil
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="form-group col-md-2 headerLateral">
                    <h1 style="font-size: 70px">2º</h1>
                    <small>Selecione as questões para o seu simulado clicando no icone.</small>
                </div>
                <div class="form-group col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <table id="tabela_dados1" class="table tabelaBorder">
                                <thead>
                                <tr class="listaHeader">
                                    <th>Enunciado</th>
                                    <th>Nível</th>
                                    <th>Disciplina</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="form-group col-md-2 headerLateral">
                    <h1 style="font-size: 70px">3º</h1>
                    <small>Clique no botão Pronto para finalizar.</small>
                </div>
                <div class="form-group col-md-9">
                    <div class="card">
                        <div class="card-header listaHeader">
                            <h5 class="card-title">Questões Adicionadas</h5>
                        </div>
                        <div class="card-body">
                            @if($questaos->all())
                                <table id="tabela_dados2" class="table tabelaBorder">
                                    <thead>
                                    <tr class="listaHeader">
                                        <th>Enunciado</th>
                                        <th>Nível</th>
                                        <th>Disciplina</th>
                                        <th>Opções</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($questaos as $qst)
                                        <tr>
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
                                                <a onclick="return confirm('Você tem certeza que deseja remover?')"
                                                   href="{{route('remove_qst_simulado', ['sim_qst_id'=>$qst->id])}}"
                                                   class="btn btn-sm btn-danger" data-placement="bottom"
                                                   rel="tooltip"
                                                   title="Excluir"><i class="fa fa-trash"></i></a>
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
                                                                <a href="{{route('edit_qst', ['id'=>$qst->questao->id])}}"
                                                                   class="btn btn-primary"><i
                                                                        class="fa fa-pencil"></i></a>
                                                                <a onclick="return confirm('Você tem certeza que deseja remover?')"
                                                                   href="{{route('remove_qst_simulado', 	['sim_qst_id'=>$qst->id])}}"
                                                                   class="btn btn-danger"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    @else
                                        <p class="text-center alert alert-light">Não existem questões neste
                                            simulado.</p>
                                    @endif
                                </table>
                        </div>
                    </div>
                </div>
            </div>
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
            </div>

            <div class="text-center justify-content-center col-sm-3">
                <a class="btn btn-primary mr-3" href="{{route('list_simulado')}}"
                   style="margin-top: 30px; width: 200px"> Pronto </a>
            </div>
        </div>
    </div>


    <script type="text/javascript">
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
        });
        $('[rel="tooltip"]').tooltip();
    </script>

@stop
