<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instituicao extends Authenticatable
{
    Use Notifiable;
    protected $table = 'instituicoes';

    public $fillable = ['nome', 'cnpj', 'email', 'password', 'tipousuario_id'];
    protected $hidden = ['password', 'remember_token'];

    public static $rules =
    [
        'nome'  => 'required',
    	'cnpj' => 'required|min:18',
    	'password' => 'required|min:8|confirmed',
    	'email' => 'required|email',
    	// 'tipousuario_id' => 'required',
    ];

    public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido na forma correta',
    	'cnpj.min' => 'O :attribute deve conter no minimo 18 caracteres',
    	'password.min' => 'A senha deve ter no minimo 8 caracteres',
    	'email.email' => "O email deve ser um email valido",
        'unique' => "O :attribute já esta cadastrado no sistema!!",
        'password.confirmed' => "As senhas devem ser identicas"
    ];

}
