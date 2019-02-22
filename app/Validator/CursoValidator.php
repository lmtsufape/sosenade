<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\Curso;
class CursoValidator
{
	public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    								 Curso::$rules,
    								 Curso::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um Curso");
    	}
    }
}
