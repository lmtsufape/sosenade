<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SimuladoENADE\NotaQuestaoDiscursiva;
use SimuladoENADE\Validator\ValidationException;

use SimuladoENADE\QuestaoDiscursiva;
use SimuladoENADE\RespostaDiscursiva;
use SimuladoENADE\Simulado;
use SimuladoENADE\Validator\QuestaoDiscursivaValidator;

class QuestaoDiscursivaController extends Controller
{
    public function adicionar(Request $request) {
        try {

            QuestaoDiscursivaValidator::validate($request->all());

            $questao = new QuestaoDiscursiva();
            $questao->enunciado = $request->enunciado;
            $questao->dificuldade = $request->dificuldade;
            $questao->disciplina_id = $request->disciplina_id;
            $questao->save();

            return redirect("listar/questao")->with('success', \SimuladoENADE\FlashMessage::cadastroSuccess());
        } catch(ValidationException $ex) {
            return redirect("cadastrar/questao")->withErrors($ex->getValidator())->withInput();
        }
    }

    public function editar(Request $request) {
        $questao_discursiva = \SimuladoENADE\QuestaoDiscursiva::find($request->id);
		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', \Auth::user()->curso_id)->get();

		\Session::put('url.intended', \URL::previous());  // using the Facade
		session()->put('url.intended', \URL::previous()); // using the L5 helper

		return view('/QuestaoView/editarQuestaoDiscursiva', ['questao_discursiva' => $questao_discursiva], ['disciplinas'=>$disciplinas]);
    }

    public function atualizar(Request $request){
		try{
			QuestaoDiscursivaValidator::validate($request->all());

			$questao_discursiva = QuestaoDiscursiva::find($request->id);
            $questao_discursiva->enunciado = $request->enunciado;
            $questao_discursiva->dificuldade = $request->dificuldade;
            $questao_discursiva->disciplina_id = $request->disciplina_id;

            $questao_discursiva->update();

			return \Redirect::intended('/')->with('success', \SimuladoENADE\FlashMessage::alteracoesSuccess());;

		}catch(ValidationException $ex){
			return redirect("editar/questao")->withErrors($ex->getValidator())->withInput();
		}
	}

	public function importarQuestao(Request $request){
		$cursos = \SimuladoENADE\Curso::where('id', '!=', \Auth::user()->curso_id)->orderBy('curso_nome')->get();
		$disciplinas = \SimuladoENADE\Disciplina::orderBy('nome')->get();
		$questoes_discursivas = collect();
		$existe_no_curso = true;

        $list_cursos_id = DB::table('disciplinas')->pluck('curso_id')->toArray();
		$list_cursos_id = array_unique($list_cursos_id);

        if(in_array( \Auth::user()->curso_id, $list_cursos_id )) {
			$list_cursos_id = array_diff($list_cursos_id, array(\Auth::user()->curso_id));
		}

		if(!$request->all()){
			return view('/QuestaoView/importarQuestaoDiscursiva', ['disciplinas' => $disciplinas, 'cursos' => $cursos, 'questoes_discursivas' => $questoes_discursivas, 'disc_existe' => $existe_no_curso, 'list_cursos_id' => $list_cursos_id]);
		} elseif ($request->input('disciplina_id')) {

            if($request['disciplina_id'] == "all") {

                $disciplinas_aux = \SimuladoENADE\Disciplina::where('curso_id', $request['curso_id'])->get();
				$ids = \SimuladoENADE\Disciplina::queryToArrayIds($disciplinas_aux);
				$questoes_discursivas = \SimuladoENADE\QuestaoDiscursiva::whereIn('disciplina_id', $ids)->get();

				$condicoes = ['curso_id' => \Auth::user()->curso_id];
				$existe_no_curso = \SimuladoENADE\Disciplina::where($condicoes)->first() ? true : false;
            } else {
                $questoes_discursivas = \SimuladoENADE\Disciplina::find($request->input('disciplina_id'))->questao_discursivas;
			    $condicoes = ['curso_id' => \Auth::user()->curso_id, 'nome' => \SimuladoENADE\Disciplina::find($request->input('disciplina_id'))->nome];
			    $existe_no_curso = \SimuladoENADE\Disciplina::where($condicoes)->first() ? true : false;
            }

			return view('/QuestaoView/importarQuestaoDiscursiva', ['disciplinas' => $disciplinas, 'cursos' => $cursos, 'questoes_discursivas' => $questoes_discursivas, 'disc_existe' => $existe_no_curso, 'list_cursos_id' => $list_cursos_id]);
		} else {
			return redirect()->back()->with('fail', true)->with('message','Ocorreu um erro. Por favor, selecione uma disciplina.');
		}
	}

	public function importandoQuestoes(Request $request){

		// As questões são replicadas e salvas na disciplina temporaria
		foreach ($request->qsts as $qst_id) {

			$questao = \SimuladoENADE\QuestaoDiscursiva::find($qst_id); // Encontra a qst a ser importada

			$nova_qst = $questao->replicate(); // Duplica criando um novo model
			$nova_qst->disciplina_id = $request->disciplina_dst_id; // Altera a disciplna

			$nova_qst->save(); // Salva a nova questão no bd
		}

		$disciplina_dest = \SimuladoENADE\Disciplina::find($request->input('disciplina_dst_id'));

		$mensagem = 'Importação efetuada com sucesso! ';
		$mensagem .= (count($request->qsts) == 1) ? count($request->qsts).' questão importada ' :
			count($request->qsts).' questões importadas ';
		$mensagem .= 'para a disciplina "'.$disciplina_dest->nome.'"!';

		return redirect()->route('import_qst')->with('success', true)->with('message', $mensagem);

	}

    public function listarQstDisciplina(Request $request){
		$curso_id = \Auth::user()->curso_id;

		$questaos = \SimuladoENADE\QuestaoDiscursiva::select('*', \DB::raw('questao_discursivas.id as qstid'))
			->join('disciplinas', 'questao_discursivas.disciplina_id', '=', 'disciplinas.id')
			->where('disciplina_id', '=', $request->id)
			->orderBy('nome')
			->orderBy('dificuldade')
			->get();

		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', \Auth::user()->curso_id)->get();

		return view('/QuestaoView/listaQuestao', ['questaos' => $questaos, 'disciplinas' => $disciplinas]);
	}

    public function remover(Request $request) {

        $questao_discursiva = \SimuladoENADE\QuestaoDiscursiva::find($request->id);

		try {
			$questao_discursiva->delete();
			return redirect('\listar\questao')->with('success', \SimuladoENADE\FlashMessage::removeQuestaoSuccess());
		} catch(QueryException $ex) {
			return redirect('\listar\questao')->with('fail', \SimuladoENADE\FlashMessage::removeQuestaoFail());
		}
    }

    public function listarSimuladosRespostasDiscursivas() {

        // TODO: Filtrar apenas os simulados que o professor pode 

        $respostas_discursivas_por_simulado = RespostaDiscursiva::all()->groupBy('simulado_id');
        $id_simulados_com_respostas_discursivas = [];

        foreach($respostas_discursivas_por_simulado as $id_simulado => $respostas_discursivas) {
            array_push($id_simulados_com_respostas_discursivas, $id_simulado);
        }

        $simulados_com_respostas_discursivas = Simulado::whereIn('id', $id_simulados_com_respostas_discursivas)->where('curso_id', Auth::user()->curso_id)->get();

        return view('ProfessorView/listar_simulados_questoes_discursivas', ["simulados" => $simulados_com_respostas_discursivas]);
    }

    public function litarRespostasSimulados($simulado_id) {
        $simulado = Simulado::find($simulado_id);

        if(!$simulado || $simulado->curso_id != Auth::user()->curso_id) {
            return redirect()->back();
        }

        $respostas_discursivas = RespostaDiscursiva::where('simulado_id', $simulado_id)->get();
        return view('ProfessorView/listar_questoes_discursivas_respondidas', ["respostas" => $respostas_discursivas, "simulado_id" => $simulado_id]);
    }

    public function avaliarRespostaSimulados($simulado_id, $resposta_id) {

        $simulado = Simulado::find($simulado_id);
        if(!$simulado || $simulado->curso_id != Auth::user()->curso_id) {
            // TODO: Filtrar apenas as questoes que o professor pode avaliar
            return redirect()->back();
        }

        $resposta = RespostaDiscursiva::find($resposta_id);
        return view('ProfessorView/avaliar_questao_discursivas', ["resposta" => $resposta, "simulado_id" => $simulado_id]);
    }

    public function avaliarRespostaDiscursiva(Request $request) {
        $request->validate([
            "nota" => "required",
            "comentario" => "required",
            "resposta_discursiva_id" => "required|exists:resposta_discursivas,id",
        ]);

        $resposta = RespostaDiscursiva::find($request->resposta_discursiva_id);

        $nota = new NotaQuestaoDiscursiva;

        if($request->has('nota_id')) {
            $nota = NotaQuestaoDiscursiva::find($request->nota_id);
        } else {
            $nota->resposta_discursiva_id = $resposta->id;
        }

        $nota->nota = $request->nota;
        $nota->comentario = $request->comentario;
        $nota->usuario_id = Auth::id();

        $nota->save();

        return redirect()->route('ver_respostas_discursivas_simulado', $resposta->simulado_id);
    }

}
