<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\UnidadeAcademicaValidator;
use SimuladoENADE\Validator\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class UnidadeAcademicaController extends Controller
{
    public function listar() {
        
        $auth = \Auth::guard('instituicao')->user();

        $unidades = \SimuladoENADE\UnidadeAcademica::where('instituicao_id', $auth->id)->get();

        return view('/UnidadeView/listarUnidade', ['unidades' => $unidades, 'instituicao' => $auth]);
    }

    public function cadastrar() {
        return view('/UnidadeView/cadastrarUnidade');
    }

    public function adicionar(Request $request) {
        try{
            $auth = \Auth::guard('instituicao')->user();

            UnidadeAcademicaValidator::Validate($request->all());

            $unidade = new \SimuladoENADE\UnidadeAcademica();
            $unidade->nome = strtoupper($request->nome);
            $unidade->instituicao_id = $auth->id;
            $unidade->save();

            return redirect('listar/unidade')->with('success', \SimuladoENADE\FlashMessage::cadastroSuccess());
        }catch(ValidatorException $ex){
            redirect('cadastrar/unidade')->withErrors($ex->getValidator())->withInput();
        }
    }

    public function editar(Request $request) {
        $unidade = \SimuladoENADE\UnidadeAcademica::find($request->id);
        return view('/UnidadeView/editarUnidade', ['unidade' => $unidade]);
    }

    public function atualizar(Request $request) {
        try{
            $auth = \Auth::guard('instituicao')->user();

            UnidadeAcademicaValidator::Validate($request->all());

            $unidade = \SimuladoENADE\UnidadeAcademica::find($request->id);
            $unidade->nome = strtoupper($request->nome);
            $unidade->instituicao_id = $auth->id;
            $unidade->update();

            return redirect('listar/unidade')->with('success', \SimuladoENADE\FlashMessage::alteracoesSuccess());
        }catch(ValidatorException $ex){
            redirect('editar/unidade')->withErrors($ex->getValidator())->withInput();
        }
    }

    public function remover(Request $request) {
        
        $unidade = \SimuladoENADE\UnidadeAcademica::find($request->id);
        $unidade_nome = $unidade->nome;

        try {
            $unidade->delete();
            return redirect('/listar/unidade')->with('success', \SimuladoENADE\FlashMessage::removeUnidadeSuccess($unidade_nome));
        } catch(QueryException $ex) {
            return redirect('/listar/unidade')->with('fail', \SimuladoENADE\FlashMessage::removeUnidadeFail($unidade_nome));
        }
    }
}
