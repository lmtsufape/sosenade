<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Simulado extends Model
{
    //
	public function usuario(){
    	return $this->belongsTo('SimuladoENADE\Usuario');
    }

    public function curso(){
    	return $this->belongsTo('SimuladoENADE\Curso');
    }

    public function questaos(){
        return $this->hasMany('\SimuladoENADE\QuestaoSimulado', 'simulado_id', 'id');
    }

    public function questaos_discursivas(){
        return $this->hasMany('\SimuladoENADE\QuestaoDiscursivaSimulado', 'simulado_id', 'id');
    }


    public function simulados_alunos(){
        return $this->hasMany('\SimuladoENADE\SimuladoAluno', 'simulado_id', 'id');
    }



    protected $fillable = ['descricao_simulado','usuario_id','curso_id'];

    protected $dates = ['data_inicio_simulado', 'data_fim_simulado'];

    public static $rules = [
    	'descricao_simulado' => 'required|min:5',
//      'usuario_id' => 'required',
//      'curso_id' => 'required'
    ];

    public static $messages = [
    	'required' => 'O campo :attribute deve ser preenchido na forma correta',
    	'descricao_simulado.min' => 'O campo deve ser no mínimo 5 letras'
    ];

}
