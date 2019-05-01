@extends('layouts.app')
@section('titulo','Questões Cadastradas')
@section('content')
    
    <div class="shadow p-4 bg-white rounded container-fluid" style="overflow-x: auto;">
    
		<h1 class="text-center">Questões Cadastradas</h1>
		<h2 class="text-center">
			@if (Auth::guard('aluno')->user())
				{{Auth::guard('aluno')->user()->curso->curso_nome}}
			@elseif (Auth::user())
				{{Auth::user()->curso->curso_nome}}
			@endif
		</h2><br>

		<div class="form-group justify-content-center row">
	 		<img style="width: 3%; height: 3%" src="{{ asset('search3.png')}}" alt=""/>
	  		<input type="text" id="termo_busca" placeholder="Buscar questão..." onkeyup="pesquisa()" />
		</div>
		
		@if(!$questaos->isEmpty())
			<table class="table table-hover" id="tabela_dados">
		 		<thead>
					<tr class="header">
						<th>Enunciado</th>
						<th>Nível</th>
						<th>
							<div class="dropdown show">
								Disciplinas
								<a style="color: inherit;" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<a class="dropdown-item {{Request::is('listar/questao') ? 'font-weight-bold' : ''}}" href="{{route('list_qst')}}">
										Todas
									</a>
									@foreach($disciplinas as $disciplina)
										<a class="dropdown-item {{Request::is('listar/questoes/disciplina/'.$disciplina->id) ? 'font-weight-bold' : ''}}" href="{{route('list_qst_disciplina', ['id'=>$disciplina->id])}}"> {{$disciplina->nome}} </a>
									@endforeach
								</div>
							</div>
						</th>
						<th style="width: 10%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach($questaos as $questao)
						<tr>
							<td>
								<span class="d-inline-block text-truncate" style="max-width: 450px;">
									{{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace('/nbsp|<br>/', ' ', $questao->enunciado)), $limit = 50, $end = '...') }}
								</span>
							</td>
							<td>{{$questao->dificuldade}}</td>
							<td id="disciplina">{{$questao->nome}}</td>
							<td class="btn-group">
								<a href="{{route('edit_qst', ['id'=>$questao->qtsid])}}" class="btn btn-sm btn-primary">Editar</a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_qst', ['id'=>$questao->qtsid])}}" class="btn btn-sm btn-danger">Remover</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center alert alert-light">Não existem questões correspondentes até o momento.</p>
		@endif

		<hr class="star-light">
		
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
		        td = tr[i].getElementsByTagName("td")[0];
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