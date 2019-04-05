<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    //
    public function curso(){
    	return $this->belongsTo('SimuladoENADE\Curso');
    }
    
    public function questaos(){
        return $this->hasMany('\SimuladoENADE\Questao');
    } 

    public function questaos_facil(){
        return $this->questaos()->where([
            ['disciplina_id','=',$this->id],
            ['dificuldade','=',1]]);
    }

    public function questaos_medio(){
        return $this->questaos()->where([
            ['disciplina_id','=',$this->id],
            ['dificuldade','=',2]]);
    }

    public function questaos_dificil(){
        return $this->questaos()->where([
            ['disciplina_id','=',$this->id],
            ['dificuldade','=',3]]);
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
