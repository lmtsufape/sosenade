<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    //
    public function curso(){
    	return $this->hasOne('SimuladoENADE\Curso');
    }
    
    public function questao(){
        return $this->hasMany('\SimuladoENADE\Questao');
    }

    protected $fillable = ['nome', 'curso_id'];
    
    public static $rules = [
    	'nome' => 'required',
    	//'curso_id' => 'required'
    ];

    public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido na forma correta'
    ];
}
