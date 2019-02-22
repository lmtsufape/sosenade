<?php

namespace spec\App\Validator;

use App\Validator\SimuladoValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Simulado;
use PhpSpec\Laravel\LaravelObjectBehavior;

class SimuladoValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SimuladoValidator::class);
    }

    function it_descricao_eh_obrigatorio(){
    	$simulado = new \App\Simulado();
    	$simulado->descricao_simulado = "";
        $simulado->usuario_id = 1;
        $simulado->simulado_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($simulado->toArray());
    }

    function it_usuario_id_eh_obrigatorio(){
        $simulado = new \App\Simulado();
        $simulado->descricao_simulado = "batatinha";
        $simulado->usuario_id = null;
        $simulado->simulado_id = 1;

        $this->shouldThrow('App\Validator\ValidationException')->duringValidate($simulado->toArray());
    }


    function it_simulado_id_eh_obrigatorio(){
        $simulado = new \App\Simulado();
        $simulado->descricao_simulado = "batatinha";
        $simulado->usuario_id = 1;
        $simulado->simulado_id = null;

        $this->shouldThrow('App\Validator\ValidationException')->duringValidate($simulado->toArray());
    }

     function it_descricao_min_eh_obrigatorio(){
    	$simulado = new \App\Simulado();
    	$simulado->descricao_simulado = "1234";
        $simulado->usuario_id = 1;
        $simulado->simulado_id = 1;


    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($simulado->toArray());
    }
}
