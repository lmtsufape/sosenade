<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\Questao;

class QuestaoValidator
{

	public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    								 Questao::$rules,
    								 Questao::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar uma nova Questao");
    	}
    }
}
