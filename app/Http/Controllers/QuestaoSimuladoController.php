<?php

namespace SimuladoENADE\Http\Controllers;

use SimuladoENADE\Validator\MontarSimuladoValidator;
use SimuladoENADE\Validator\ValidationException;
use Illuminate\Http\Request;

class QuestaoSimuladoController extends Controller{

    // Exibe as questões relacionadas ao simulado
    public function montar(Request $request){
        $curso = \Auth::user()->curso_id;
        $simulado = \SimuladoENADE\Simulado::find($request->id);
        $disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', $curso)->orderBy('nome')->get();

        $questaos = \SimuladoENADE\QuestaoSimulado::where('simulado_id', '=', $request->id)->get();
        $questoes_externas_simulado = collect();
        $bool_simulado_montagem_automatica_objetiva = true;


        $questoes_discursivas = \SimuladoENADE\QuestaoDiscursivaSimulado::where('simulado_id', '=', $request->id)->get();
        $questoes_discursivas_externas_simulado = collect();
        $bool_simulado_montagem_automatica_discursiva = true;
        

        return view('/SimuladoView/montarSimulado', ['disciplinas' => $disciplinas, 'questaos' => $questaos, 'questoes_discursivas' => $questoes_discursivas, 'questoes_externas_simulado' => $questoes_externas_simulado, 'questoes_discursivas_externas_simulado' => $questoes_discursivas_externas_simulado, 'simulado_id'=> $request->id, 'titulo_simulado' => $simulado->descricao_simulado, 'bool_simulado_montagem_automatica_objetiva' => $bool_simulado_montagem_automatica_objetiva, 'bool_simulado_montagem_automatica_discursiva' => $bool_simulado_montagem_automatica_discursiva]);
    }

    // Relaciona questões (seguindo o filtro) ao simulado : Automatico
    public function cadastrarQuestao(Request $request) {

        try{
            $questaos = \SimuladoENADE\Questao::where([['dificuldade', '=', $request->dificuldade],
                                             ['disciplina_id', '=', $request->disciplina_id]])
                                            ->get()
                                            ->toArray();

            $countQuestao = count($questaos);
            $num_questao = \SimuladoENADE\QuestaoSimulado::where('simulado_id', '=', $request->simulado_id)->get();
            $cont = count($num_questao);
            $vetor = [];

            // Add questões novas ao simulado e ignora as já adicionadas
            for ($i=0; $i < $countQuestao; $i++) { 
                $f = False;
                for ($j=0; $j < $cont ; $j++) { 
                     // dd($questaos[$i]['id']);
            
                    if($questaos[$i]['id'] == $num_questao[$j]->questao_id){
                        $f = True;
                    }
                }
                if($f == False){
                    $vetor[] = $questaos[$i];    
                }
            }
            
            MontarSimuladoValidator::Validate(count($vetor), $request->numero);
            $vetor_size = count($vetor);

            shuffle($vetor); 
            $row = [];

            # Cria as relações entre as qsts e o simulado
            for($i = 0; $i < $request->numero; $i++){
                $row = $vetor[$i];
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

    // Relaciona questões (seguindo o filtro) ao simulado : Manual
    public function cadastrarQuestaoManualmente(Request $request) {

        $bool_simulado_montagem_automatica_objetiva = boolval($request->bool_simulado_montagem_automatica_objetiva);
        $bool_simulado_montagem_automatica_discursiva = boolval($request->bool_simulado_montagem_automatica_discursiva);

        try {

            $questaos = \SimuladoENADE\Questao::where([['dificuldade', '=', $request->dificuldade],
                                             ['disciplina_id', '=', $request->disciplina_id]])
                                            ->get()
                                            ->toArray();

            $count_questao = count($questaos);
            $num_questao = \SimuladoENADE\QuestaoSimulado::where('simulado_id', '=', $request->simulado_id)->get();
            $count_simulado_questao = count($num_questao);
            $ids = [];

            // Filtra as questoes ainda nao add no introduzidas no simulado e retorna um array de ids
            for ($i=0; $i < $count_questao; $i++) { 
                $f = False;
                for ($j=0; $j < $count_simulado_questao; $j++) { 

                    if($questaos[$i]['id'] == $num_questao[$j]->questao_id){
                        $f = True;
                    }
                    
                }
                if($f == False){
                    $ids[] = $questaos[$i]['id'];    
                }
            }

            $curso = \Auth::user()->curso_id;
            $simulado = \SimuladoENADE\Simulado::find($request->simulado_id);
            $disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', $curso)->orderBy('nome')->get();
            $questaos = \SimuladoENADE\QuestaoSimulado::where('simulado_id', '=', $simulado->id)->get();
            $questoes_externas_simulado = \SimuladoENADE\Questao::whereIn('id', $ids)->get();

            $questoes_discursivas = \SimuladoENADE\QuestaoDiscursivaSimulado::where('simulado_id', '=', $simulado->id)->get();
            $questoes_discursivas_externas_simulado = collect();

            return view('/SimuladoView/montarSimulado', ['disciplinas' => $disciplinas, 'questaos' => $questaos, 'questoes_discursivas' => $questoes_discursivas, 'questoes_externas_simulado' => $questoes_externas_simulado, 'questoes_discursivas_externas_simulado' => $questoes_discursivas_externas_simulado, 'simulado_id' => $request->simulado_id, 'titulo_simulado' => $simulado->descricao_simulado, 'bool_simulado_montagem_automatica_objetiva' => $bool_simulado_montagem_automatica_objetiva, 'bool_simulado_montagem_automatica_discursiva' => $bool_simulado_montagem_automatica_discursiva]);

        }catch(ValidationException $ex){
            return redirect()->route('set_simulado', ['id' => $request->simulado_id])->withErrors($ex->getValidator())->withInput();
        }

    }

    public function addQuestaoAsync(Request $request) {

        $questao = new \SimuladoENADE\QuestaoSimulado();
        $questao->questao_id = $request->questao_id;
        $questao->simulado_id = $request->simulado_id;

        $bool_add = ($questao->save() == true ? 'true' : 'false');

        return $bool_add;

    }

    public function removeQuestaoAsync(Request $request) {
        
        $questao = \SimuladoENADE\QuestaoSimulado::where('questao_id', $request->questao_id)->where('simulado_id', $request->simulado_id);

        if($questao) {
            $bool_remove = ($questao->delete() == true ? 'true' : 'false');
        } else {
            $bool_remove = 'false';
        }

        return $bool_remove;
    }

    // Remove uma relação de qst e simulado retirando a qst do mesmo
    public function removerQuestao(Request $request){
        $questaoSimulado = \SimuladoENADE\QuestaoSimulado::find($request->sim_qst_id);
        $simulado_id = $questaoSimulado->simulado_id;
        $questaoSimulado->delete();
        return redirect()->route('set_simulado', ['id' => $simulado_id]);
    }

}
