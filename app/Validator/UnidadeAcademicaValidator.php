<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\UnidadeAcademica;
class InstituicaoValidator
{

	public static function validate($dados)
    {
    	$validator = \Validator::make($dados, UnidadeAcademica::$rules, UnidadeAcademica::$messages);

    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar Instituição");
    	}
    }
}
