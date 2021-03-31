<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use SimuladoENADE\Validator\InstituicaoValidator;
use SimuladoENADE\Validator\ValidationException;

class InstituicaoController extends Controller
{
    public function home() {
        
        $user = \Auth::guard('instituicao')->user();

        return view('home', ['nome'=>$user['nome'], 'tipo'=>'Instituição']);
    }

    public function listar() {
        $instituicoes = \SimuladoENADE\Instituicao::all();

        return view('InstituicaoView\listarInstituicoes', ['instituicoes' => $instituicoes]);
    }

    public function cadastrar() {
        return view('InstituicaoView/cadastrarInstituicoes');
    }

    public function adicionar(Request $request) {
        try{
            InstituicaoValidator::Validate($request->all());

            $instituicao = new \SimuladoENADE\Instituicao();
            $instituicao->tipousuario_id = 4;
            $instituicao->fill($request->all());
            $instituicao->password = Hash::make($request->password);
            $instituicao->save();
            return redirect("/listar/instituicao");
        }
        catch(ValidationException $ex){
            return redirect("cadastrar/instituicao")->withErrors($ex->getValidator())->withInput();
        }
    }

    public function editar(Request $request) {
        $instituicao = \SimuladoENADE\Instituicao::find($request->id);
        return view('InstituicaoView/editarInstituicoes', ['instituicao' => $instituicao]);
    }

    public function atualizar(Request $request) {
        try{

            $instituicao = \SimuladoENADE\Instituicao::find($request->id);

            $data = $request->all();
            $data['tipousuario_id'] = 4;
            $data['password'] = $instituicao->password;
            $data['password_confirmation'] = $instituicao->password;
            
            InstituicaoValidator::Validate($data);

            $instituicao->fill($data);
            $instituicao->update();

            return redirect("/listar/instituicao");
        }
        catch(ValidationException $ex){
            return redirect("editar/instituicao")->withErrors($ex->getValidator())->withInput();
        }
    }

    public function remover(Request $request) {
        $instituicao = \SimuladoENADE\Instituicao::find($request->id);
        $instituicao->delete();
        return redirect("/listar/instituicao");
    }
}
