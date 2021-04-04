<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\CicloValidator;
use SimuladoENADE\Validator\ValidationException;
use Illuminate\Database\QueryException;


class Ciclocontroller extends Controller
{
    //
	public function adicionar(Request $request){
    	try{
			$user = \Auth::guard('instituicao')->user();
        	CicloValidator::Validate($request->all());

        	$ciclo = new \SimuladoENADE\Ciclo();
        	$ciclo->fill($request->all());
			$ciclo->instituicao_id = $user->id;
        	$ciclo->save();
        	return redirect("listar/ciclo")->with('success', 'Cadastro realizado com sucesso!');
    	}
    	catch(ValidationException $ex){
        	return redirect("cadastrar/ciclo")->withErrors($ex->getValidator())->withInput();
    	}
    }

	public function cadastrar(){
    	return view('/CicloView/cadastrarCiclo');
	}
	public function listar(){
		$user = \Auth::guard('instituicao')->user();
		$ciclos = \SimuladoENADE\Ciclo::where('instituicao_id', $user->id)->get();
		return view('/CicloView/listaCiclo', ['ciclos' => $ciclos]);
	}
	public function editar(Request $request){
		$ciclos = \SimuladoENADE\Ciclo::find($request->id);
		return view('/CicloView/editarCiclo',['ciclo' =>$ciclos]);
	}
	public function atualizar(Request $request){
		try{
			$user = \Auth::guard('instituicao')->user();
        	CicloValidator::Validate($request->all());

			$ciclo = \SimuladoENADE\Ciclo::find($request->id);
        	$ciclo->fill($request->all());
			$ciclo->instituicao_id = $user->id;
        	$ciclo->update();
        	return redirect("listar/ciclo")->with('success', 'As alterações foram salvas!');;
    	}
    	catch(ValidationException $ex){
        	return redirect("editar/ciclo")->withErrors($ex->getValidator())->withInput();
    	}
	}

	public function remover(Request $request){
		$ciclo = \SimuladoENADE\Ciclo::find($request->id);
		$ciclo_nome = $ciclo->tipo_ciclo;

		try {
			$ciclo->delete();
			return redirect("listar\ciclo")->with('success', 'O ciclo '.$ciclo_nome.' foi removido com sucesso!');
		} catch(QueryException $ex) {
			return redirect("listar\ciclo")->with('fail', 'O ciclo '.$ciclo_nome.' não pode ser removido!');
		}

	}

}
