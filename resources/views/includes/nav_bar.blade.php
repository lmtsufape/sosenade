<nav class="navbar navbar-light navbar-expand-lg" style="background-color: white; border-color: #d3e0e9;
box-shadow: 0px 4px 10px -5px rgba(0,0,0,0.64);" role="navigation">
    <div class="container">
        <a href="{{ (Auth::guard('aluno')->user()) ? route('home_aluno') : route('home') }}"
           style="max-height: 45%; max-width: 45%">
            <img src="{{asset('1.png')}}" style="width: 90px" class="img-fluid float-left">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
            <!-- <a class="nav-link" href="{{(Auth::guard('aluno')->user() == null) ? route('home') : route('home_aluno')}}">Início</a>
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

					<li class="nav-item">
						<a class="nav-link" href="{{route('geral_cursos')}}" role="button" aria-haspopup="true" aria-expanded="false">
							Visão Geral do Sistema
						</a>
					</li>
				@endcan -->

                <!-- View Acima Referente a antigo Admistrador do Sistema, Responsabilidade passada para Instituicao -->

                @if(Auth::guard('instituicao')->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Unidades
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('new_unidade') }}">Cadastrar</a>
                            <a class="dropdown-item" href="{{ route('list_unidade') }}">Listar</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            Ciclos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_ciclo')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_ciclo')}}">Listar</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cursos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_curso')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_curso')}}">Listar</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Usuários
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_usuario')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_usuario')}}">Listar</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('geral_cursos')}}" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            Visão Geral do Sistema
                        </a>
                    </li>
                @endif

                @can('view_coordenador', Auth::user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Alunos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_aluno')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_aluno')}}">Listar</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Professores
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_professor')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_professor')}}">Listar</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Disciplinas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_disciplina')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_disciplina')}}">Listar</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Questões
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_qst')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_qst')}}">Listar</a>
                            <a class="dropdown-item" href="{{route('import_qst')}}">Importar Questões</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Simulados
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_simulado')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_simulado')}}">Listar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('desempenho_alunos')}}">Desempenho por Aluno</a>
                            <a class="dropdown-item" href="{{route('relatorio_disciplinas')}}">Desempenho por
                                Disciplinas</a>
                            <a class="dropdown-item" href="{{route('qst_por_disciplina')}}">Desempenho por Questões</a>
                            <a class="dropdown-item" href="{{route('relatorio_simulados')}}">Desempenho por Simulado</a>
                        </div>
                    </li>
                @endcan

                @can('view_professor', Auth::user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Questões
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_qst')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_qst')}}">Questões cadastradas</a>
                        </div>
                    </li>
                @endcan


                @can('view_coordenadorGeral', Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('geral_cursosCG')}}" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            Visão Geral do Sistema
                        </a>
                    </li>
                @endcan

                @can('view_administrador_sistema', Auth::user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Instituições
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('new_instituicao')}}">Cadastrar</a>
                            <a class="dropdown-item" href="{{route('list_instituicao')}}">Listar</a>
                        </div>
                    </li>
                @endcan

                @if(Auth::guard('aluno')->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Simulados
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('list_simulado_aluno')}}">Lista de Simulados</a>
                        </div>
                    </li>
                @endif

                <li class="nav-item dropdown" style="list-style-type: none">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Olá, <b>
                            @if (Auth::guard('aluno')->user())
                                {{Auth::guard('aluno')->user()->nome}}
                                (Aluno) {{-- - {{Auth::guard('aluno')->user()->curso->curso_nome}} --}}
                            @elseif (Auth::guard('instituicao')->user())
                                {{Auth::guard('instituicao')->user()->nome}} (Instituição)
                            @elseif ((Auth::user()->tipousuario->id == 6))
                                {{Auth::user()->nome}}
                            @elseif ((Auth::user()->tipousuario->id == 5))
                                {{Auth::user()->nome}} {{--({{Auth::user()->tipousuario->tipo}}) - {{Auth::user()->curso->unidade->nome}} --}}
                            @elseif (Auth::user() && !(Auth::user()->tipousuario->id == 4))
                                {{Auth::user()->nome}} {{--({{Auth::user()->tipousuario->tipo}}) - {{Auth::user()->curso->curso_nome}} --}}

                            @else
                                {{Auth::user()->nome}}
                            @endif
                        </b>
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        @if(Auth::guard('aluno')->user())
                            <a class="dropdown-item" href="{{ route('edit_perfil_aluno') }}">
                                @elseif(Auth::guard('instituicao')->user())
                                    <a class="dropdown-item" href="{{ route('edit_perfil_instituicao') }}">
                                        @else
                                            <a class="dropdown-item"
                                               href="{{ route('edit_usuario', ['id' => Auth::user()->id]) }}">
                                                @endif

                                                Meu Perfil
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Sair') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
