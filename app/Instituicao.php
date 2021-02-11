<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $table = 'instituicoes';
    
    public $fillable = ['nome', 'cnpj', 'usuario_responsavel', 'email', 'password', 'tipousuario_id'];


    public static $rules = 
    [

    ];

    public static $messages = [

    ];
    // ['nome'=>'UPE', 'cnpj'=>'11.022.597/0001-91', 'usuario_responsavel'=>'Mark', 'email'=>'upe@institucional.br', 'password'=>'123456789', 'tipousuario_id'=>4];
}
