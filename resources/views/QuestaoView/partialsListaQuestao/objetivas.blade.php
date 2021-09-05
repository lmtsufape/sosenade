@if(!$questaos->isEmpty())
<table class="table table-hover" id="tabela_dados" style="border-style: groove; border-color: #6cb2eb">
    <thead>
        <tr class="header" style="background: #1B2E4F; color: white">
            <th>Enunciado</th>
            <th>Nível</th>
            <th>Disciplinas</th>
            <th style="width: 15%">Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($questaos as $questao)
            <tr>
                <td class="align-middle" style="overflow: hidden; word-wrap: break-word; max-width: 38rem;" href="#modal_{{$questao->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip">
                    {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao->enunciado)), $limit = 240, $end = '...') }}
                </td>
                <td class="align-middle" href="#modal_{{$questao->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip">{{$questao->dificuldade}}</td>
                <td class="align-middle" href="#modal_{{$questao->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip" id="disciplina">{{$questao->nome}}</td>

                <td class="align-middle">
                    <a class="icons btn btn-info" href="#modal_{{$questao->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip" title="Visualizar"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-primary" href="{{route('edit_qst', ['id'=>$questao->qstid])}}" data-placement="bottom" rel="tooltip" title="Editar"><i class="fa fa-pencil"></i></a> 
                    <a class="btn btn-danger" href="{{route('delete_qst', ['id'=>$questao->qstid])}}" data-placement="bottom" rel="tooltip" title="Excluir" onclick="return confirm('Você tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>
                    
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
                                <div class="modal-footer">
                                    <a href="{{route('edit_qst', ['id'=>$questao->qstid])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a onclick="return confirm('Você tem certeza que deseja remover?')" href="{{route('delete_qst', ['id'=>$questao->qstid])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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