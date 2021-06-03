<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class QuestaoDiscursiva extends Model
{
    protected $table = 'questao_discursivas';

    protected $fillable = ['enunciado', 'dificuldade', 'disciplina_id'];
}
