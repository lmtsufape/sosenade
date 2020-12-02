<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    //
    public function aluno(){
    	return $this->belongsTo('SimuladoENADE\Aluno');
    }
    
    public function questao(){
    	return $this->belongsTo('SimuladoENADE\Questao');
    }

    public function simulado(){
        return $this->belongsTo('SimuladoENADE\Simulado');
    }

    public function disciplina(){
        return $this->belongsTo('SimuladoENADE\Disciplina', 'id');
    }

    protected $fillable = ['questao_id','aluno_id','alternativa_questao'];


    public static $rules = [
    	'questao_id' => 'required',
    	'aluno_id' => 'required',
    	'alternativa_questao' => 'required|max:1'

    ];

    public static $messages = [
    	'required' => 'O campo: attribute é obrigatiorio',
    	'alternativa_questao.max' => 'o campo aceita apenas uma alternativa'

    ];
}
