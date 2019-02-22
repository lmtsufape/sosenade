<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\AlunoValidator;
use Illuminate\Support\Facades\Hash;
use SimuladoENADE\Validator\ValidationException;

class AlunoController extends Controller
{
	public function adicionar(Request $request){
		try{

            $curso_id = \Auth::user()->curso_id;
        	AlunoValidator::Validate($request->all());

        	$aluno = new \SimuladoENADE\Aluno();
        	$aluno->fill($request->all());
            $aluno->curso_id = $curso_id;
        	$aluno->password = Hash::make($request->password);
        	$aluno->save();
        	return redirect("listar/aluno");
    	}
    	catch(ValidationException $ex){
        	return redirect("cadastrar/aluno")->withErrors($ex->getValidator())->withInput();
    	}

	}

	public function cadastrar(){
		$cursos = \SimuladoENADE\Curso::all();
		$alunos = \SimuladoENADE\Aluno::all();
		return view('/AlunoView/cadastrarAluno',['cursos' => $cursos], ['alunos' => $alunos]);
	}

	public function listar (){
		$alunos = \SimuladoENADE\Aluno::all();
		return view('/AlunoView/listaAluno',['alunos'=> $alunos]);

	}
	public function editar(Request $request){
		$aluno = \SimuladoENADE\Aluno::find($request->id);
		$curso = \SimuladoENADE\Curso::all();
		return view('/AlunoView/editarAluno', ['aluno' => $aluno], ['cursos' => $curso]);

	}

	public function atualizar(Request $request){
		try{
        	AlunoValidator::Validate($request->all());
        	$aluno = \SimuladoENADE\Aluno::find($request->id);    
        	$aluno->fill($request->all());
        	$aluno->update();
        	return redirect("listar/aluno");
    	}
    	catch(ValidationException $ex){
        	return redirect("editar/aluno/".$request->id)->withErrors($ex->getValidator())->withInput();
    	}
	}

	    public function remover(Request $request){
        $aluno = \SimuladoENADE\Aluno::find($request->id);
        $aluno->delete();
        return redirect('\listar\aluno');
    }
}
