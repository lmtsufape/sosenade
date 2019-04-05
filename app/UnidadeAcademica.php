<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class UnidadeAcademica extends Model
{
    public function cursos(){
        return $this->hasMany('SimuladoENADE\Curso', 'unidade_id');
    }
}
