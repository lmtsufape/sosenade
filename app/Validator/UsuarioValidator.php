<?php

namespace SimuladoENADE\Validator;

use Illuminate\Validation\Rule;
use SimuladoENADE\Rules\CPFUnicoPorPerfil;
use SimuladoENADE\Usuario;
class UsuarioValidator
{
	public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    								 [
                                        'nome'  => 'required',
                                        'cpf' => ['required', 'min:14'],
                                        'password' => 'required|min:8|confirmed',
                                        'email' => 'required|email|unique:usuarios,email,'.$dados['id'],
                                        'tipousuario_id' => 'required',
                                        'curso_id'  => 'required'
                                    ],
    								 Usuario::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um aluno");
    	}



    }
}
