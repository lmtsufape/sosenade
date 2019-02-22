<?php

namespace SimuladoENADE;

#use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Usuario extends Authenticatable
{

	protected $fillable = ['nome', 'cpf', 'email', 'password', 'tipousuario_id','curso_id'];

    protected $hidden = ['password', 'remember_token'];

    public function tipousuario(){
        return $this->BelongsTo('\SimuladoENADE\Tipousuario');
    }
    public function curso(){
        return $this->hasOne('\SimuladoENADE\Curso');
    }

    public static $rules = [
    	'nome'  => 'required',
    	'cpf' => 'required|min:14',
    	'password' => 'required|min:8|confirmed',
    	'email' => 'required|email',
    	'tipousuario_id' => 'required',
    	'curso_id'  => 'required'
    ];

     public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido na forma correta',
    	'cpf.min' => 'O :attribute deve conter no minimo 14 caracteres',
    	'password.min' => 'A senha deve ter no minimo 8 caracteres',
    	'email.email' => "O email deve ser um email valido",
        'password.confirmed' => "As senhas devem ser identicas"
    ];
}
