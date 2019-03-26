<nav class="navbar navbar-expand-lg navbar-light bg-light" style="color: #1a75ff">
	<a class="navbar-brand" href="{{(Auth::guard('aluno')->user() == null) ? route('welcome') : route('welcome_aluno')}}">Início</a>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			
			@can('create', Auth::user()) 
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Cursos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_curso')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_curso')}}">Listar</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Usuários
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_usuario')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_usuario')}}">Listar</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Ciclos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_ciclo')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_ciclo')}}">Listar</a>
					</div>
				</li>
			@endcan

			@can('view_coordenador', Auth::user())
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Disciplinas
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_disciplina')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_disciplina')}}">Listar</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Alunos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_aluno')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_aluno')}}">Listar</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Professores
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_professor')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_professor')}}">Listar</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Questões
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_qst')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_qst')}}">Listar</a>
						<a class="dropdown-item" href="{{route('qst_por_disciplina')}}">Relatório de Questões</a>
					</div>
				</li>
				
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Simulados
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_simulado')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_simulado')}}">Listar</a>
					</div>
				</li>

			@endcan

			@can('view_professor', Auth::user())
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Questões
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_qst')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_qst')}}">Listar</a>
					</div>
				</li>
			@endcan

			@if(Auth::guard('aluno')->check())
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Simulados
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('list_simulado_aluno')}}">Lista de Simulados</a>		  
					</div>
				</li>
			@endif
		</ul>
	</div>

	<li class="nav-item dropdown" style="list-style-type: none">
		<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="caret">
				@if (Auth::guard('aluno')->user())
					{{Auth::guard('aluno')->user()->nome}} (Aluno) - {{Auth::guard('aluno')->user()->curso->curso_nome}}
				@elseif (Auth::user())
					{{Auth::user()->nome}} ({{Auth::user()->tipousuario->tipo}}) - {{Auth::user()->curso->curso_nome}}
				@endif
			</span>
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="{{ route('logout') }}"
				 onclick="event.preventDefault();
				 document.getElementById('logout-form').submit();"
				 >
					{{ __('Logout') }}
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
			</form>
		</div>
	</li>
</nav>