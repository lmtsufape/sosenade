@extends('layouts.app')
@section('titulo','Importar Questão')
@section('content')

    <style>

        .toggle-check-input {
            width: 1px;
            height: 1px;
            position: absolute;
        }

        .toggle-check-text {
            display: inline-block;
            position: relative;
            text-transform: uppercase;
            background: #CCC;
            padding: 0.25em 0.5em 0.25em 2em;
            border-radius: 1em;
            min-width: 2em;
            color: #FFF;
            cursor: pointer;
            transition: background-color 0.15s;
        }

        .toggle-check-text:after {
            content: ' ';
            display: block;
            background: #FFF;
            width: 1.1em;
            height: 1.1em;
            border-radius: 1em;
            position: absolute;
            left: 0.3em;
            top: 0.25em;
            transition: left 0.15s, margin-left 0.15s;
        }

        .toggle-check-text:before {
            content: 'Nenhum';
        }

        .toggle-check-input:checked ~ .toggle-check-text {
            background: #2196F3;
            padding-left: 0.5em;
            padding-right: 2em;
        }

        .toggle-check-input:checked ~ .toggle-check-text:before {
            content: 'Todos';
        }

        .toggle-check-input:checked ~ .toggle-check-text:after {
            left: 100%;
            margin-left: -1.4em;
        }
    </style>
    <style>

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
            </button>{{ Session::get('message', '') }}
        </div>
    @elseif(Session::has('fail'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
            </button> {{ Session::get('message', '') }}
        </div>
    @endif

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Importar Questões </h1>
                <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a> >
                    Importar Questões
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="background: #1B2E4F; color: white">
                <h5 class="card-title">Listar Questões Por Curso</h5>
            </div>
            <form class="card-body" action="{{route('listar_import_qst_disc')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="d-flex w-100 justify-content-center">
                    <div class="col-md-4 text-center">
                        <label for="curso_id">Cursos:</label>
                        <select id='curso_id' name="curso_id"
                                class="form-control{{ $errors->has('curso_id') ? ' is-invalid' : '' }}" required
                                autofocus>
                            @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}" {{old('curso') == $curso->id ? 'selected' : '' }}>
                                    {{$curso->curso_nome}} - {{$curso->unidade->instituicao->nome}} - {{$curso->unidade->nome}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 text-center">
                        <label for="disciplina_id">Disciplinas:</label>
                        <select id='disciplina_id' name="disciplina_id"
                                class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}" required
                                autofocus>
                            @foreach ($list_cursos_id as $curso_id)
                                <option rel="{{$curso_id}}" value="all" selected> Tudo </option>
                            @endforeach
                            @foreach ($disciplinas as $disciplina)
                                <option rel="{{$disciplina->curso->id}}" value="{{$disciplina->id}}">
                                    {{$disciplina->nome}}
                                </option>
                            @endforeach
                        </select>
                        <small id="message_small" class="text-muted" hidden>Nenhuma disciplina disponível neste
                            curso.</small>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4 mb-2">
                    <input id="lista_btn" type="submit" value="Listar" name="btn_listar" class="btn btn-success"
                           disabled/>
                </div>
            </form>
            <div class="card-footer">
                <small class="text-muted">Selecione o curso e a disciplina, conteúdo ou área da questão e clique em Listar para
                    ver as questões disponíveis para importação.</small>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header" style="background: #1B2E4F; color: white">
                <h5 class="card-title">Questões
                    Disponíveis {{($questoes_discursivas->count() == 0) ? '' : ' - '.$questoes_discursivas[0]->disciplina->nome}}</h5>
            </div>
            <div class="card-body">
                <form id="qst_form" action="{{route('import_qst_disc_post')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    @if($questoes_discursivas->count())
                        <table id="tabela_dados" class="table">
                            <thead>
                            <tr>
                                <th style="width: 5%">Importar</th>
                                <th>Enunciado</th>
                                <th>Nível</th>
                                <th style="width: 7%">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="align-middle">
                                    <label class="toggle-check">
                                        <input class="toggle-check-input checkbox" id="select-all" type="checkbox">
                                        <span class="toggle-check-text"></span>
                                    </label>

                                </td>
                                <td class="align-middle"
                                    style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
                                </td>
                                <td class="align-middle"></td>
                                <td class="text-center align-middle">
                                </td>

                            </tr>
                            @foreach($questoes_discursivas as $qst)
                                <tr>
                                    <td class="align-middle">
                                        <label class="switch">
                                            <input class="checkbox" name="qsts[]" type="checkbox" value="{{$qst->id}}">
                                            <span class="slider round"></span>
                                        </label>

                                    </td>
                                    <td class="align-middle"
                                        style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
                                        {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $qst->enunciado)), $limit = 180, $end = '...') }}
                                    </td>
                                    <td class="align-middle">{{$qst->dificuldade}}</td>
                                    <td class="text-center align-middle">
                                        <a class="icons btn btn-info" data-toggle="modal" href="#modal_{{$qst->id}}"
                                           data-placement="bottom" rel="tooltip" title="Visualizar"><i
                                                class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center alert alert-light">Nenhuma questão para mostrar.</p>
                    @endif
                    @if($questoes_discursivas->count())
                        @foreach($questoes_discursivas as $qst)
                        <!-- Modal -->
                            <div class="modal fade" id="modal_{{$qst->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="modalTitle_{{$qst->id}}">{{$qst->disciplina->nome}}
                                                - {{$qst->dificuldade}}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Voltar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="overflow: hidden; word-wrap: break-word;">
                                            <div class="row">
                                                <div class="card-header w-100">
                                                    <span> {!! $qst->toArray()['enunciado'] !!} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Voltar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div {{($questoes_discursivas->count() == 0) ? 'hidden' : ''}}>
                        <hr class="my-4">
                        <div class="d-flex justify-content-center my-2">
                            <div class="col-md-4 text-center">
                                <label for="disciplina_dst_id">Importar para:</label>
                                <select id='disciplina_dst_id' name="disciplina_dst_id"
                                        class="form-control {{ $errors->has('disciplina_dst_id') ? ' is-invalid' : '' }}"
                                        required autofocus>
                                    @foreach ($disciplinas as $disciplina)
                                        <option rel="{{$disciplina->curso->id}}"
                                                value="{{$disciplina->id}}" {{old('disciplina') == $disciplina->id ? 'selected' : '' }}>
                                            {{$disciplina->nome}} - {{$disciplina->curso->curso_nome}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center">
                                <button id="btn_importar" type="submit" class="btn btn-success m-2" disabled>Importar
                                </button>
                                <a class="btn btn-secondary m-2" href="{{route('import_qst_disc')}}">Limpar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <small class="text-muted">Marque as questões, escolha a disciplina, conteúdo ou área do seu curso para onde deseja
                    importá-las e clique no botão Importar para finalizar. Para limpar a lista clique em Limpar.</small>
            </div>
        </div>
    </div>

    <script>
        //Funcionalidade de Selecionar Todos
        $('#select-all').click(function (event) {
            if (this.checked) {
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
    </script>

    <script type="text/javascript">
        // Reference: https://jsfiddle.net/fwv18zo1/
        // Estabelece o comportamento de dependência entre os dois select boxes
        var $select1 = $('#curso_id'),
            $select2 = $('#disciplina_id'),
            $select3 = $('#disciplina_dst_id'),
            $options = $select2.find('option');

        $select1.on('change', function () {
            $select2.html(
                $options.filter('[rel="' + this.value + '"]')
            );
            if ($options.filter('[rel="' + this.value + '"]').length == 0) {
                $select2.prop('disabled', 'disabled');
                if (this.value != 'null') {
                    $('#message_small').prop('hidden', false);
                }
                $('#lista_btn').prop('disabled', 'disabled');
                $select2.val('null');
            } else {
                $select2.prop('disabled', false);
                $('#message_small').prop('hidden', 'hidden');
                $('#lista_btn').prop('disabled', false);
            }
            ;
        }).trigger('change');

        $select3.html(
            $options.filter('[rel="' + {{Auth::user()->curso->id}} +'"]')
        );

        $(document).ready(function () {
            $('#tabela_dados').DataTable({
                "paging":   false,
                "order": [
                    [2, "asc"]
                ],
                "columnDefs": [
                    {"orderable": false, "targets": [0, 3]}
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            });

            $(function () {
                $('.checkbox').change(function () {
                    $('#btn_importar').prop('disabled', !$('.checkbox:checked').length);
                });
            });

        });

        $('[rel="tooltip"]').tooltip();
    </script>
@stop
