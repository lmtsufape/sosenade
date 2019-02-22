@extends('layouts.default')
@section('content')
    
	<h1>Montar Simulados</h1><br><br>
	<form action = "/cadastrarQuestao/simulado" method = "post">



	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

		<input type = "hidden" name="_token" value="{{csrf_token()}}">
  		<input type = "hidden" name="simulado_id" value="{{$simulado_id}}">
   		
   		<select name="disciplina_id" class="custom-select" required>
 			<option selected hidden value="">Selecione uma Disciplina</option>

 			@foreach($disciplinas as $disciplina);
 			
  			<option value="{{$disciplina->id}}">{{$disciplina->nome}}</option>
  			@endforeach
		</select>

		<select name="dificuldade" class="custom-select" required>

 			<option selected hidden value="">Selecione o Nível da Questão</option>  			
 			<option value="1">Fácil</option>

  			<option value="2">Médio</option>
  			<option value="3">Difícil</option>
		</select>


		 <div class="form-row ">
	    <div class="form-group col-md-6">
	      <label for="nome">Quantidade de Questões</label>
	      <input type="number" class="form-control"  name="numero" id="numero" placeholder="numero" max="30" required>
	   
	    </div>
	      
		<input type="submit" value="montar"/>

    
	<h1>Lista de Questões Cadastradas</h1>
	<table class="table">
 		<thead>
		
			<tr>
				<th>Numº Questao</th>
				<th>Enunciado</th>
				<th>Nivel Questão</th>
				<th>ID da Disciplina</th>
				<th>Funções</th>
			</tr>
		</thead>
		<tbody>
			@if($questaos)

			@foreach($questaos as $questaocerta)
			<tr>
				<td>{{$questaocerta->id}}</td>
				<td>{{  preg_replace('/<[^>]*>|[&;]/', '', $questaocerta->enunciado) }}</td>
				<td>
					@if($questaocerta->dificuldade  == 1)
						facil
					@elseif($questaocerta->dificuldade  == 2)
						médio
					@else
						difícil
					@endif

				</td>
				<td>{{$questaocerta->disciplina_id}}</td>
				<td> <a href='/remover/questaosimulado/{{$questaocerta->id}}'>Remover</a></td>
			</tr>
			@endforeach
			@else
			<td colspan="4 ">Não existe questões cadastradas</td>
						@endif


		</tbody>
	</table>
	


	</form>
@stop