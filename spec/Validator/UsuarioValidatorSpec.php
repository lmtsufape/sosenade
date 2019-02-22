<?php

namespace spec\App\Validator;

use App\Validator\UsuarioValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Usuario;
use PhpSpec\Laravel\LaravelObjectBehavior;

class UsuarioValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UsuarioValidator::class);
    }

    function it_o_nome_do_usuario_eh_obrigatorio(){
    	$usuario = new \App\Usuario();
    	$usuario->nome = "";
    	$usuario->cpf = "123.456.789-50";
    	$usuario->senha = "cachorro";
    	$usuario->email = "pedro_cachorrolouco@gmail.com";
    	$usuario->tipo_usuario_id = 1;
    	$usuario->curso_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($usuario->toArray());
    	} 

     function it_o_cpf_do_usuario_eh_obrigatorio(){
    	$usuario = new \App\Usuario();
    	$usuario->nome = "Pedro";
    	$usuario->cpf = "";
    	$usuario->senha = "cachorro";
    	$usuario->email = "pedro_cachorrolouco@gmail.com";
    	$usuario->tipo_usuario_id = 1;
    	$usuario->curso_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($usuario->toArray());
    	} 

    	function it_a_senha_do_usuario_eh_obrigatorio(){
    	$usuario = new \App\Usuario();
    	$usuario->nome = "Pedro";
    	$usuario->cpf = "123.456.789-50";
    	$usuario->senha = "";
    	$usuario->email = "pedro_cachorrolouco@gmail.com";
    	$usuario->tipo_usuario_id = 1;
    	$usuario->curso_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($usuario->toArray());
    	} 


    	function it_o_email_do_usuario_eh_obrigatorio(){
    	$usuario = new \App\Usuario();
    	$usuario->nome = "Pedro";
    	$usuario->cpf = "123.456.789-50";
    	$usuario->senha = "cachorro";
    	$usuario->email = "";
    	$usuario->tipo_usuario_id = 1;
    	$usuario->curso_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($usuario->toArray());
    	}


    	function it_o_tipo_usuario_id_do_usuario_eh_obrigatorio(){
    	$usuario = new \App\Usuario();
    	$usuario->nome = "Pedro";
    	$usuario->cpf = "123.456.789-50";
    	$usuario->senha = "cachorro";
    	$usuario->email = "pedro_cachorrolouco@gmail.com";
    	$usuario->tipo_usuario_id = null;
    	$usuario->curso_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($usuario->toArray());
    	}


    	function it_o_curso_id_do_usuario_eh_obrigatorio(){
    	$usuario = new \App\Usuario();
    	$usuario->nome = "Pedro";
    	$usuario->cpf = "123.456.789-50";
    	$usuario->senha = "cachorro";
    	$usuario->email = "pedro_cachorrolouco@gmail.com";
    	$usuario->tipo_usuario_id = 1;
    	$usuario->curso_id = null;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($usuario->toArray());
    	}


        function it_o_cpf_min_do_usuario_eh_obrigatorio(){
        $usuario = new \App\Usuario();
        $usuario->nome = "Pedro";
        $usuario->cpf = "1234567891234";
        $usuario->senha = "cachorro";
        $usuario->email = "pedro_cachorrolouco@gmail.com";
        $usuario->tipo_usuario_id = 1;
        $usuario->curso_id = 1;

        $this->shouldThrow('App\Validator\ValidationException')->duringValidate($usuario->toArray());
        } 

        function it_a_senha_min_do_usuario_eh_obrigatorio(){
        $usuario = new \App\Usuario();
        $usuario->nome = "Pedro";
        $usuario->cpf = "123.456.789-50";
        $usuario->senha = "1234567";
        $usuario->email = "pedro_cachorrolouco@gmail.com";
        $usuario->tipo_usuario_id = 1;
        $usuario->curso_id = 1;

        $this->shouldThrow('App\Validator\ValidationException')->duringValidate($usuario->toArray());
        } 



}

