<?php

namespace SimuladoENADE\Http\Controllers;

use SimuladoENADE\Validator\MontarSimuladoDiscursivoValidator;
use SimuladoENADE\Validator\ValidationException;
use Illuminate\Http\Request;

class QuestaoDiscursivaSimuladoController extends Controller
{      
    // Relaciona questões (seguindo o filtro) ao simulado
    public function cadastrarQuestao(Request $request){

        $bool_simulado_montagem_automatica_discursiva = boolval($request->bool_simulado_montagem_automatica_discursiva);

        try {
            $questoes_discursivas = \SimuladoENADE\QuestaoDiscursiva::where([['dificuldade', '=', $request->dificuldade],
                                             ['disciplina_id', '=', $request->disciplina_id]])
                                            ->get()
                                            ->toArray();

            
            $countQuestao = count($questoes_discursivas);
            $num_questao = \SimuladoENADE\QuestaoDiscursivaSimulado::where('simulado_id', '=', $request->simulado_id)->get();
            $cont = count($num_questao);
            $vetor = [];

            // Add questões novas ao simulado e ignora as já adicionadas
            for ($i=0; $i < $countQuestao; $i++) { 
                $f = False;
                for ($j=0; $j < $cont ; $j++) { 
            
                    if($questoes_discursivas[$i]['id'] == $num_questao[$j]->questao_discursiva_id){
                        $f = True;
                    }
                }
                if($f == False){
                    $vetor[] = $questoes_discursivas[$i];    
                }
            }
            
            MontarSimuladoDiscursivoValidator::Validate(count($vetor), $request->numero);
            $vetor_size = count($vetor);

            shuffle($vetor); 
            $row = [];

            # Cria as relações entre as qsts e o simulado
            for($i = 0; $i < $request->numero; $i++){
                $row = $vetor[$i];
                $questao = new \SimuladoENADE\QuestaoDiscursivaSimulado();
                $questao->questao_discursiva_id = $row['id'];
                $questao->simulado_id = $request->simulado_id;
                $questao->save();
            }

            return redirect()->route('set_simulado', ['id' => $request->simulado_id]);

        } catch(ValidationException $ex) {
            return redirect()->route('set_simulado', ['id' => $request->simulado_id])->withErrors($ex->getValidator())->withInput();
        }
    }

    // Relaciona questões (seguindo questoes escolhidas)
    public function cadastrarQuestaoManualmente(Request $request){
        
        $bool_simulado_montagem_automatica_objetiva = boolval($request->bool_simulado_montagem_automatica_objetiva);
        $bool_simulado_montagem_automatica_discursiva = boolval($request->bool_simulado_montagem_automatica_discursiva);

        try {

            $questoes_discursivas = \SimuladoENADE\QuestaoDiscursiva::where([['dificuldade', '=', $request->dificuldade],
                                             ['disciplina_id', '=', $request->disciplina_id]])
                                            ->get()
                                            ->toArray();

            $count_questao = count($questoes_discursivas);
            $num_questao = \SimuladoENADE\QuestaoDiscursivaSimulado::where('simulado_id', '=', $request->simulado_id)->get();
            $count_simulado_questao = count($num_questao);
            $ids = [];

            // Filtra as questoes ainda nao add no simulado e retorna um array de ids
            for ($i=0; $i < $count_questao; $i++) { 
                $f = False;
                for ($j=0; $j < $count_simulado_questao; $j++) { 

                    if($questoes_discursivas[$i]['id'] == $num_questao[$j]->questao_discursiva_id) {
                        $f = True;
                    }
                    
                }
                if($f == False){
                    $ids[] = $questoes_discursivas[$i]['id'];    
                }
            }

            $curso = \Auth::user()->curso_id;
            $simulado = \SimuladoENADE\Simulado::find($request->simulado_id);
            $disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', $curso)->orderBy('nome')->get();
            $questoes_discursivas = \SimuladoENADE\QuestaoDiscursivaSimulado::where('simulado_id', '=', $simulado->id)->get();
            $questoes_discursivas_externas_simulado = \SimuladoENADE\QuestaoDiscursiva::whereIn('id', $ids)->get();

            $questaos = \SimuladoENADE\QuestaoSimulado::where('simulado_id', '=', $simulado->id)->get();
            $questoes_externas_simulado = collect();

            return view('/SimuladoView/montarSimulado', ['disciplinas' => $disciplinas, 'questaos' => $questaos, 'questoes_discursivas' => $questoes_discursivas, 'questoes_externas_simulado' => $questoes_externas_simulado ,'questoes_discursivas_externas_simulado' => $questoes_discursivas_externas_simulado, 'simulado_id' => $request->simulado_id, 'titulo_simulado' => $simulado->descricao_simulado, 
                                                         'bool_simulado_montagem_automatica_objetiva' => $bool_simulado_montagem_automatica_objetiva, 'bool_simulado_montagem_automatica_discursiva' => $bool_simulado_montagem_automatica_discursiva]);

        } catch(ValidationException $ex) {
            return redirect()->route('set_simulado', ['id' => $request->simulado_id])->withErrors($ex->getValidator())->withInput();
        }
        
    }

    public function addQuestaoAsync(Request $request) {

        $questao = new \SimuladoENADE\QuestaoDiscursivaSimulado();
        $questao->questao_discursiva_id = $request->questao_id;
        $questao->simulado_id = $request->simulado_id;

        $bool_add = ($questao->save() == true ? 'true' : 'false');

        return $bool_add;

    }

    public function removeQuestaoAsync(Request $request) {
        
        $questao = \SimuladoENADE\QuestaoDiscursivaSimulado::where('questao_discursiva_id', $request->questao_id)->where('simulado_id', $request->simulado_id);

        if($questao) {
            $bool_remove = ($questao->delete() == true ? 'true' : 'false');
        } else {
            $bool_remove = 'false';
        }

        return $bool_remove;
    }
    
}
