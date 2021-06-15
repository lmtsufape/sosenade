<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class RespostaDiscursiva extends Model
{
    protected $table = 'resposta_discursivas';

    protected $fillable = ['resposta_discursiva', 'questao_discursiva_id', 'simulado_id', 'aluno_id'];

    public function questao_discursiva() {
        return $this->belongsTo('\SimuladoENADE\QuestaoDiscursiva', 'questao_discursiva_id', 'id');
    }

    public function nota() {
        return $this->hasOne('\SimuladoENADE\NotaQuestaoDiscursiva');
    }

    public function foi_corrigida() {
        return ($this->nota ? "Sim" : "Não");
    }

    public function aluno() {
        return $this->belongsTo('\SimuladoENADE\Aluno');
    }

}
