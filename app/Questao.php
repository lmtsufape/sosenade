<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Questao extends Model {
    
    public function disciplina(){
    	return $this->hasOne('SimuladoENADE\Disciplina');
    }

    protected $fillable = ['enunciado',
						   'alternativa_correta', 
						   'dificuldade',
                           'disciplina_id'];

    public static $rules = [
    	'enunciado' => 'required|min:10',
    	'alternativa_correta' => 'required|max:1',
    	'dificuldade' => 'required',
    	'disciplina_id'=> 'required|integer'
    ];

    public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido',
    	'enunciado.min' => 'Este campo deve ter no minimo 10 caracteres',
    	'alternativa_correta.max' => 'Este campo de ter no max 1 caracteres',
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
