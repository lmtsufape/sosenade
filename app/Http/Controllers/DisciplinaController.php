<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimuladoENADE\Validator\DisciplinaValidator;
use SimuladoENADE\Validator\ValidationException;

class DisciplinaController extends Controller
{   

    public function adicionar(Request $request){
        
        try{
            $curso_id = \Auth::user()->curso_id;
            DisciplinaValidator::Validate($request->all());
            $disciplina = new \SimuladoENADE\Disciplina();
            $disciplina->fill($request->all());
            $disciplina->curso_id = $curso_id;
            $disciplina->save();
            return redirect("listar/disciplina");
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
        $user = \Auth::user();
        #dd($user->curso_id);
		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', $user->curso_id)->get();
        $cursos = \SimuladoENADE\Curso::all();
		return view('/DisciplinaView/listaDisciplinas', ['disciplinas' => $disciplinas]);

 	}   
 	
 	public function editar(Request $request){ 		
 		$disciplina = \SimuladoENADE\Disciplina::find($request->id);
 		$cursos = \SimuladoENADE\Curso::all();
 		return view('/DisciplinaView/editarDisciplinas', ['disciplina' => $disciplina], ['cursos' => $cursos]);
 	
 	}

	public function atualizar(Request $request){


        try{
            DisciplinaValidator::Validate($request->all());
            $disciplina = \SimuladoENADE\Disciplina::find($request->id);
            $disciplina->fill($request->all());
            $disciplina->update();
            return redirect("listar/disciplina");
        }
        catch(ValidationException $ex){
            return redirect("editar/disciplina")->withErrors($ex->getValidator())->withInput();

        }
	} 	
 	
 	public function remover(Request $request){
 		$disciplina = \SimuladoENADE\Disciplina::find($request->id);
 		$disciplina->delete();
 		return redirect("/listar/disciplina");
 		
 	}

    public function filtro_curso(Request $request){
        $disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', $request->curso_id)->get();

        return json_encode($disciplinas);
    }
}
