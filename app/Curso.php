<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model{

    public function ciclo(){
    	return $this->belongsTo('SimuladoENADE\Ciclo');
    }

    public function unidade(){
        return $this->belongsTo("SimuladoENADE\UnidadeAcademica");
    }

    public function disciplinas(){
        return $this->hasMany('SimuladoENADE\Disciplina');
    }

    public function simulados(){
        return $this->hasMany('SimuladoENADE\Simulado');
    }

    public function alunos(){
        return $this->hasMany('SimuladoENADE\Aluno');
    }

    public function usuarios(){
        return $this->hasMany('SimuladoENADE\Usuario');
    }

    public function coordenadores(){
        return $this->usuarios()->where('tipousuario_id', '=', 2);
    }

    public function professores(){
        return $this->usuarios()->where('tipousuario_id', '=', 3);
    }

    protected $fillable = ['curso_nome','ciclo_id', 'unidade_id'];
    
    public static $rules = [
    	'ciclo_id' => 'required',
    	'curso_nome' => 'required',
        'unidade_id' => 'required'
    ];

    public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido na forma correta' 
    ];

}
