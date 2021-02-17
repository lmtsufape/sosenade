@extends('layouts.app')
@section('content')

<div class="container-fluid" style="width: 75%; height: 500px; background-color: white; margin-top: 20px;padding: 0 20px 20 0; border-radius: 15px;
overflow: hidden; box-shadow: -1px 4px 17px -5px rgba(0,0,0,0.64);
-webkit-box-shadow: -1px 4px 17px -5px rgba(0,0,0,0.64);
-moz-box-shadow: -1px 4px 17px -5px rgba(0,0,0,0.64);">
    <div class="container-fluid">
        <div class="row" style="padding: 0px">
            <div class="col-sm-6 " style="margin-right: 30px; margin-left: -15px; padding: 0px;">
                <div style="width: 100%; height: 100%; overflow: hidden;">
                    <img src="/images/bibliotecas.png" alt="">
                </div>
            </div>
            <div class="col-sm-6" style="margin-right: -100px">
                @if(Session::has('fail'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {{ Session::get('message', '') }}
                    </div>
                @endif
                <div class="row" style="margin: 20px 0 60px; align-self: center;">
                    <img src="{{asset('1.png')}}" style="width: 200px; margin-left: auto; margin-right: auto" class="img-fluid float-left">
                </div>

                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" style="width: 100%; ">
                    @csrf
                    <div class="form-group col-md-11">
                        <label for="email" class="control-label"
                               style="font-family: 'Segoe UI'; color: #black; font-weight: bold; font-size: 20px">E-mail</label>
                        <input id="email" type="email" name="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               value="{{ old('email') }}"
                               style="padding: 0; color: black; border-radius: 0; box-shadow: none; border: none; border-bottom: 1px solid"
                               required autocomplete="email" autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-11">
                        <label for="password" class="control-label"
                               style="font-family: 'Segoe UI'; color: #black; font-weight: bold; font-size: 20px">Senha</label>
                        <input id="password" type="password" name="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               style="padding: 0; color: black; border-radius: 0; box-shadow: none; border: none; border-bottom: 1px solid"
                               required autocomplete="current-password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-check">
                        <input class="form-control-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Lembrar E-mail e Senha') }}
                        </label>
                    </div>
                    <br>
                    <div class="form-group col-md-11">
                        <button type="submit" class="btn btn-success btn-block">
                            {{ __('Entrar') }}
                        </button>
                    </div>
                    <div class="form-group col-md-11">
                        <center>
                            <a class=" btn-link" href="{{ route('password.request') }}">Esqueci minha senha</a>
                        </center>
                        <hr style="margin-top: 0">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
