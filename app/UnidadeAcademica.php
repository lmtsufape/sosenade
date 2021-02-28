<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class UnidadeAcademica extends Model
{   
    protected $table = 'unidade_academicas';

    protected $fillable = ['nome', 'instituicao_id'];

    public static $rules = [

    ];

    public static $messages = [

    ];

    public static function queryToStringIds($values) {
        
        $str = '(';
        
        foreach($values as $value)
            $str = $str.$value->id.',';
        
        $virgula_final = (strlen($str)-1);
        $str[$virgula_final] = ')';

        return $str;
    }

    public static function queryToArrayIds($values) {
        
        $array = [];

        foreach($values as $value)
            array_push($array, $value->id);
        
        return $array;
    }

    public function cursos(){
        return $this->hasMany('SimuladoENADE\Curso', 'unidade_id');
    }
}
