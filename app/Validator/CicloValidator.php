<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\Ciclo;

class CicloValidator
{

	public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    								 Ciclo::$rules,
    								 Ciclo::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um Ciclo");
    	}
    }
}
