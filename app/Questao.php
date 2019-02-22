<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Questao extends Model

{
    //
    public function disciplina(){
    	return $this->hasOne('SimuladoENADE\Disciplina');
    }

    protected $fillable = ['enunciado', 
						   'alternativa_a', 
						   'alternativa_b',
						   'alternativa_c', 
						   'alternativa_d',
						   'alternativa_e', 
						   'alternativa_correta', 
						   'dificuldade',
                        'disciplina_id'];


    public static $rules = [
    	'enunciado' => 'required|min:10',
    	'alternativa_a' => 'required',
    	'alternativa_b' => 'required',
    	'alternativa_c' => 'required',
    	'alternativa_d' => 'required',
    	'alternativa_e' => 'required',
    	'alternativa_correta' => 'required|max:1',
    	'dificuldade' => 'required',
    	'disciplina_id'=> 'required|integer'
    ];

    public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido na forma correta',
    	'enunciado.min' => 'Este campo deve ter no minimo 10 caracteres',
    	'alternativa_correta.max' => 'Este campo de ter no max 1 caracteres',
        'disciplina_id.integer' => 'o id deve ser inteiro'
    ];

}
