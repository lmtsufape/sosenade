<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class NotaQuestaoDiscursiva extends Model
{
    protected $table = 'nota_questao_discursivas';

    protected $fillable = ['comentario', 'nota', 'resposta_discursiva_id', 'usuario_id'];
}
