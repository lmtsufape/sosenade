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
    		$validator->errors()->add('qtd_maior', 'A quantidade de questões exigidas ('.$qtd_exigido.') está muito grande. A quantidade máxima de questões compatíveis com os filtros é '.$qtd_existente.'.'); 
    	}

    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um novo Simulado Aluno");
    	}
    }
}
