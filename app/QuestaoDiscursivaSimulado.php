<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class QuestaoDiscursivaSimulado extends Model
{   

    public function simulado(){
    	return $this->belongsTo('SimuladoENADE\Simulado');
    }
    
    public function questao(){
    	return $this->belongsTo('SimuladoENADE\QuestaoDiscursiva', 'questao_discursiva_id', 'id');
    }

    protected $table = 'questao_discursiva_simulados';

    protected $fillable = ['questao_discursiva_id', 'simulado_id'];

    public static $rules = [
    	'questao_discursiva_id' => 'required',
    	'simulado_id' => 'required'
    ];

    public static $messages = [
    	'required' => 'O campo:attribute é obrigatório '
    ];

}
