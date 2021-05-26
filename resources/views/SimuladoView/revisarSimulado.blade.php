@extends('layouts.app')
@section('titulo','Simulado')
@section('content')
	
	<div class="shadow p-3 bg-white rounded">
		
		<div class="col-md-12 text-center">
            <h2> Simulado Concluído! </h2><br>
		</div>
		
		<div>
			<hr>
		</div>

		<div class="form-group col-md-12 text-center">
			<br><a class="btn btn-primary mr-3" href="{{route('list_edit_answ', ['id'=>$simulado_id])}}"> Editar Respostas </a>
			<a onclick="return confirm('Após entregar o simulado nenhuma alteração poderá ser feita! Deseja continuar?')" href="{{route('result_simulado', ['id'=>$simulado_id])}}" class="btn btn-success" title="Entregar Simulado"> Entregar Simulado </a>
		</div>

	</div>
@stop