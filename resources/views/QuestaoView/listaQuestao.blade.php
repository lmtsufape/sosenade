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
	 		<img style="width: 30px; height: 30px" src="{{ asset('search3.png')}}" alt=""/>
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
										@if($disciplina->questaos->count())
											<a class="dropdown-item {{Request::is('listar/questoes/disciplina/'.$disciplina->id) ? 'font-weight-bold' : ''}}" href="{{route('list_qst_disciplina', ['id'=>$disciplina->id])}}"> {{$disciplina->nome}} </a>
										@endif
									@endforeach
								</div>
							</div>
						</th>
						<th style="width: 15%">Opções</th>
					</tr>
				</thead>
				<tbody>
					@foreach($questaos as $questao)
						<tr>
							<td style="overflow: hidden; word-wrap: break-word; max-width: 38rem;">
								{{ str_limit(preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao->enunciado)), $limit = 180, $end = '...') }}
							</td>
							<td>{{$questao->dificuldade}}</td>
							<td id="disciplina">{{$questao->nome}}</td>
							<td>
								<a class="icons btn btn-info" data-toggle="modal" href="#modal_{{$questao->qtsid}}"><i class="fa fa-info-circle"></i></a>
								<a href="{{route('edit_qst', ['id'=>$questao->qtsid])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
								<a onclick="return confirm('Você tem certeza que deseja excluir?')" href="{{route('delete_qst', ['id'=>$questao->qtsid])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>

						<!-- Modal -->
						<div class="modal fade" id="modal_{{$questao->qtsid}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTitle_{{$questao->qtsid}}">{{$questao->nome}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Voltar">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" style="overflow: hidden; word-wrap: break-word;">
										{{ preg_replace('/<[^>]*>|[&;]|nbsp/', '', preg_replace(array('/nbsp/','/<(.*?)>/'), ' ', $questao->enunciado)) }}
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-eye"></i> Ver mais</button>
										<a href="{{route('edit_qst', ['id'=>$questao->qtsid])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
									</div>
								</div>
							</div>
						</div>
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