<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class Tipousuario extends Model
{
    public function usuario(){
    	return $this->hasMany('\SimuladoENADE\Usuario');
    }
   
}
