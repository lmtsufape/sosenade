<?php

namespace spec\App\Validator;

use App\Validator\QuestaoValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Questao;
use PhpSpec\Laravel\LaravelObjectBehavior;


class QuestaoValidatorSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(QuestaoValidator::class);
    }

    function it_o_enuciado_eh_obrigatorio(){
    	$questao = new \App\Questao();
    	$questao->enuciado = "";
    	$questao->alternativa_a = "a";
    	$questao->alternativa_b = "b";
    	$questao->alternativa_c = "c";
    	$questao->alternativa_d = "d";
    	$questao->alternativa_e = "e";
    	$questao->alternativa_correta = "a";
    	$questao->dificuldade = 1;
    	$questao->disciplina_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }

    function it_a_alternativa_a_eh_obrigatorio(){
    	$questao = new \App\Questao();
    	$questao->enuciado = "asdfghjkl";
    	$questao->alternativa_a = "";
    	$questao->alternativa_b = "b";
    	$questao->alternativa_c = "c";
    	$questao->alternativa_d = "d";
    	$questao->alternativa_e = "e";
    	$questao->alternativa_correta = "a";
    	$questao->dificuldade = 1;
    	$questao->disciplina_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }

    function it_a_alternativa_b_eh_obrigatorio(){
    	$questao = new \App\Questao();
    	$questao->enuciado = "asdfghjkl";
    	$questao->alternativa_a = "a";
    	$questao->alternativa_b = "";
    	$questao->alternativa_c = "c";
    	$questao->alternativa_d = "d";
    	$questao->alternativa_e = "e";
    	$questao->alternativa_correta = "a";
    	$questao->dificuldade = 1;
    	$questao->disciplina_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }

    function it_a_alternativa_c_eh_obrigatorio(){
    	$questao = new \App\Questao();
    	$questao->enuciado = "asdfghjkl";
    	$questao->alternativa_a = "a";
    	$questao->alternativa_b = "b";
    	$questao->alternativa_c = "";
    	$questao->alternativa_d = "d";
    	$questao->alternativa_e = "e";
    	$questao->alternativa_correta = "a";
    	$questao->dificuldade = 1;
    	$questao->disciplina_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }

    function it_a_alternativa_d_eh_obrigatorio(){
    	$questao = new \App\Questao();
    	$questao->enuciado = "asdfghjkl";
    	$questao->alternativa_a = "a";
    	$questao->alternativa_b = "b";
    	$questao->alternativa_c = "c";
    	$questao->alternativa_d = "";
    	$questao->alternativa_e = "e";
    	$questao->alternativa_correta = "a";
    	$questao->dificuldade = 1;
    	$questao->disciplina_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }
    function it_a_alternativa_e_eh_obrigatorio(){
    	$questao = new \App\Questao();
    	$questao->enuciado = "asdfghjkl";
    	$questao->alternativa_a = "a";
    	$questao->alternativa_b = "b";
    	$questao->alternativa_c = "c";
    	$questao->alternativa_d = "d";
    	$questao->alternativa_e = "";
    	$questao->alternativa_correta = "a";
    	$questao->dificuldade = 1;
    	$questao->disciplina_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }
    function it_a_alternativa_correta_eh_obrigatorio(){
    	$questao = new \App\Questao();
    	$questao->enuciado = "asdfghjkl";
    	$questao->alternativa_a = "a";
    	$questao->alternativa_b = "b";
    	$questao->alternativa_c = "c";
    	$questao->alternativa_d = "d";
    	$questao->alternativa_e = "e";
    	$questao->alternativa_correta = "";
    	$questao->dificuldade = 1;
    	$questao->disciplina_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }
    function it_a_dificuldade_eh_obrigatorio(){
    	$questao = new \App\Questao();
    	$questao->enuciado = "asdfghjkl";
    	$questao->alternativa_a = "a";
    	$questao->alternativa_b = "b";
    	$questao->alternativa_c = "c";
    	$questao->alternativa_d = "d";
    	$questao->alternativa_e = "e";
    	$questao->alternativa_correta = "a";
    	$questao->dificuldade = null;
    	$questao->disciplina_id = 1;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }
    function it_a_disciplina_id_eh_obrigatorio(){
    	$questao = new \App\Questao();
    	$questao->enuciado = "asdfghjkl";
    	$questao->alternativa_a = "a";
    	$questao->alternativa_b = "b";
    	$questao->alternativa_c = "c";
    	$questao->alternativa_d = "d";
    	$questao->alternativa_e = "e";
    	$questao->alternativa_correta = "a";
    	$questao->dificuldade = 1;
    	$questao->disciplina_id = null;

    	$this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }



        function it_o_enuciado_min_eh_obrigatorio(){
        $questao = new \App\Questao();
        $questao->enuciado = "pedro1234";
        $questao->alternativa_a = "a";
        $questao->alternativa_b = "b";
        $questao->alternativa_c = "c";
        $questao->alternativa_d = "d";
        $questao->alternativa_e = "e";
        $questao->alternativa_correta = "a";
        $questao->dificuldade = 1;
        $questao->disciplina_id = 1;

        $this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }

     function it_a_alternativa_correta_max_eh_obrigatorio(){
        $questao = new \App\Questao();
        $questao->enuciado = "pedro1234s";
        $questao->alternativa_a = "a";
        $questao->alternativa_b = "b";
        $questao->alternativa_c = "c";
        $questao->alternativa_d = "d";
        $questao->alternativa_e = "e";
        $questao->alternativa_correta = "ac";
        $questao->dificuldade = 1;
        $questao->disciplina_id = 1;

        $this->shouldThrow('App\Validator\ValidationException')->duringValidate($questao->toArray());
    }


    

}
