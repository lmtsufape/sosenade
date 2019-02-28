<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\CursoValidator;
use SimuladoENADE\Validator\ValidationException;

class Cursocontroller extends Controller
{
    //
    
    public function adicionar (Request $request) {
    	try{
            CursoValidator::Validate($request->all());

            $curso = new \SimuladoENADE\Curso();
            $curso->fill($request->all());
            $curso->save();
            return redirect("listar/curso");
        }
        catch(ValidationException $ex){
            return redirect("cadastrar/curso")->withErrors($ex->getValidator())->withInput();
        }
    }

	 public function cadastrar() {
    	$ciclos = \SimuladoENADE\Ciclo::all();
        $unidadeAcademicas = \SimuladoENADE\UnidadeAcademica::all();
        return view('/CursoView/cadastrarCursos', ['ciclos' => $ciclos, 'unidade_academicas' => $unidadeAcademicas]);
    }

	public function listar(){
		$cursos = \SimuladoENADE\Curso::all();
		return view('/CursoView/listaCursos', ['cursos' => $cursos]);

 	}
 	public function editar(Request $request){ 	
        $ciclos = \SimuladoENADE\Ciclo::all();
        $unidadeAcademicas = \SimuladoENADE\UnidadeAcademica::all();
 		$curso = \SimuladoENADE\Curso::find($request->id);
 		return view('/CursoView/editarCursos', ['ciclos' => $ciclos,'unidade_academicas' => $unidadeAcademicas,'curso' => $curso, ]);
 	}	
    
    public function atualizar(Request $request) {

        try{
            CursoValidator::Validate($request->all());

            $curso = \SimuladoENADE\Curso::find($request->id);
            $curso->fill($request->all());
            $curso->update();
            return redirect("listar/curso");
        }
        catch(ValidationException $ex){
            return redirect("editar/curso")->withErrors($ex->getValidator())->withInput();
        }
    }	
    
    public function remover(Request $request){
    	$curso = \SimuladoENADE\Curso::find($request->id);
    	$curso->delete();
    	return redirect("/listar/curso");
    }
    
    	
}
