<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class SimuladoAluno extends Model
{
    //
    public function simulado(){
    	return $this->hasOne('SimuladoENADE\Simulado');
    }
    public function aluno(){
    	return $this->hasOne('SimuladoENADE\Aluno');
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
