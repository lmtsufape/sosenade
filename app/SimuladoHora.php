<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class SimuladoHora extends Model
{
    //
    protected $fillable = ['aluno_id','simulado_id'];
    
    protected $dates = ['hora_inicio_simulado', 'hora_fim_simulado'];

}
