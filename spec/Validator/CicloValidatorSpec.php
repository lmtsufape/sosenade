<?php

namespace spec\App\Validator;

use App\Validator\CicloValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Ciclo;
use PhpSpec\Laravel\LaravelObjectBehavior;

class CicloValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CicloValidator::class);
    }

    function it_o_tipo_ciclo_do_ciclo_eh_obrigatorio(){
	     $ciclo = new \App\Ciclo();	
	     $ciclo->tipo_ciclo = "";
	    

	     $this->shouldThrow('App\Validator\ValidationException')
         ->duringValidate($ciclo->toArray());
    }  

      function it_o_tipo_ciclo_min_do_ciclo_eh_obrigatorio(){
         $ciclo = new \App\Ciclo(); 
         $ciclo->tipo_ciclo = "enad";
        

         $this->shouldThrow('App\Validator\ValidationException')
         ->duringValidate($ciclo->toArray());
    } 

    
}
