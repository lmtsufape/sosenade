<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\Simulado;
class SimuladoValidator 
{
		public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    								 Simulado::$rules,
    								 Simulado::$messages);

    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um novo Simulado");
    	}
    }
}
