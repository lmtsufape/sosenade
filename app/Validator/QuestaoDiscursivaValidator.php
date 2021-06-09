<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\QuestaoDiscursiva;

class QuestaoDiscursivaValidator
{

	public static function validate($dados)
    {

    	$validator = \Validator::make($dados, QuestaoDiscursiva::$rules, QuestaoDiscursiva::$messages);
    	
        if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar uma nova Questao");
    	}
    }
}
