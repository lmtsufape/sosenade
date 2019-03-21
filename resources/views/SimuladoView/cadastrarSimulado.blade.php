@extends('layouts.default')
@section('content')

	<form class="shadow p-3 mb-5 bg-white rounded" action= "{{route('add_simulado')}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		
		<h1 class="text-center"> Cadastrar Simulado </h1>
		<h2 class="text-center">{{$nome_curso}}</h2><br>	
    
		<div class="form-group justify-content-center row">
			<div class="col-md-6">
				<label for="descricao_simulado">Título</label>
				<input type="text" class="form-control{{ $errors->has('descricao_simulado') ? ' is-invalid' : '' }}"  name="descricao_simulado" id="descricao_simulado" placeholder="Escreva aqui o título do simulado" value="{{ old('descricao_simulado') }}" required autofocus>
				@if ($errors->has('descricao_simulado'))
					<span class = "invalid-feedback" role="alert">
						{{$errors->first('descricao_simulado')}}
					</span>
				@endif
			</div> 
		</div>
           
	<div class="input-append date form_datetime" data-date="2013-02-21T15:25:00Z">
    	<input size="16" type="text" value="" readonly>
    	<span class="add-on"><i class="icon-remove"></i></span>
    	<span class="add-on"><i class="icon-calendar"></i></span>
	</div>
 
		
          

		<div class="col-md-12 text-center">
			<br><button type="submit" name="cadastrar" class="btn btn-primary">Continuar</button><br><br>
		</div>
	</form>

<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "dd MM yyyy - hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: "2013-02-14 10:00",
        minuteStep: 10
    });
</script>            
@stop