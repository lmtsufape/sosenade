<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;

class QuestaoSimuladoController extends Controller
{
    //

    public function adicionar(Request $request){
    	$questaoSimulado = new \SimuladoENADE\QuestaoSimulado();
    	$questaoSimulado->questao_id = $request->questao_id;
    	$questaoSimulado->simulado_id  =$request->simulado_id;
    	$questaoSimulado->save();
    	return redirect('listar/questaosimulado');
    }


    public function cadastrar(){
    	$questaos = \SimuladoENADE\Questao::all();
    	$simulados = \SimuladoENADE\Simulado::all();
        

    	return view('/QuestaoSimuladoView/cadastrarQuestaoSimulado', ['questaos' => $questaos, 'simulados' => $simulados]);
    }

     public function listar(){
    	$questaoSimulados = \SimuladoENADE\QuestaoSimulado::all();
    	return view('/QuestaoSimuladoView/listaQuestaoSimulado', ['questaoSimulados' => $questaoSimulados]);
    }

    public function editar(Request $request){
    	$questaoSimulado = \SimuladoENADE\QuestaoSimulado::find($request->id);
    	$alunos = \SimuladoENADE\Aluno::all();
    	$questaos = \SimuladoENADE\Questao::all();

    	return view('/QuestaoSimuladoView/editarQuestaoSimulado',['questaoSimulado'=> $simuladoAluno, 'questaos'=> $questaos, 'simulados' => $simulados ]);

    }

      public function atualizar(Request $request){
    	$questaoSimulado = \SimuladoENADE\QuestaoSimulado::find($request->id);
		$questaoSimulado->aluno_id = $request->aluno_id;
		$simuladoAluno->questao_id = $request->questao_id;
		$simuladoAluno->update();
		return redirect("/listar/questaosimulado");
    }

    public function remover(Request $request){
 	$questaoSimulado = \SimuladoENADE\QuestaoSimulado::find($request->id);
 	$questaoSimulado->delete();
 	return redirect("/listar/questaosimulado");
 		
 	}
}
