<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class SimuladoAluno extends Model {
    //
    public function simulado(){
    	return $this->belongsTo('SimuladoENADE\Simulado', 'simulado_id', 'id');
    }
    public function aluno(){
    	return $this->belongsTo('SimuladoENADE\Aluno');
    }

    public function questaos(){
        return $this->hasManyThrough('SimuladoENADE\QuestaoSimulado', 'SimuladoENADE\Simulado', 'id', 'simulado_id');
    }

    protected $fillable = ['aluno_id','simulado_id'];

    public static $rules = [
     	'aluno_id' => 'required',
     	'simulado_id' => 'required'
    ];

    public static $messages = [
     	'required' => 'O campo:attribute é obrigatório'
    ];
}
