@extends('layouts.app')
@section('titulo','Questões Cadastradas')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Questões Cadastradas</h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px"><a href="{{route('home')}}"
                                                                                  style="color: inherit;">Inicio</a> >
                    Questões Cadastradas</p>
            </div>

            <div class="col-sm" style="margin-top: 30px; margin-right: 20px">
                <a class="btn btn-primary" href="{{route('new_qst')}}" style="float: right;"> Criar questão</a><br>
            </div>
            {{-- <p><a href="">Inicio</a> > <a href="">Olá, fulano</a> > <a href=""></a>Meu Perfil</p> --}}
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

        @if(!$questaos->isEmpty())
            <table class="table table-hover" id="tabela_dados" style="border-style: groove; border-color: #6cb2eb">
                <thead>
                <tr class="header" style="background: #1B2E4F; color: white">
                    <th>Enunciado</th>
                    <th>Nível</th>
                    <th>
                        <div class="dropdown show">
                            Disciplinas
                            <a style="color: inherit;" class="dropdown-toggle nounderline" href="#" role="button"
                               id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @foreach($disciplinas as $disciplina)
                                    @if($disciplina->questaos->count())
                                        {!! Request::is('listar/questoes/disciplina/'.$disciplina->id) ? '('.$disciplina->nome.')' : '' !!}
                                    @endif
                                @endforeach
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item {{Request::is('listar/questao') ? 'font-weight-bold' : ''}}"
                                   href="{{route('list_qst')}}">
                                    Todas
                                </a>
                                @foreach($disciplinas as $disciplina)
                                    @if($disciplina->questaos->count())
                                        <a class="dropdown-item {{Request::is('listar/questoes/disciplina/'.$disciplina->id) ? 'font-weight-bold' : ''}}"
                                           href="{{route('list_qst_disciplina', ['id'=>$disciplina->id])}}"> {{$disciplina->nome}} </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </th>
                    <th style="width: 15%">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questaos as $questao)
                    <tr>
                        <td class="align-middle" style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
                            {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao->enunciado)), $limit = 80, $end = '...') }}
                        </td>
                        <td class="align-middle">{{$questao->dificuldade}}</td>
                        <td class="align-middle" id="disciplina">{{$questao->nome}}</td>
                        <td class="align-middle">
                            <a class="icons btn btn-info" href="#modal_{{$questao->qstid}}" data-toggle="modal"
                               data-placement="bottom" rel="tooltip" title="Visualizar"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-primary" href="{{route('edit_qst', ['id'=>$questao->qstid])}}"
                               data-placement="bottom" rel="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger" href="{{route('delete_qst', ['id'=>$questao->qstid])}}"
                               data-placement="bottom" rel="tooltip" title="Excluir"
                               onclick="return confirm('Você tem certeza que deseja excluir?')"><i
                                    class="fa fa-trash"></i></a>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_{{$questao->qstid}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="modalTitle_{{$questao->qstid}}">{{$questao->disciplina->nome}}
                                                - {{$questao->dificuldade}}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Voltar">
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
                                        <div class="modal-footer">
                                            <a href="{{route('edit_qst', ['id'=>$questao->qstid])}}"
                                               class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                            <a onclick="return confirm('Você tem certeza que deseja remover?')"
                                               href="{{route('remove_qst_simulado', 	['sim_qst_id'=>$questao->qstid])}}"
                                               class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center alert alert-light">Não existem questões correspondentes até o momento.</p>
        @endif
        <hr>

        <p>Legenda:</p>
        <a class="icons btn btn-info"
           data-placement="bottom" rel="tooltip" title="Visualizar" style="color: white"><i class="fa fa-eye"></i></a>
        Mostrar Questão
        <a class="btn btn-primary"
           data-placement="bottom" rel="tooltip" title="Editar" style="color: white; margin-left: 5px"><i class="fa fa-pencil"></i></a>
        Editar Questão
        <a class="btn btn-danger"
           data-placement="bottom" rel="tooltip" title="Excluir" style="color: white; margin-left: 5px"><i class="fa fa-trash"></i></a>
        Deletar Questão

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
            });
            $('[rel="tooltip"]').tooltip();
        </script>

        <style type="text/css">
            .nounderline {
                text-decoration: none !important
            }
        </style>

@stop
