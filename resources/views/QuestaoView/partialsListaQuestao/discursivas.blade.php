@if(!$questoes_discursivas->isEmpty())
<table class="table table-hover" id="tabela_dados_" style="border-style: groove; border-color: #6cb2eb">
    <thead>
        <tr class="header" style="background: #1B2E4F; color: white">
            <th>Enunciado</th>
            <th>Nível</th>
            <th>Disciplinas</th>
            <th style="width: 15%">Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($questoes_discursivas as $questao_discursiva)
            <tr>
                <td class="align-middle" style="overflow: hidden; word-wrap: break-word; max-width: 38rem;" href="#modal_{{$questao_discursiva->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip">
                    {{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao_discursiva->enunciado)), $limit = 240, $end = '...') }}
                </td>
                <td class="align-middle" href="#modal_{{$questao_discursiva->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip">{{$questao_discursiva->dificuldade}}</td>
                <td class="align-middle" href="#modal_{{$questao_discursiva->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip" id="disciplina">{{$questao_discursiva->nome}}</td>

                <td class="align-middle">
                    <a class="icons btn btn-info" href="#modal_{{$questao_discursiva->qstid}}" data-toggle="modal" data-placement="bottom" rel="tooltip" title="Visualizar"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-primary" href="{{route('edit_qst_disc', ['id'=>$questao_discursiva->qstid])}}" data-placement="bottom" rel="tooltip" title="Editar"><i class="fa fa-pencil"></i></a> 
                    <a class="btn btn-danger" href="{{route('edit_qst_disc', ['id'=>$questao_discursiva->qstid])}}" data-placement="bottom" rel="tooltip" title="Excluir" onclick="return confirm('Você tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modal_{{$questao_discursiva->qstid}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitle_{{$questao_discursiva->qstid}}">{{$questao_discursiva->disciplina->nome}} - {{$questao_discursiva->dificuldade}}</h5>
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
                                <div class="modal-footer">
                                    <a href="{{route('edit_qst_disc', ['id'=>$questao_discursiva->qstid])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a onclick="return confirm('Você tem certeza que deseja remover?')" href="{{route('delete_qst_disc', ['id'=>$questao_discursiva->qstid])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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