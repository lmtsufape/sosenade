<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\UnidadeAcademica;

class UnidadeAcademicaValidator {

	public static function validate($dados)
    {
		// $validator = \Validator::make($dados, ['nome' => "required|unique:unidade_academicas,nome,".$dados['id'],], UnidadeAcademica::$messages);
		$validator = \Validator::make($dados, UnidadeAcademica::$rules, UnidadeAcademica::$messages);

    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar Unidade Academica");
    	}
    }
}
