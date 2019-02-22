<?php

namespace spec\App\Validator;

use App\Validator\QuestaoSimuladoValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\QuestaoSimulado;
use PhpSpec\Laravel\LaravelObjectBehavior;

class QuestaoSimuladoValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(QuestaoSimuladoValidator::class);
    }

    function it_questao_id_eh_obrigatorio(){
    	$questaoSimulado = new \App\QuestaoSimulado();
    	$questaoSimulado->questao_id = null;
    	$questaoSimulado->simulado_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate(
            $questaoSimulado->toArray());
    }

     function it_simulado_id_eh_obrigatorio(){
    	$questaoSimulado = new \App\QuestaoSimulado();
    	$questaoSimulado->questao_id = 1;
    	$questaoSimulado->simulado_id = null;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate(
            $questaoSimulado->toArray());
    }

}
