<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\UnidadeAcademicaValidator;
use SimuladoENADE\Validator\ValidationException;

class UnidadeAcademicaController extends Controller
{
    public function listar() {
        dd(['list'=>'Listar Unidades']);
    }

    public function cadastrar() {
        dd(['new'=>'Cadastrar Unidade']);
    }

    public function adicionar(Request $request) {

    }

    public function editar(Request $request) {

    }

    public function atualizar(Request $request) {

    }

    public function remover(Request $request) {

    }
}
