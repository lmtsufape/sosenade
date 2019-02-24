<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimuladoENADE\Validator\QuestaoValidator;
use SimuladoENADE\Validator\ValidationException;

class QuestaoController extends Controller
{
    public function adicionar(Request $request){
        
        // Esse código serve para salvar as imagens na pasta public/uploads, porem
        // a imagem vai pra questão mesmo sem salvar no server. Vou deixar comentado,
        // para caso de algum erro com isso.

        // $this->validate($request, [
        //     'enunciado' => 'required',
        // ]);

        // $enunciado = $request->input('enunciado');
        // $dom = new \DomDocument();
        // $dom->loadHtml($enunciado, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        // $images = $dom->getElementsByTagName('img');

        // foreach($images as $k => $img){
        //     $data = $img->getAttribute('src');
        //     list($type, $data) = explode(';', $data);
        //     list(, $data)      = explode(',', $data);
        //     $data = base64_decode($data);
        //     $image_name= "/upload/" . time().$k.'.png';
        //     $path = public_path() . $image_name;
        //     file_put_contents($path, $data);
        //     $img->removeAttribute('src');
        //     $img->setAttribute('src', $image_name);
        // }
        // $enunciado = $dom->saveHTML();

        try{
            QuestaoValidator::Validate($request->all()); 
            
            $alternativas = $request->input('alternativa');

            $questao = new \SimuladoENADE\Questao();
            $questao->enunciado = $request->input('enunciado');
            $questao->alternativa_correta = $request->input('alternativa_correta');
            $questao->dificuldade = $request->input('dificuldade');
            $questao->disciplina_id = $request->input('disciplina_id');

            $questao->alternativa_a = $alternativas[0];
            $questao->alternativa_b = $alternativas[1];

            $questao->alternativa_c = $alternativas[2] ?? "";
            $questao->alternativa_d = $alternativas[3] ?? "";
            $questao->alternativa_e = $alternativas[4] ?? "";

            $questao->save();

            return redirect("listar/questao");

        } catch(ValidationException $ex){
            return redirect("cadastrar/questao")->withErrors($ex->getValidator())->withInput();
        }
    }

    public function cadastrar(){
    	$disciplinas = \SimuladoENADE\Disciplina::all(); 
        return view('/QuestaoView/cadastrarQuestao', ['disciplinas' => $disciplinas]); 
    }
    
    public function listar(){
        
    	$user =  \Auth::user();
        $questao = \SimuladoENADE\Questao::whereIn('disciplina_id', function($query) use ($user){
               $query->select('disciplina_id')->from('disciplinas')->where('disciplinas.curso_id','=',$user->curso_id);
            })->get();

        return view('/QuestaoView/listaQuestao', ['questaos' => $questao]);
    }

    public function editar(Request $request){
        $questao = \SimuladoENADE\Questao::find($request->id);
        $disciplinas = \SimuladoENADE\Disciplina::all();
        return view('/QuestaoView/editarQuestaos', ['questao' => $questao], ['disciplinas'=>$disciplinas]);
    }

    public function atualizar(Request $request){
        try{
            QuestaoValidator::Validate($request->all()); 
            
            $alternativas = $request->input('alternativa');

            $questao = \SimuladoENADE\Questao::find($request->id);
            $questao->enunciado = $request->input('enunciado');
            $questao->alternativa_correta = $request->input('alternativa_correta');
            $questao->dificuldade = $request->input('dificuldade');
            $questao->disciplina_id = $request->input('disciplina_id');

            $questao->alternativa_a = $alternativas[0];
            $questao->alternativa_b = $alternativas[1];

            $questao->alternativa_c = $alternativas[2] ?? "";
            $questao->alternativa_d = $alternativas[3] ?? "";
            $questao->alternativa_e = $alternativas[4] ?? "";

            $questao->update();

            return redirect("listar/questao");

        } catch(ValidationException $ex){
            return redirect("editar/questao")->withErrors($ex->getValidator())->withInput();
        }

    }

    public function remover(Request $request){
        $questao = \SimuladoENADE\Questao::find($request->id);
        $questao->delete();
        return redirect('\listar\questao');
    }
    
    public function filtro_disciplina_dificuldade(Request $request){
        $questaos = \SimuladoENADE\Questao::where([['dificuldade', '=', $request->dificuldade],
                                         ['disciplina_id', '=', $request->disciplina_id]])
                                        ->get()->toArray();
        var_dump($questaos);
        exit();

        return json_encode($questaos);
    }

       public function filtro_curso_questao(Request $request){
        $questaos = \SimuladoENADE\Questao::where([['curso_id', '=', $request->curso_id]])
                                        ->get()->toArray();
        var_dump($questaos);
        exit();

        return json_encode($questaos);
    }

}
