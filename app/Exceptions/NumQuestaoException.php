<?php

namespace SimuladoENADE\Exceptions;

use Exception;

class NumQuestaoException extends Exception
{
	public function errorMessage(){
		$errorMsg = 'Numero de questões Maximas atingidas'
	}
}
