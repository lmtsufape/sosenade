@extends('layouts.app')
@section('titulo','Editar Questão')
@section('content')

    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <div class="col" align="left">
                <h1 style="margin-left: 15px; margin-top: 15px"> Editar Questão </h1>
                <p style="color: #9fcdff; margin-left: 15px; margin-top: -5px">
                    <a href="{{route('home')}}" style="color: inherit;">Início</a> > <a href="{{route("list_qst")}}"
                                                                                        style="color: inherit;"> Listar
                        Questões</a> >
                    Editar Questão Discursiva
                </p>
            </div>
        </div>
        <form action="{{route('update_qst_disc')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$questao_discursiva->id}}">

            <div class="form-group row justify-content-center">
                <div class="form-group col-md-2"
                     style="background: #24509D; color: white; border-radius: 10px; padding: 5px">
                    <h1>1º</h1>
                    Selecione a disciplina/conteúdo abordado na questão e o nível de dificuldade da
                        mesma.
                </div>
                <div class="form-group col-md-9">
                    <div class="card">
                        <div class="card-header" style="background: #1B2E4F; color:white">
                            <h5 class="card-title">Classificação da Questão</h5>
                        </div>
                        <div class="card-body row justify-content-center">
                            <div class="col-md-4 text-center">
                                <label for="dificuldade">Disciplina</label>
                                <select name="disciplina_id"
                                        class="form-control{{ $errors->has('disciplina_id') ? ' is-invalid' : '' }}"
                                        required autofocus>
                                    <option selected hidden value="">Selecione a disciplina</option>
                                    @foreach ($disciplinas as $disciplina)
                                        @if($questao_discursiva->disciplina_id == $disciplina->id)
                                            <option value="{{$disciplina->id}}" selected>{{$disciplina->nome}} </option>
                                        @else
                                            <option value="{{$disciplina->id}}">{{$disciplina->nome}} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 text-center">
                                <label for="dificuldade">Dificuldade</label>
                                <select name="dificuldade"
                                        class="form-control{{ $errors->has('dificuldade') ? ' is-invalid' : '' }}"
                                        required autofocus>
                                    <option value="1" @if($questao_discursiva->dificuldade == "Fácil") selected @endif>Fácil
                                    </option>
                                    <option @if($questao_discursiva->dificuldade == "Médio") selected @endif value="2">Médio
                                    </option>
                                    <option value="3" @if($questao_discursiva->dificuldade == "Difícil") selected @endif>Difícil
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="form-group col-md-2"
                     style="background: #24509D; color: white; border-radius: 10px; padding: 5px">
                    <h1>2º</h1>
                    Digite o enunciado da questão no campo ao lado.<br><br>
                    Sugestão: <br><small>Altere o <b>'ANO'</b>, <b>'CURSO'</b>, <b>'NUMERO'</b> e <b>'ENUNCIADO' pelas informações da questão.</b></small><br><br>
                    Exemplo: <br><small>[ENADE 2014 - PEDAGOGIA - QUESTÃO 16] Questão de pedagogia.</small>
                </div>
                <div class="form-group col-md-9">
                    <div class="card my-3">
                        <div class="card-header" style="background: #1B2E4F; color:white">
                            <h5 class="card-title">Enunciado</h5>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control summernote" name="enunciado" id="enunciado">{{$questao_discursiva->enunciado}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <hr style="width: 95%">
            <div class="row" style="margin-left: 85%">
                <button type="submit" name="editar" class="btn btn-primary center-block">Salvar alterações</button>
            </div>
        </form>

        <script type="text/javascript">
            if (document.getElementById('alternativa_correta1').checked) {
                $('#img1').attr('src', "{{asset('images/logo_check_verde.png')}}")
            }
            $('#check1').click(function () {
                $('#img1').attr('src', "{{asset('images/logo_check_verde.png')}}")
                $('#img2').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img3').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img4').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img5').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            })
            if (document.getElementById('alternativa_correta2').checked) {
                $('#img2').attr('src', "{{asset('images/logo_check_verde.png')}}")
            }
            $('#check2').click(function () {
                $('#img2').attr('src', "{{asset('images/logo_check_verde.png')}}")
                $('#img1').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img3').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img4').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img5').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            })
            if (document.getElementById('alternativa_correta3').checked) {
                $('#img3').attr('src', "{{asset('images/logo_check_verde.png')}}")
            }
            $('#check3').click(function () {
                $('#img3').attr('src', "{{asset('images/logo_check_verde.png')}}")
                $('#img2').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img1').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img4').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img5').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            })
            if (document.getElementById('alternativa_correta4').checked) {
                $('#img4').attr('src', "{{asset('images/logo_check_verde.png')}}")
            }
            $('#check4').click(function () {
                $('#img4').attr('src', "{{asset('images/logo_check_verde.png')}}")
                $('#img2').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img3').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img1').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img5').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            })
            if (document.getElementById('alternativa_correta5').checked) {
                $('#img5').attr('src', "{{asset('images/logo_check_verde.png')}}")
            }
            $('#check5').click(function () {
                $('#img5').attr('src', "{{asset('images/logo_check_verde.png')}}")
                $('#img2').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img3').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img4').attr('src', "{{asset('images/logo_check_cinza.png')}}")
                $('#img1').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            })
        </script>

@stop
