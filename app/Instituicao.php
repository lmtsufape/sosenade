<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Instituicao extends Authenticatable
{
    protected $table = 'instituicoes';
    
    public $fillable = ['nome', 'cnpj', 'email', 'password', 'tipousuario_id'];
    protected $hidden = ['password', 'remember_token'];

    public static $rules = 
    [

    ];

    public static $messages = [

    ];
}
