<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\CursoValidator;
use SimuladoENADE\Validator\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class Cursocontroller extends Controller
{
    
    public function adicionar (Request $request) {
    	try{
            CursoValidator::Validate($request->all());

            $curso = new \SimuladoENADE\Curso();
            $curso->fill($request->all());
            $curso->save();
            return redirect("listar/curso")->with('success', 'Cadastro realizado com sucesso!');;;
        }
        catch(ValidationException $ex){
            return redirect("cadastrar/curso")->withErrors($ex->getValidator())->withInput();
        }
    }

	public function cadastrar() {

        $auth = \Auth::guard('instituicao')->user();
        $ciclos = \SimuladoENADE\Ciclo::where('instituicao_id', $auth->id)->get();
        $unidadeAcademicas = \SimuladoENADE\UnidadeAcademica::where('instituicao_id', $auth->id)->get();

        return view('/CursoView/cadastrarCursos', ['ciclos' => $ciclos, 'unidade_academicas' => $unidadeAcademicas]);
    }

	public function listar(){

        $auth = \Auth::guard('instituicao')->user();

        $unidades_ids = \SimuladoENADE\UnidadeAcademica::queryToArrayIds( \SimuladoENADE\UnidadeAcademica::where('instituicao_id', $auth->id)->get() );

		$cursos =\SimuladoENADE\Curso::select('*', \DB::raw('cursos.id as curso_id'))
            ->whereIn('unidade_id', $unidades_ids)
            ->join('ciclos', 'cursos.ciclo_id', '=', 'ciclos.id')
            ->orderBy('curso_nome')
            ->get();

		return view('/CursoView/listaCursos', ['cursos' => $cursos]);

 	}
     
 	public function editar(Request $request){ 	
        
        $auth = \Auth::guard('instituicao')->user();

        $curso = \SimuladoENADE\Curso::find($request->id);
        $ciclos = \SimuladoENADE\Ciclo::where('instituicao_id', $auth->id)->get();
        $unidadeAcademicas = \SimuladoENADE\UnidadeAcademica::where('instituicao_id', $auth->id)->get();

 		return view('/CursoView/editarCursos', ['ciclos' => $ciclos,'unidade_academicas' => $unidadeAcademicas,'curso' => $curso, ]);
 	}	
    
    public function atualizar(Request $request) {

        try{
            CursoValidator::Validate($request->all());

            $curso = \SimuladoENADE\Curso::find($request->id);
            $curso->fill($request->all());
            $curso->update();
            return redirect("listar/curso")->with('success', 'As alterações foram salvas!');;
        }
        catch(ValidationException $ex){
            return redirect("editar/curso")->withErrors($ex->getValidator())->withInput();
        }
    }	
    
    public function remover(Request $request){
    	$curso = \SimuladoENADE\Curso::find($request->id);
        $curso_nome = $curso->curso_nome;

        try {
            $curso->delete();
    	    return redirect("/listar/curso")->with('success', 'O curso '.$curso_nome.' foi removido com sucesso!');;
        } catch(QueryException $ex) {
            return redirect("/listar/curso")->with('fail', 'O curso '.$curso_nome.' não pode ser removido!');;
        }

    }
    
}
