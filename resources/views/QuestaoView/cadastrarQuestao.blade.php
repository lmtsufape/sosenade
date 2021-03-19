@extends('layouts.app')
@section('titulo','Cadastrar Questão')
@section('content')
    <div class="shadow p-3 bg-white" style="border-radius: 10px">
        <div class="row"
             style="background: #1B2E4F; margin-top: -15px; margin-bottom:  30px; border-radius: 10px 10px 0 0; color: white">
            <h1 style="margin: 15px">Cadastrar nova questão</h1>
            {{-- <p><a href="">Inicio</a> > <a href="">Olá, fulano</a> > <a href=""></a>Meu Perfil</p> --}}
        </div>
        <form action="{{route('add_qst')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group row justify-content-center">
                <div class="form-group col-md-2"
                     style="background: #24509D; color: white; border-radius: 10px; padding: 5px">
                    <h1>1º</h1>
                    <small>Selecione a disciplina/conteúdo abrangido na questão e o nível de dificuldade da
                        mesma.</small>
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
                                        <option value="{{$disciplina->id}}">{{$disciplina->nome}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 text-center">
                                <label for="dificuldade">Dificuldade</label>
                                <select name="dificuldade"
                                        class="form-control{{ $errors->has('dificuldade') ? ' is-invalid' : '' }}"
                                        required autofocus>
                                    <option selected hidden value="">Selecione o nível</option>
                                    <option value="1">Fácil</option>
                                    <option value="2">Médio</option>
                                    <option value="3">Difícil</option>
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
                    <small>Digite o enunciado da questão no campo ao lado.</small>
                </div>
                <div class="form-group col-md-9">
                    <div class="card my-3">
                        <div class="card-header" style="background: #1B2E4F; color:white">
                            <h5 class="card-title">Enunciado</h5>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control summernote" name="enunciado" id="enunciado"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="form-group col-md-2"
                     style="background: #24509D; color: white; border-radius: 10px; padding: 5px">
                    <h1>3º</h1>
                    <small>Preencha os campos ao lado com as alternativas correspondentes e marque a letra da
                        alternativa correta</small>
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
                                                       id="alternativa_correta1" value="0" required>
                                                <img id="img1" src="{{asset('images/logo_check_cinza.png')}}">
                                            </label>
                                        </div>
                                    </td>

                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa1"
                                                  id="alternativa1" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0px; width: 1%; vertical-align:middle;">
                                        <div class="letraCirculo">B</div>
                                        <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="check2" class="btn" style="border-radius: 50%; padding: 0px">
                                                <input type="radio" class="alt_buttons" name="alternativa_correta"
                                                       id="alternativa_correta" value="1" required>
                                                <img id="img2" src="{{asset('images/logo_check_cinza.png')}}">
                                            </label>
                                        </div>
                                    </td>
                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa2"
                                                  id="alternativa2" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0px; width: 1%; vertical-align:middle;">
                                        <div class="letraCirculo">C</div>
                                        <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="check3" class="btn" style="border-radius: 50%; padding: 0px">
                                                <input type="radio" class="alt_buttons" name="alternativa_correta"
                                                       id="alternativa_correta" value="2" required>
                                                <img id="img3" src="{{asset('images/logo_check_cinza.png')}}">

                                            </label>
                                        </div>
                                    </td>
                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa3"
                                                  id="alternativa3" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0px; width: 1%; vertical-align:middle;">
                                        <div class="letraCirculo">D</div>
                                        <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="check4" class="btn" style="border-radius: 50%; padding: 0px">
                                                <input type="radio" class="alt_buttons" name="alternativa_correta"
                                                       id="alternativa_correta" value="3" required>
                                                <img id="img4" src="{{asset('images/logo_check_cinza.png')}}">

                                            </label>
                                        </div>
                                    </td>
                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa4"
                                                  id="alternativa4" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0px; width: 1%; vertical-align:middle;">
                                        <div class="letraCirculo">E</div>
                                        <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="check5" class="btn" style="border-radius: 50%; padding: 0px">
                                                <input type="radio" class="alt_buttons" name="alternativa_correta"
                                                       id="alternativa_correta" value="4" required>
                                                <img id="img5" src="{{asset('images/logo_check_cinza.png')}}">

                                            </label>
                                        </div>
                                    </td>
                                    <td style="border: 0px">
                                        <textarea class="form-control summernote_alt" type="alternativa5"
                                                  id="alternativa5" name="alternativa[]"
                                                  placeholder="Escreva aqui a alternativa" required
                                                  autofocus></textarea>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center my-4">
                <button type="submit" name="editar" class="btn btn-primary center-block">Salvar alterações</button>
            </div>
        </form>
    </div>



    <script type="text/javascript">
        $('#check1').click(function () {
            $('#img1').attr('src', "{{asset('images/logo_check_verde.png')}}")
            $('#img2').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img3').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img4').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img5').attr('src', "{{asset('images/logo_check_cinza.png')}}")
        })
        $('#check2').click(function () {
            $('#img2').attr('src', "{{asset('images/logo_check_verde.png')}}")
            $('#img1').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img3').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img4').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img5').attr('src', "{{asset('images/logo_check_cinza.png')}}")
        })
        $('#check3').click(function () {
            $('#img3').attr('src', "{{asset('images/logo_check_verde.png')}}")
            $('#img2').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img1').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img4').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img5').attr('src', "{{asset('images/logo_check_cinza.png')}}")
        })
        $('#check4').click(function () {
            $('#img4').attr('src', "{{asset('images/logo_check_verde.png')}}")
            $('#img2').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img3').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img1').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img5').attr('src', "{{asset('images/logo_check_cinza.png')}}")
        })
        $('#check5').click(function () {
            $('#img5').attr('src', "{{asset('images/logo_check_verde.png')}}")
            $('#img2').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img3').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img4').attr('src', "{{asset('images/logo_check_cinza.png')}}")
            $('#img1').attr('src', "{{asset('images/logo_check_cinza.png')}}")
        })
    </script>
@stop
