<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\UnidadeAcademicaValidator;
use SimuladoENADE\Validator\ValidationException;
use Illuminate\Support\Facades\DB;

class UnidadeAcademicaController extends Controller
{
    public function listar() {
        
        $auth = \Auth::guard('instituicao')->user();

        $unidades = \SimuladoENADE\UnidadeAcademica::where('instituicao_id', $auth->id)->get();

        dd($unidades);
        // return view('/path/nomeView', ['unidades' => $unidades]);
    }

    public function cadastrar() {
        dd('View Cadastro');
        // return view('/path/nomeView');
    }

    public function adicionar(Request $request) {
        try{
            $auth = \Auth::guard('instituicao')->user();

            UnidadeAcademicaValidator::Validate($request->all());

            $unidade = new \SimuladoENADE\UnidadeAcademica();
            $unidade->fill($request->all());
            $unidade->instituicao_id = $auth_id;
            $unidade->save();

            return redirect('/cadastrar/unidade');
        }catch(ValidatorException $ex){
            redirect('/cadastrar/unidade')->withErrors($ex->getValidator())->withInput();
        }
    }

    public function editar(Request $request) {
        $unidade = \SimuladoENADE\UnidadeAcademica::find($request->id);
        // return view('/path/nomeView', ['unidade' => $unidade]);
    }

    public function atualizar(Request $request) {
        try{
            $auth = \Auth::guard('instituicao')->user();

            UnidadeAcademicaValidator::Validate($request->all());

            $unidade = \SimuladoENADE\UnidadeAcademica::find($request->id);
            $unidade->fill($request->all());
            $unidade->instituicao_id = $auth_id;
            $unidade->update();

            return redirect('/listar/unidade');
        }catch(ValidatorException $ex){
            redirect('/editar/unidade')->withErrors($ex->getValidator())->withInput();
        }
    }

    public function remover(Request $request) {
        $unidade = \SimuladoENADE\UnidadeAcademica::find($request->id);
        $unidade->delete();
        return redirect('/listar/unidade');
    }
}
