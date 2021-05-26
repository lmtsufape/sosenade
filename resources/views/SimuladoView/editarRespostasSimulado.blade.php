@extends('layouts.app')
@section('titulo','Questões Respondidas')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Questões Respondidas</h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px"><a href="{{route('home')}}" style="color: inherit;">Início</a>
                    > Questões Respondidas</p>
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

        @if(!$questaos->isEmpty())
            <table class="table table-hover" id="tabela_dados" style="border-style: groove; border-color: #6cb2eb">
                <thead>
                <tr class="header" style="background: #1B2E4F; color: white">
                    <th style="width: 5%;" scope="row">#</th>
                    <th style="" scope="col">Enunciado</th>
                    <th style="width: 10%;" scope="col">Nível</th>
                    <th style="width: 15%;" scope="col">
                        <div class="dropdown show">
                            Disciplina
                        </div>
                    </th>
                    <th style="width: 15%; text-align: center;">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questaos as $questao)
                    <tr> 
                        <th scope="row"> {{($loop->index + 1)}} </th>
                        <td class="align-middle" style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
                            {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao->enunciado)), $limit = 140, $end = '...') }}
                        </td>
                        <td class="align-middle">{{$questao->dificuldade}}</td>
                        <td class="align-middle" id="disciplina">{{$disciplina::find($questao->disciplina_id)->nome}}</td>
                        
                        <td class="align-middle">
                            <div style="text-align: center;">
                                <a class="icons btn btn-info" href="#modal_{{$questao->id}}" data-toggle="modal"
                                data-placement="bottom" rel="tooltip" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary" href="{{route('edit_answ', ['id'=>$resposta_questao->findResposta($respostas, $questao->id)->id])}}"
                                data-placement="bottom" rel="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_{{$questao->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="modalTitle_{{$questao->id}}">{{$questao->disciplina->nome}}
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
                                                            class="list-group-item {{ $resposta_questao->findResposta($respostas, $questao->id)->alternativa_questao == '0' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_a'] !!}</span>
                                                        <span
                                                            class="list-group-item {{ $resposta_questao->findResposta($respostas, $questao->id)->alternativa_questao == '1' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_b'] !!}</span>
                                                        <span
                                                            class="list-group-item {{ $resposta_questao->findResposta($respostas, $questao->id)->alternativa_questao == '2' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_c'] !!}</span>
                                                        <span
                                                            class="list-group-item {{ $resposta_questao->findResposta($respostas, $questao->id)->alternativa_questao == '3' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_d'] !!}</span>
                                                        <span
                                                            class="list-group-item {{ $resposta_questao->findResposta($respostas, $questao->id)->alternativa_questao == '4' ? 'list-group-item-success' : '' }}">{!! $questao->toArray()['alternativa_e'] !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('edit_answ', ['id'=>$resposta_questao->findResposta($respostas, $questao->id)->id])}}"
                                               class="btn btn-primary"><i class="fa fa-pencil"></i></a>
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
            <p class="text-center alert alert-light">Não existem questões no simulado.</p>
        @endif
        <hr>

        <div class="form-group col-md-12 text-center">
            <a onclick="return confirm('Após entregar o simulado nenhuma alteração poderá ser feita! Deseja continuar?')" href="{{route('result_simulado',['id'=>$simulado->id])}}" class="btn btn-success" title="Entregar Simulado"> Entregar Simulado </a>
		</div>

        <p>Legenda:</p>
        <a class="icons btn btn-info"
           data-placement="bottom" rel="tooltip" title="Visualizar" style="color: white"><i class="fa fa-eye"></i></a>
        Mostrar Questão
        <a class="btn btn-primary"
           data-placement="bottom" rel="tooltip" title="Editar" style="color: white; margin-left: 5px"><i
                class="fa fa-pencil"></i></a>
        Editar Questão

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
