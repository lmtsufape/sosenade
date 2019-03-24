@extends('layouts.default')
@section('content')
    
    <div class="shadow p-4 mb-5 bg-white rounded container-fluid" style="overflow-x: auto;">
    
		<h1 class="text-center">Questões Cadastradas</h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

		<div class="form-group justify-content-center row">
	 		<img style="width: 3%" src="{{ asset('search3.png')}}" alt=""/>
	  		<input type="text" id="termo_busca" placeholder="Buscar disciplina" onkeyup="pesquisa()" />
		</div>

		<table class="table table-hover" id="tabela_dados">
	 		<thead>
				<tr class="header">
					<th>Enunciado</th>
					<th>Nível</th>
					<th>Disciplina</th>
					<th style="width: 10%">Opções</th>
				</tr>
			</thead>
			<tbody>
				@foreach($questaos as $questao)
					<tr>
						<td>{{preg_replace('/<[^>]*>|[&;]/', '', $questao->enunciado) }}</td>
						<td>{{$questao->dificuldade}}</td>
						<td id="disciplina">{{$questao->nome}}</td>
						<td class="btn-group">
							<a href="{{route('edit_qst', ['id'=>$questao->qtsid])}}" class="btn btn-sm btn-primary">Editar</a>
							<a href="{{route('delete_qst', ['id'=>$questao->qtsid])}}" class="btn btn-sm btn-danger">Remover</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="form-group float-right row mr-1">
			{{$questaos->links()}}
		</div>

		<div class="col-md-6 left">
			<a class="btn btn-primary" href="{{route('new_qst')}}"> Inserir nova questão </a><br>
		</div>

	</div>

	<script type="text/javascript">
		function pesquisa() {
		    var input, filter, table, tr, td, i;
		    input = document.getElementById("termo_busca");
		    filter = input.value.toUpperCase();
		    table = document.getElementById("tabela_dados");
		    tr = table.getElementsByTagName("tr");
		    for (i = 0; i < tr.length; i++) {
		        td = tr[i].getElementsByTagName("td")[2];
		         if (td) {
		          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		          tr[i].style.display = "";
		          } else {
		          tr[i].style.display = "none";
		       }
		     }       
		   }
		}
	</script>

@stop