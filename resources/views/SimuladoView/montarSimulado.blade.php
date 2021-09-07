@extends('layouts.app')
@section('titulo','Montar Simulado')
@section('content')
    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="titleHeader row">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px">Montar Simulado - {{$titulo_simulado}}</h1>
                <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px">
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
                    @include('SimuladoView.partialsMontarSimulado.questoesObjetivas')
                </div>
                <!--  -->

                <!-- Montar Simulado QSTs Dicursivas -->
                <div class="tab-pane fade show active hide_simulado_discursiva" id="montar-simulado-questoes-discursivas" role="tabpanel" aria-labelledby="montar-simulado-questoes-discursivas-tab">
                    @include('SimuladoView.partialsMontarSimulado.questoesDiscursivas')
                </div>
                <!--  -->

            </div>
        </div>

    <style>
        label{
            font-weight: bold;
        }
    </style>

    @include('SimuladoView.partialsMontarSimulado.montarSimuladoAjax')
@stop
