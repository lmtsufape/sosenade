<div class="" style="background-color: white; width: 100%; color:black; margin-top:1.5rem;
padding-bottom: 20px; position:absolute; bottom:100; width:100%; ">
    <div class="container-fluid pb-0 mb-0 justify-content-center text-black ">
        <div class="row justify-content-center"
             style="padding: 10px;">
            <div class="col-sm-12" align="center">
                <div class="row justify-content-center" style="margin-top:15px;">
                    <div class="col-sm-12" style="font-family:arial; ">
                        <a href="/" style="text-decoration: none; color:black">Início</a>&nbsp;&nbsp;&nbsp;●&nbsp;&nbsp;
                        @guest
                        <a href="" style="text-decoration: none; color:black">Sobre</a>
                        @endguest
                        @auth
                            @if (Auth::user()->tipousuario_id == 3)
                                <div class="dropdown show" style="display: inline">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                                        Questões
                                    </a>
                                    &nbsp;&nbsp;● &nbsp;&nbsp;

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{route('new_qst')}}">Cadastrar</a>
                                        <a class="dropdown-item" href="{{route('list_qst')}}">Questões cadastradas</a>
                                    </div>
                                </div>
                                @endif
                                <div class="dropdown show" style="display: inline">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                                        Olá, <b>
                                        @if (Auth::guard('aluno')->user())
                                            {{Auth::guard('aluno')->user()->nome}} (Aluno) {{-- - {{Auth::guard('aluno')->user()->curso->curso_nome}} --}}
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

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{(Auth::guard('aluno')->user()) ? route('edit_perfil_aluno') : route('edit_usuario', ['id' => Auth::user()->id])}}">
                                            Meu Perfil
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                        @endauth

                        <hr style="width: 80%; border: 0; height: 1px; background: #333; background-image: linear-gradient(to right, #ccc, #333, #ccc);">
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-3" align="center">
                <div class="row justify-content-center" style="margin-top:1.2rem;">
                    <div class="col-sm-12" id="" style="font-weight:bold; font-family:arial;">
                        Desenvolvido por
                    </div>
                    <div style="margin:3px; margin-top:1.4rem;">
                        <a href="http://lmts.uag.ufrpe.br/" target="blank">
                            <img src="{{ asset('\images\logo_lmts_colorido.png') }}" style="height: 80px">
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-sm-5" align="center">
                <div class="row justify-content-center" style="margin-top:1.2rem;">
                    <div class="col-sm-12" id="" style="font-weight:bold; font-family:arial">
                        Parceria
                    </div>
                    <div style="margin: 3px;">
                        <a href="http://lmts.uag.ufrpe.br/" target="blank">
                            <img style="height: 100px" src="{{ asset('\images\logo_ufape_preto.png') }}">
                        </a>
                    </div>
                    <div style="margin: 3px; margin-top:1.8rem;">
                        <p style="display: inline">Universidade Federal do<br> Agreste de Pernambuco</p>
                    </div>
                    <div style="margin:20px 3px; ">
                        <a href="http://lmts.uag.ufrpe.br/" target="blank">
                            <img style="height: 65px" src="{{ asset('\images\logo_upe.png') }}">
                        </a>
                    </div>
                    <div style="margin:3px; margin-top:1.8rem;">
                        <p style="display: inline">Universidade de Pernambuco<br> Campus Garanhuns</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" align="center">
                <div class="row justify-content-center" style=" margin-top:1.2rem;">
                    <div class="col-sm-12" id="" style="font-weight:bold; font-family:arial;">
                        Redes sociais
                    </div>
                    <div style="margin:3px;  margin-top:2.4rem;">
                        <a href="" target="blank">
                            <img style="height: 30px" src="{{ asset('\images\logo_facebook_preto.png') }}">
                        </a>
                    </div>
                    <div style="margin:3px; margin-top:2.4rem;">
                        <a href="" target="blank">
                            <img style="height: 30px" src="{{ asset('\images\logo_instagram_preto.png') }}">
                        </a>
                    </div>
                    <div style="margin:3px; margin-top:2.4rem;">
                        <a href="" target="blank">
                            <img style="height: 30px" src="{{ asset('\images\logo_twitter_preto.png') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/simulado_script.js') }}"></script>
