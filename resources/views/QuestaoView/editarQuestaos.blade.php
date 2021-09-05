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
                    Editar Questão
                </p>
            </div>
        </div>
        <form action="{{route('update_qst')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$questao->id}}">

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
                                        @if($questao->disciplina_id == $disciplina->id)
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
                                    <option value="1" @if($questao->dificuldade == "Fácil") selected @endif>Fácil
                                    </option>
                                    <option @if($questao->dificuldade == "Médio") selected @endif value="2">Médio
                                    </option>
                                    <option value="3" @if($questao->dificuldade == "Difícil") selected @endif>Difícil
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
                            <textarea class="form-control summernote" name="enunciado" id="enunciado">{{$questao->enunciado}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="form-group col-md-2"
                     style="background: #24509D; color: white; border-radius: 10px; padding: 5px">
                    <h1>3º</h1>
                    Preencha os campos ao lado com as alternativas correspondentes e marque a letra da
                        alternativa correta
                </div>
                <div class="form-group col-md-9">
                    <div class="card">
                        <div class="card-header" style="background: #1B2E4F; color:white">
                            <h5 class="card-title">Alternativas</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td style="border: 0px; width: 1%; vertical-align:middle;">
                                        <div class="letraCirculo">A</div>
                                        <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="check1" class="btn" style="border-radius: 50%; padding: 0">
                                                <input type="radio" class="alt_buttons" name="alternativa_correta"
                                                       id="alternativa_correta1" value="0" @if($questao->alternativa_correta == 0) checked @endif required>
                                                <img id="img1" src="{{asset('images/logo_check_cinza.png')}}">
                                            </label>
                                        </div>
                                    </td>

                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa1"
                                                  id="alternativa1" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus>{{$questao->alternativa_a}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0px; width: 1%; vertical-align:middle;">
                                        <div class="letraCirculo">B</div>
                                        <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="check2" class="btn" style="border-radius: 50%; padding: 0px">
                                                <input type="radio" class="alt_buttons" name="alternativa_correta"
                                                       id="alternativa_correta2" value="1" @if($questao->alternativa_correta == 1) checked @endif required>
                                                <img id="img2" src="{{asset('images/logo_check_cinza.png')}}">
                                            </label>
                                        </div>
                                    </td>
                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa2"
                                                  id="alternativa2" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus>{{$questao->alternativa_b}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0px; width: 1%; vertical-align:middle;">
                                        <div class="letraCirculo">C</div>
                                        <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="check3" class="btn" style="border-radius: 50%; padding: 0px">
                                                <input type="radio" class="alt_buttons" name="alternativa_correta"
                                                       id="alternativa_correta3" value="2" @if($questao->alternativa_correta == 2) checked @endif required>
                                                <img id="img3" src="{{asset('images/logo_check_cinza.png')}}">

                                            </label>
                                        </div>
                                    </td>
                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa3"
                                                  id="alternativa3" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus>{{$questao->alternativa_c}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0px; width: 1%; vertical-align:middle;">
                                        <div class="letraCirculo">D</div>
                                        <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="check4" class="btn" style="border-radius: 50%; padding: 0px">
                                                <input type="radio" class="alt_buttons" name="alternativa_correta"
                                                       id="alternativa_correta4" value="3" @if($questao->alternativa_correta == 3) checked @endif required>
                                                <img id="img4" src="{{asset('images/logo_check_cinza.png')}}">

                                            </label>
                                        </div>
                                    </td>
                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa4"
                                                  id="alternativa4" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus>{{$questao->alternativa_d}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0px; width: 1%; vertical-align:middle;">
                                        <div class="letraCirculo">E</div>
                                        <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="check5" class="btn" style="border-radius: 50%; padding: 0px">
                                                <input type="radio" class="alt_buttons" name="alternativa_correta"
                                                       id="alternativa_correta5" value="4" @if($questao->alternativa_correta == 4) checked @endif required>
                                                <img id="img5" src="{{asset('images/logo_check_cinza.png')}}">

                                            </label>
                                        </div>
                                    </td>
                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa5"
                                                  id="alternativa5" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus>{{$questao->alternativa_e}}</textarea>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
