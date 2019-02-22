<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\Usuario;
class UsuarioValidator
{
	public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    								 Usuario::$rules,
    								 Usuario::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um aluno");
    	}


    	
    }
}
