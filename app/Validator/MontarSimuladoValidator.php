<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\SimuladoAluno;
use SimuladoENADE\Validator\ValidationException;
use Illuminate\Support\Facades\Validator;

class MontarSimuladoValidator
{

		public static function validate($qtd_existente, $qtd_exigido)
    {

    	$validator = Validator::make($rules = [], $messages = []);

    	if($qtd_existente < $qtd_exigido){
    		$validator->errors()->add('qtd_maior', 'A quantidade de Questoes exigidas esta muito grande pra o banco'); 
    	}

    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um novo Simulado Aluno");
    	}
    }
}
