<?php

namespace spec\App\Validator;

use App\Validator\RespostaValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Resposta;
use PhpSpec\Laravel\LaravelObjectBehavior;

class RespostaValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RespostaValidator::class);
    }

    function it_questao_id_eh_obrigatorio(){
    	$resposta = new \App\Resposta();
    	$resposta->questao_id = null;
    	$resposta->aluno_id = 1;
    	$resposta->alternativa_questao = "a";

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($resposta->toArray());

    }

        function it_aluno_id_eh_obrigatorio(){
    	$resposta = new \App\Resposta();
    	$resposta->questao_id = 1;
    	$resposta->aluno_id = null;
    	$resposta->alternativa_questao = "a";

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($resposta->toArray());

    }

        function it_alternativa_questao_eh_obrigatorio(){
    	$resposta = new \App\Resposta();
    	$resposta->questao_id = 1;
    	$resposta->aluno_id = 1;
    	$resposta->alternativa_questao = "";

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($resposta->toArray());

    }
     function it_alternativa_questao_no_max_um(){
    	$resposta = new \App\Resposta();
    	$resposta->questao_id = 1;
    	$resposta->aluno_id = 1;
    	$resposta->alternativa_questao = "as";

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($resposta->toArray());

    }
}
