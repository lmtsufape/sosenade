@extends('layouts.app')
@section('titulo','Simulado')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col-sm">
                <h1 style="margin-left: 15px; margin-top: 15px; margin-bottom: 25px">Simulado Concluido!</h1>

            </div>
        </div>


        <div class="form-group col-md-12 text-center">
            <br><a class="btn btn-primary mr-3" href="{{route('list_edit_answ', ['id'=>$simulado_id])}}"> Editar
                Respostas </a>
            <a onclick="return confirm('Após entregar o simulado nenhuma alteração poderá ser feita! Deseja continuar?')"
               href="{{route('result_simulado', ['id'=>$simulado_id])}}" class="btn btn-success"
               title="Entregar Simulado"> Entregar Simulado </a>
        </div>

    </div>
@stop
