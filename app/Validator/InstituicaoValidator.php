<?php

namespace SimuladoENADE\Validator;

use SimuladoENADE\Instituicao;

class InstituicaoValidator
{

	public static function validate($dados)
    {
    	$validator = \Validator::make($dados,[
											'nome' => 'required',
											'cnpj' => 'required|min:18|unique:instituicoes,cnpj,'.$dados['id'],
											'email' => 'required|email|unique:instituicoes,email,'.$dados['id'],
											'password' => 'required|min:8|confirmed',
											// 'tipousuario_id' => 'required',
											],
											Instituicao::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar Instituição");
    	}
    }
}
