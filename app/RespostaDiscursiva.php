<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class RespostaDiscursiva extends Model
{
    protected $table = 'resposta_discursivas';

    protected $fillable = ['resposta_discursiva', 'questao_discursiva_id', 'simulado_id', 'aluno_id'];

}
