<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\CicloValidator;
use SimuladoENADE\Validator\ValidationException;


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
        	return redirect("listar/ciclo");
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
        	return redirect("listar/ciclo");
    	}
    	catch(ValidationException $ex){
        	return redirect("editar/ciclo")->withErrors($ex->getValidator())->withInput();
    	}
	}

	public function remover(Request $request){
		$ciclo = \SimuladoENADE\Ciclo::find($request->id);
		$ciclo->delete();
		return redirect("listar\ciclo");
	}

}
