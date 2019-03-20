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

        $curso_id = \Auth::user()->curso_id;
        $nome_curso = \SimuladoENADE\Curso::find($curso_id)->curso_nome;

    	$cursos = \SimuladoENADE\Curso::all();
    	return view('/DisciplinaView/cadastrarDisciplinas', ['cursos' => $cursos, 'nome_curso' => $nome_curso]);
        
    }
    	
    
 	public function listar(){

        $curso_user = \Auth::user()->curso_id;
		$nome_curso = \SimuladoENADE\Curso::find($curso_user)->curso_nome;
        $disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', $curso_user)->orderBy('nome')->get();

		return view('/DisciplinaView/listaDisciplinas', ['disciplinas' => $disciplinas, 'nome_curso' => $nome_curso]);

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
