<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function home() {
        
        $user = \Auth::guard('instituicao')->user();

        return view('home', ['nome'=>$user['nome'], 'tipo'=>'Instituição']);
    }
}
