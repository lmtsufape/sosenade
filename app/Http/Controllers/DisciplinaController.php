<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use SimuladoENADE\Validator\DisciplinaValidator;
use SimuladoENADE\Validator\ValidationException;

class DisciplinaController extends Controller {
	public function adicionar(Request $request){
		try{
			$curso_id = \Auth::user()->curso_id;
			DisciplinaValidator::Validate($request->all());
			$disciplina = new \SimuladoENADE\Disciplina();
			$disciplina->fill($request->all());
			$disciplina->curso_id = $curso_id;
			$disciplina->save();
			return redirect("listar/disciplina")->with('success', \SimuladoENADE\FlashMessage::cadastroSuccess());
		}
		catch(ValidationException $ex){
			return redirect("cadastrar/disciplina")->withErrors($ex->getValidator())->withInput();
		}
	}

	public function cadastrar() {
		$cursos = \SimuladoENADE\Curso::all();
		return view('/DisciplinaView/cadastrarDisciplinas', ['cursos' => $cursos]);
	}
	
	public function listar(){
		$curso_user = \Auth::user()->curso_id;
		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', $curso_user)->orderBy('nome')->orderBy('nome')->get();
		return view('/DisciplinaView/listaDisciplinas', ['disciplinas' => $disciplinas]);
	}   
	
	public function editar(Request $request){ 		
		$disciplina = \SimuladoENADE\Disciplina::find($request->id);
		$cursos = \SimuladoENADE\Curso::all();
		return view('/DisciplinaView/editarDisciplinas', ['disciplina' => $disciplina]);
	}

	public function atualizar(Request $request){
		try{
			DisciplinaValidator::Validate($request->all());
			$disciplina = \SimuladoENADE\Disciplina::find($request->id);
			$disciplina->fill($request->all());

			$curso_id = \Auth::user()->curso_id;
			$disciplina->curso_id = $curso_id;

			$disciplina->update();
			return redirect("listar/disciplina")->with('success', \SimuladoENADE\FlashMessage::alteracoesSuccess());
		}
		catch(ValidationException $ex){
			return redirect("editar/disciplina")->withErrors($ex->getValidator())->withInput();
		}
	} 	
	
	public function remover(Request $request){
		$disciplina = \SimuladoENADE\Disciplina::find($request->id);
		$disciplina_nome = $disciplina->nome;

		try {
			$disciplina->delete();
			return redirect("/listar/disciplina")->with('success', \SimuladoENADE\FlashMessage::removeDisciplinaSuccess($disciplina_nome));
		} catch(QueryException $ex) {
			return redirect("/listar/disciplina")->with('fail', \SimuladoENADE\FlashMessage::removeDisciplinaFail($disciplina_nome));
		}
		
	}
}