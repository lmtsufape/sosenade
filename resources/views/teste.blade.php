@extends('AlunoBlade/alunoDefault')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="color: #1a75ff">
  <a class="navbar-brand" href="/">Inicio</a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
     
       
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Simulados
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href='/listaSimuladoAluno/simulado'>Lista de Simulados</a>
         
          
        </div>
      </li>      
      
    </ul>
  </div>

  <li class="nav-item dropdown" style="list-style-type: none">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        {{ Auth::guard('aluno')->user()->name}} <span class="caret"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="{{ route('logout') }}" 
         onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </div>
  </li>
</nav>
@endsection