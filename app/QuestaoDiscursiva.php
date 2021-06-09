<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class QuestaoDiscursiva extends Model
{       

    public function disciplina(){
    	return $this->belongsTo('SimuladoENADE\Disciplina');
    }

    public function questao_discursiva_simulado(){
        return $this->hasMany('\SimuladoENADE\QuestaoDiscursivaSimulado');
    }

    public function respostas_discursivas(){
        return $this->hasMany('SimuladoENADE\RespostaDiscursiva');
    }

    protected $table = 'questao_discursivas';

    protected $fillable = ['enunciado', 'dificuldade', 'disciplina_id'];

    public static $rules = [
    	'enunciado' => 'required|min:10',
    	'dificuldade' => 'required',
    	'disciplina_id'=> 'required|integer'
    ];

    public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido',
    	'enunciado.min' => 'Este campo deve ter no minimo 10 caracteres',
        'disciplina_id.integer' => 'o id deve ser inteiro'
    ];

    public function getDificuldadeAttribute($dificuldade){

        switch ($dificuldade) {
            case 1:
                return "Fácil";
            case 2:
                return "Médio";
            case 3:
                return "Difícil";
        }

        return null;
    }

}
