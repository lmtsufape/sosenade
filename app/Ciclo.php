<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model{

	public function cursos(){
    	return $this->hasMany('SimuladoENADE\Curso');
    }

    protected $fillable = ['tipo_ciclo', 'instituicao_id'];

    public static $rules = [
    	'tipo_ciclo' => 'required|min:4|max:4'
    ];

    public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido na forma correta',
    	'tipo_ciclo.min' => 'Este campo deve ter no minimo 4 caracteres',
        'tipo_ciclo.max' => 'Este campo deve ter no maximo 4 caracteres'
    ];
}
