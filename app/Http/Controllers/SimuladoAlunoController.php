<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;

class SimuladoAlunoController extends Controller
{
    //

    public function adicionar(Request $request){
    	$simuladoAluno = new \SimuladoENADE\SimuladoAluno();
    	$simuladoAluno->aluno_id = $request->aluno_id;
    	$simuladoAluno->simulado_id = $request->simulado_id;
    	$simuladoAluno->save();
    	return redirect('/listar/simuladoaluno');
    }

    public function cadastrar(){
    	$alunos = \SimuladoENADE\Aluno::all();
    	$simulados = \SimuladoENADE\Simulado::all();
    	return view('/SimuladoAlunoView/cadastrarSimuladoAluno', ['alunos' => $alunos, 'simulados' => $simulados]);
    }
    
    public function listar(){
    	$simuladoAlunos = \SimuladoENADE\SimuladoAluno::all();
    	return view('/SimuladoAlunoView/listaSimuladoAluno', ['simuladoAlunos' => $simuladoAlunos]);
    }

    public function editar(Request $request){
    	$simuladoAluno = \SimuladoENADE\SimuladoAluno::find($request->id);
    	$alunos = \SimuladoENADE\Aluno::all();
    	$simulados = \SimuladoENADE\Simulado::all();

    	return view('/SimuladoAlunoView/editarSimuladoAluno',['simuladoAluno'=> $simuladoAluno, 'alunos'=> $alunos, 'simulados' => $simulados ]);

    }

    public function atualizar(Request $request){
    	$simuladoAluno = \SimuladoENADE\SimuladoAluno::find($request->id);
		$simuladoAluno->aluno_id = $request->aluno_id;
		$simuladoAluno->simulado_id = $request->simulado_id;
		$simuladoAluno->update();
		return redirect("/listar/simuladoaluno");
    }


    public function remover(Request $request){
 	$simuladoAluno = \SimuladoENADE\SimuladoAluno::find($request->id);
 	$simuladoAluno->delete();
 	return redirect("/listar/simuladoaluno");
 		
 	}


}
