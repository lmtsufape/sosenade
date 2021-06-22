@extends('layouts.app')
@section('titulo','Respostas discursivas')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
            style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Resposta discursiva</h1>
                <p style="color: #606f7b; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a>
                    <a href="{{route('listar_simulados_questoes_discursivas')}}" style="color: inherit;">> Simulados com respostas discursivas</a>
                    <a href="{{route('ver_respostas_discursivas_simulado', $simulado_id)}}" style="color: inherit;">> Respostas discursivas</a>
                    > Resposta discursiva
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
        @else
            @foreach($errors->all() as $erro)
			    <div class="alert alert-danger">
				    {{ $erro }}
			    </div>
            @endforeach
		@endif

        <div class="list-group list-group-flush">
            <div class="tab-pane fade show active" id="avaliar_questao_discursiva" role="tabpanel" aria-labelledby="avaliar-questao-discursiva">
                <div class="list-group list-group-flush">
                    <br>
                    <form action="{{route('salvar_avaliacao_resposta_discursiva')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="resposta_discursiva_id" value="{{$resposta->id}}">

                        @if($resposta->nota)
                            <input type="hidden" name="nota_id" value="{{$resposta->nota->id}}">
                        @endif


                        <div class="form-group row justify-content-center">
                            <div class="form-group col-md-2"
                                style="background: #24509D; color: white; border-radius: 10px; padding: 5px">
                                <h1>1º</h1>
                                Leia o enunciado
                            </div>
                            <div class="form-group col-md-9">
                                <div class="card my-3">
                                    <div class="card-header" style="background: #1B2E4F; color:white">
                                        <h5 class="card-title">Enunciado</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{$resposta->questao_discursiva->enunciado}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="form-group row justify-content-center">
                            <div class="form-group col-md-2"
                                style="background: #24509D; color: white; border-radius: 10px; padding: 5px">
                                <h1>2º</h1>
                                Leia a resposta do aluno
                            </div>
                            <div class="form-group col-md-9">
                                <div class="card my-3">
                                    <div class="card-header" style="background: #1B2E4F; color:white">
                                        <h5 class="card-title">Resposta</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{$resposta->resposta_discursiva}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="form-group row justify-content-center">
                            <div class="form-group col-md-2"
                                style="background: #24509D; color: white; border-radius: 10px; padding: 5px">
                                <h1>3º</h1>
                                Dê uma nota à resposta.
                            </div>
                            <div class="form-group col-md-9">
                                <div class="card my-3">
                                    <div class="card-header" style="background: #1B2E4F; color:white">
                                        <h5 class="card-title">Nota</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="number" step="0.01" name="nota" min="0" value="{{old('nota', ($resposta->nota->nota ?? ''))}}">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="form-group row justify-content-center">
                            <div class="form-group col-md-2"
                                style="background: #24509D; color: white; border-radius: 10px; padding: 5px">
                                <h1>4º</h1>
                                Comente acerca de sua avaliação.
                            </div>
                            <div class="form-group col-md-9">
                                <div class="card my-3">
                                    <div class="card-header" style="background: #1B2E4F; color:white">
                                        <h5 class="card-title">Comentário</h5>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control summernote" name="comentario" id="comentario">{{old('nota', ($resposta->nota->comentario ?? ''))}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <hr style="width: 95%">
                        <div class="row" style="margin-left: 85%">
                            <button type="submit" class="btn btn-primary center-block">Salvar Avaliação</button>
                        </div>
                    </form>
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
