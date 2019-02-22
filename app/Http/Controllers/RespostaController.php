<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;

class RespostaController extends Controller
{
    //
     public function adicionar(Request $request){
    	$resposta = new \SimuladoENADE\Resposta();
    	$resposta->questao_id = $request->questao_id;
    	$resposta->aluno_id = $request->aluno_id;
    	$resposta->alternativa_questao =$request->alternativa_questao;
    	$resposta->save();
    	return redirect('/listar/resposta');
    }

    public function cadastrar(){
    	$alunos = \SimuladoENADE\Aluno::all();
    	$questaos = \SimuladoENADE\Questao::all();
    	return view('/RespostaView/cadastrarResposta', ['alunos' => $alunos, 'questaos' => $questaos]);
    }

    public function listar(){
    	$respostas = \SimuladoENADE\Resposta::all();
    	return view ('/RespostaViewlistaResposta',['respostas' => $respostas]);
    }

    

    public function editar(Request $request){
    	$resposta = \SimuladoENADE\Resposta::find($request->id);
    	$alunos = \SimuladoENADE\Aluno::all();
    	$questaos = \SimuladoENADE\Questao::all();

    	return view('/RespostaView/editarResposta',['resposta'=> $resposta, 'alunos'=> $alunos, 'questaos' => $questaos ]);

    }

    public function atualizar(Request $request){
    	$resposta = \SimuladoENADE\Resposta::find($request->id);
		$resposta->aluno_id = $request->aluno_id;
		$resposta->questao_id = $request->questao_id;
		$resposta->alternativa_questao = $request->alternativa_questao;
		$resposta->update();
		return redirect("/listar/resposta");
    }

    public function remover(Request $request){
 	$resposta = \SimuladoENADE\Resposta::find($request->id);
 	$resposta->delete();
 	return redirect("/listar/resposta");
 		
 	}
}
