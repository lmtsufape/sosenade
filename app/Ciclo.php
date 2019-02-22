<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    //
    protected $fillable = ['tipo_ciclo'];

    public static $rules = [
    	'tipo_ciclo' => 'required|min:5'
    ];
    
    public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido na forma correta',
    	'tipo_ciclo.min' => 'Este campo deve ter no minimo 5 caracteres'
    ];
}
