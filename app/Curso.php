<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //Verificar o belongsTo se é necessario
    public function ciclo(){
    	return $this->hasOne('SimuladoENADE\Ciclo');
    }
     public function unidadeAcademica(){
        return $this->hasOne('SimuladoENADE\UnidadeAcademica');
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

    public function unidade() {
        return $this->belongsTo("SimuladoENADE\UnidadeAcademica");
    }
}
