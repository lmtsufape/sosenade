<?php

namespace spec\App\Validator;

use App\Validator\SimuladoAlunoValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\SimuladoAluno;
use PhpSpec\Laravel\LaravelObjectBehavior;

class SimuladoAlunoValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SimuladoAlunoValidator::class);
    }

    function it_aluno_id_eh_obrigatorio(){
    	$simuladoAluno = new \App\SimuladoAluno();
    	$simuladoAluno->aluno_id = null;
    	$simuladoAluno->simulado_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($simuladoAluno->toArray());
    }

      function it_simulado_id_eh_obrigatorio(){
    	$simuladoAluno = new \App\SimuladoAluno();
    	$simuladoAluno->aluno_id = 1;
    	$simuladoAluno->simulado_id = null;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($simuladoAluno->toArray());
    }
}
