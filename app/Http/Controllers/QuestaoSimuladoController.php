<?php

namespace SimuladoENADE\Http\Controllers;

use SimuladoENADE\Validator\MontarSimuladoValidator;
use SimuladoENADE\Validator\ValidationException;
use Illuminate\Http\Request;

class QuestaoSimuladoController extends Controller{

    // Exibe as questões relacionadas ao simulado
    public function montar(Request $request){

        $curso = \Auth::user()->curso_id;
        $simulado = \SimuladoENADE\Simulado::all();
     
        $disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', $curso)->get();

        $questaos = \DB::table('questao_simulados')
            ->join('questaos', 'questao_simulados.questao_id', '=', 'questaos.id')
            ->join('disciplinas', 'questaos.disciplina_id', '=', 'disciplinas.id')
            ->select('questaos.*', 'questao_simulados.*', 'disciplinas.nome as disc_nome')
            ->where('simulado_id', '=', $request->id)
            ->get();

        

        return view('/SimuladoView/montarSimulado',['disciplinas' => $disciplinas, 'questaos' => $questaos, 'simulado_id'=> $request->id]);     
     
    }

    // Relaciona questões (seguindo o filtro) ao simulado
    public function cadastrarQuestao(Request $request){

        try{
            
            $questaos = \SimuladoENADE\Questao::where([['dificuldade', '=', $request->dificuldade],
                                             ['disciplina_id', '=', $request->disciplina_id]])
                                            ->get()
                                            ->toArray();
           
            $num_questao = \SimuladoENADE\QuestaoSimulado::where('simulado_id', '=', $request->simulado_id)->get();

            $cont = count($num_questao);

            MontarSimuladoValidator::Validate(count($questaos), $request->numero);            

            if(($cont + $request->numero) > 30)
                return redirect()->route('list_disciplina');

            shuffle($questaos); 
            $row = [];

            # Cria as relações entre as qsts e o simulado
            for($i = 0; $i < $request->numero; $i++){
                $row = $questaos[$i];
                $questao = new \SimuladoENADE\QuestaoSimulado();
                $questao->questao_id = $row['id'];
                $questao->simulado_id = $request->simulado_id;
                $questao->save();
            }

            return redirect()->route('set_simulado', ['id' => $request->simulado_id]);

        }catch(ValidationException $ex){
            return redirect()->route('set_simulado', ['id' => $request->simulado_id])->withErrors($ex->getValidator())->withInput();
        }

    }

    // Remove uma relação de qst e simulado retirando a qst do mesmo
    public function removerQuestao(Request $request){

        $questaoSimulado = \SimuladoENADE\QuestaoSimulado::find($request->sim_qst_id);
        $simulado_id = $questaoSimulado->simulado_id;
        $questaoSimulado->delete();
        return redirect()->route('set_simulado', ['id' => $simulado_id]);

    }

}
