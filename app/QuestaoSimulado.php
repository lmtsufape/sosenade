<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class QuestaoSimulado extends Model
{
    //
    public function simulado(){
    	return $this->hasOne('SimuladoENADE\Simulado');
    }
    public function questao(){
    	return $this->hasOne('SimuladoENADE\Questao');
    }

    protected $fillable = ['questao_id','simulado_id'];

    public static $rules = [
    	'questao_id' => 'required',
    	'simulado_id' => 'required'

    ];

    public static $messages = [
    	'required' => 'O campo:attribute é obrigatório '

    ];
}
