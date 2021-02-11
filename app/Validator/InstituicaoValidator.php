<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\Instituicao;
class InstituicaoValidator
{

	public static function validate($dados)
    {
    	$validator = \Validator::make($dados, Instituicao::$rules, Instituicao::$messages);

    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um Aluno");
    	}
    }
}
