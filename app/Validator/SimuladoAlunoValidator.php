<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\SimuladoAluno;
class SimuladoAlunoValidator
{

		public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    								 SimuladoAluno::$rules,
    								 SimuladoAluno::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um novo Simulado Aluno");
    	}
    }
}
