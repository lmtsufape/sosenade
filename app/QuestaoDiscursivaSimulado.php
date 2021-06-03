<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class QuestaoDiscursivaSimulado extends Model
{
    protected $table = 'questao_discursiva_simulados';

    protected $fillable = ['questao_discursiva_id', 'simulado_id'];

}
