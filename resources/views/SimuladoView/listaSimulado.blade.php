@extends('layouts.app')
@section('titulo','Simulados Cadastrado')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px">Simulados Cadastrados</h1>
                <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a> >
                    Simulados Cadastrados
                </p>
            </div>

            <div class="col-sm" style="margin-top: 30px; margin-right: 20px">
                <a class="btn btn-primary" href="{{route('new_simulado')}}" style="float: right;"> Cadastrar
                    Simulado</a><br>
            </div>
        </div>

        @if(!$simulados->isEmpty())
            <table class="table table-hover" id="tabela_dados" style="border-style: groove; border-color: #6cb2eb">
                <thead>
                <tr class="header" style="background: #1B2E4F; color: white">
                    <th>Descrição (Nº de Questôes)</th>
                    <th>Criado por</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" style="width: 15%">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($simulados as $simulado)
                    <tr>
                        <td>
                            {{$simulado->descricao_simulado}}
                            @if($simulado->questaos_count == 0)
                                <span class="badge badge-danger badge-pill">
										0
									</span>
                            @else
                                <span class="badge badge-primary badge-pill">
										{{$simulado->questaos_count}}
									</span>
                            @endif
                        </td>
                        <td>{{$simulado->nome}}</td>
                        <td class="text-center">
                            @if($simulado->data_inicio_simulado == null)
                                <span>
										Não agendado
									</span>
                            @elseif($simulado->data_fim_simulado->isPast())
                                <span class="text-danger">
										Expirado <br> {{$simulado->data_fim_simulado->format('d/m H:i')}}
									</span>
                            @elseif(\Carbon\Carbon::parse($simulado->data_inicio_simulado)->lessThan(\Carbon\Carbon::now()) && \Carbon\Carbon::now()->lessThan(\Carbon\Carbon::parse($simulado->data_fim_simulado)))
                                <span style="color: #0056b3">
										Ocorrendo <br> ({{$simulado->data_inicio_simulado->format('d/m H:i')}} - {{$simulado->data_fim_simulado->format('d/m H:i')}})
									</span>
                            @else
                                <span class="text-success">
										Agendado<br> ({{$simulado->data_inicio_simulado->format('d/m H:i')}} - {{$simulado->data_fim_simulado->format('d/m H:i')}})
									</span>
                            @endif
                        </td>
                        <td>
                            @if($simulado->data_inicio_simulado != null && $simulado->data_fim_simulado != null && \Carbon\Carbon::parse($simulado->data_inicio_simulado)->lessThan(\Carbon\Carbon::now()) && \Carbon\Carbon::now()->lessThan(\Carbon\Carbon::parse($simulado->data_fim_simulado)))
                                <a class="btn btn-secondary"
                                   data-placement="bottom" rel="tooltip" title="Montar" onclick="simuladoOcorrendo()"><i
                                        class="fa fa-gear"></i></a>
                                <a class="btn btn-primary"
                                   data-placement="bottom" rel="tooltip" title="Editar"><i class="fa fa-pencil" onclick="simuladoOcorrendo()"></i></a>
                                <a class="btn btn-danger"
                                   data-placement="bottom" rel="tooltip" title="Excluir"><i class="fa fa-trash" onclick="simuladoOcorrendo()"></i></a>
                            @else
                                <a href="{{route('set_simulado', ['id'=>$simulado->sim_id])}}" class="btn btn-secondary"
                                   data-placement="bottom" rel="tooltip" title="Montar" disabled="disabled"><i
                                        class="fa fa-gear"></i></a>
                                <a href="{{route('edit_simulado', ['id'=>$simulado->sim_id])}}" class="btn btn-primary"
                                   data-placement="bottom" rel="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
                                <a onclick="return confirm('Você tem certeza que deseja excluir?')"
                                   href="{{route('delete_simulado', ['id'=>$simulado->sim_id])}}" class="btn btn-danger"
                                   data-placement="bottom" rel="tooltip" title="Excluir"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center alert alert-light">Não existem simulados cadastrados até o momento.</p>
        @endif

        <hr>
        <p>Legenda:</p>
        <a class="btn btn-secondary"
           data-placement="bottom" rel="tooltip" title="Montar" style="color: white"><i class="fa fa-gear"></i></a>
        Montar Simulado
        <a class="btn btn-primary"
           data-placement="bottom" rel="tooltip" title="Editar" style="color: white; margin-left: 5px"><i
                class="fa fa-pencil"></i></a>
        Editar Simulado
        <a class="btn btn-danger"
           data-placement="bottom" rel="tooltip" title="Excluir" style="color: white; margin-left: 5px"><i
                class="fa fa-trash"></i></a>
        Deletar Simulado

    </div>

    <!-- Ativa todos os tooltips da pagina -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabela_dados').DataTable({
                "order": [
                    [0, "asc"]
                ],
                "columnDefs": [
                    {"orderable": false, "targets": [1, 2, 3]}
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            });
        });
        $('[rel="tooltip"]').tooltip();
    </script>

    <script>
        function simuladoOcorrendo()
        {
            alert("Simulado em andamento, não é possivel alterar um simulado enquanto ele ocorre.");
        }
    </script>

@stop
