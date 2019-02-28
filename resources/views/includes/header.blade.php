<nav class="navbar navbar-expand-lg navbar-light bg-light" style="color: #1a75ff">
	<a class="navbar-brand" href="{{route('home')}}">Inicio</a>
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
						Disciplina
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_disciplina')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_disciplina')}}">Listar</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Aluno
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_aluno')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_aluno')}}">Listar</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Professor
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_professor')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_professor')}}">Listar</a>
					</div>
				</li>
				
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Simulado
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_simulado')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_simulado')}}">Listar</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Questao
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_qst')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_qst')}}">Listar</a>
					</div>
				</li>
			@endcan

			@can('view_professor', Auth::user())
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Questao
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_qst')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_qst')}}">Listar</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Simulado Questao
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{route('new_simulado')}}">Cadastrar</a>
						<a class="dropdown-item" href="{{route('list_simulado')}}">listar</a>
					</div>
				</li>
			@endcan
		</ul>
	</div>

	<li class="nav-item dropdown" style="list-style-type: none">
		<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				{{ Auth::user()->name }} <span class="caret"></span>
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