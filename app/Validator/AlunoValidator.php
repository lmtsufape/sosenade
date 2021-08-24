<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\Aluno;
class AlunoValidator
{

	public static function validate($dados)
    {

    	$validator = \Validator::make($dados,
    							[    	
    								'nome'  => 'required|',
							    	'cpf' => 'required|min:14|unique:alunos,cpf,'.$dados['id'],
							    	'email' => 'required|email|unique:alunos,email,'.$dados['id'],
									'password' => 'required|min:8|required_with:password_confirmation',
									'password_confirmation' => 'required_with:password|same:password'
								],
    							 Aluno::$messages);
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar um Aluno");
    	}
    }
}
