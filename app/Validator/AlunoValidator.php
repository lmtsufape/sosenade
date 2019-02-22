<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\Aluno;
class AlunoValidator
{

	public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    								 Aluno::$rules,
    								 Aluno::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um Aluno");
    	}
    }
}
