<?php

namespace spec\App\Validator;

use App\Validator\DisciplinaValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Disciplina;
use PhpSpec\Laravel\LaravelObjectBehavior;

class DisciplinaValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DisciplinaValidator::class);
    }
	    
    function it_o_nome_da_disciplina_eh_obrigatorio(){
	     $disciplina = new \App\Disciplina();	
	     $disciplina->nome = "";
	     $disciplina->curso_id = 1;

	     $this->shouldThrow('App\Validator\ValidationException')->duringValidate($disciplina->toArray());
    }  

    function it_id_curso_eh_curso(){
         $disciplina = new \App\Disciplina();   
         $disciplina->nome = "pedro";
         $disciplina->curso_id = null;

        $this->shouldThrow('App\Validator\ValidationException')->duringValidate($disciplina->toArray());
    }
    
}
