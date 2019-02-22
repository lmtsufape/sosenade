<?php

namespace spec\App\Validator;

use App\Validator\TurmaValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Turma;
use PhpSpec\Laravel\LaravelObjectBehavior;

class TurmaValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TurmaValidator::class);
    }

    function it_aluno_id_eh_obrigatorio(){
    	$turma = new \App\Turma();
    	$turma->aluno_id = null;
    	$turma->ciclo_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($turma->toArray());
    
    }


    function it_ciclo_id_eh_obrigatorio(){
    	$turma = new \App\Turma();
    	$turma->aluno_id = 1;
    	$turma->ciclo_id = null;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($turma->toArray());
    
    }
}
