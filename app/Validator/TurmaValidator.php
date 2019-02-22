<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\Turma;
class TurmaValidator
{

	public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    								 Turma::$rules,
    								 Turma::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar uma Turma");
    	}
    }
}
