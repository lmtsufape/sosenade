<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    //
    public function aluno(){
    	return $this->hasOne('SimuladoENADE\Aluno');
    }
    public function ciclo(){
    	return $this->hasOne('SimuladoENADE\Ciclo');
    }


     protected $fillable = ['aluno_id','ciclo_id'];


     public static $rules = [
     	'aluno_id' => 'required',
     	'ciclo_id' => 'required'
     ];

     public static $messages = [
     	'required' => 'O campo:attribute é obrigatório'

     ];


}
