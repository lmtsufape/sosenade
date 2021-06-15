<?php

namespace SimuladoENADE\Validator;
use SimuladoENADE\QuestaoDiscursivaSimulado;

class QuestaoSimuladoValidator {

	public static function validate($dados) {

    	$validator = \Validator::make($dados, QuestaoDiscursivaSimulado::$rules, QuestaoDiscursivaSimulado::$messages);
        
    	if(!$validator->errors()->isEmpty()){
    		throw new ValidationException($validator, "Erro ao validar uma questao de um simulado");
    	}
    }
}
