<?php


namespace spec\App\Validator;

use App\Validator\CursoValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Curso;
use PhpSpec\Laravel\LaravelObjectBehavior;

class CursoValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CursoValidator::class);
    }

      function it_o_curso_id_eh_obrigatorio(){
	     $curso = new \App\Curso();	
	     $curso->ciclo_id = null;
	     $curso->curso_nome = "bcc";
	    

	     $this->shouldThrow('App\Validator\ValidationException')
         ->duringValidate($curso->toArray());
    } 
        function it_o_curso_nome_eh_obrigatorio(){
	     $curso = new \App\Curso();	
	     $curso->ciclo_id = 1;
	     $curso->curso_nome = "";
	    

	     $this->shouldThrow('App\Validator\ValidationException')
         ->duringValidate($curso->toArray());
    }   


}
