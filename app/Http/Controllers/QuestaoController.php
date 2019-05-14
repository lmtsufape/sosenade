<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimuladoENADE\Validator\QuestaoValidator;
use SimuladoENADE\Validator\ValidationException;

class QuestaoController extends Controller {
	public function adicionar(Request $request){
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
			$questao->alternativa_c = $alternativas[2];
			$questao->alternativa_d = $alternativas[3];
			$questao->alternativa_e = $alternativas[4];

			$questao->save();

			return redirect("listar/questao");

		} catch(ValidationException $ex){
			return redirect("cadastrar/questao")->withErrors($ex->getValidator())->withInput();
		}
	}

	public function cadastrar(){
		$cursos = \SimuladoENADE\Curso::all();
		#dd($cursos);
		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', \Auth::user()->curso_id)->get(); 
		return view('/QuestaoView/cadastrarQuestao', ['disciplinas' => $disciplinas, 'cursos' => $cursos]); 
	}
	
	public function listar(){
		$curso_id = \Auth::user()->curso_id;

		$questaos =\SimuladoENADE\Questao::select('*', \DB::raw('questaos.id as qstid'))
			->join('disciplinas', 'questaos.disciplina_id', '=', 'disciplinas.id')
			->where('curso_id', '=', \Auth::user()->curso_id)
			->orderBy('nome')
			->orderBy('dificuldade')
			->get();

		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', \Auth::user()->curso_id)->get();

		return view('/QuestaoView/listaQuestao', ['questaos' => $questaos, 'disciplinas' => $disciplinas]);
	}

	public function listarQstDisciplina(Request $request){
		$curso_id = \Auth::user()->curso_id;

		$questaos =\SimuladoENADE\Questao::select('*', \DB::raw('questaos.id as qstid'))
			->join('disciplinas', 'questaos.disciplina_id', '=', 'disciplinas.id')
			->where('disciplina_id', '=', $request->id)
			->orderBy('nome')
			->orderBy('dificuldade')
			->get();

		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', \Auth::user()->curso_id)->get();

		return view('/QuestaoView/listaQuestao', ['questaos' => $questaos, 'disciplinas' => $disciplinas]);
	}

	public function editar(Request $request){
		$questao = \SimuladoENADE\Questao::find($request->id);
		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', \Auth::user()->curso_id)->get();

		\Session::put('url.intended', \URL::previous());  // using the Facade
		session()->put('url.intended', \URL::previous()); // using the L5 helper

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
			$questao->alternativa_c = $alternativas[2];
			$questao->alternativa_d = $alternativas[3];
			$questao->alternativa_e = $alternativas[4];

			$questao->update();

			return \Redirect::intended('/');

		}catch(ValidationException $ex){
			return redirect("editar/questao")->withErrors($ex->getValidator())->withInput();
		}
	}

	public function remover(Request $request){
		$questao = \SimuladoENADE\Questao::find($request->id);
		$questao->delete();
		return redirect('\listar\questao');
	}

	public function importarQuestao(Request $request){
		$cursos = \SimuladoENADE\Curso::where('id', '!=', \Auth::user()->curso_id)->get();
		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '!=', \Auth::user()->curso_id)->get();
		$questaos = collect();
		
		if(!$request->all()){
			$existe_no_curso = true;
			return view('/QuestaoView/importarQuestao', ['disciplinas' => $disciplinas, 'cursos' => $cursos, 'questaos' => $questaos, 'disc_existe' => $existe_no_curso]);
		} elseif ($request->input('disciplina_id')) {
			$questaos = \SimuladoENADE\Disciplina::find($request->input('disciplina_id'))->questaos;
			$condicoes = ['curso_id' => \Auth::user()->curso_id, 'nome' => \SimuladoENADE\Disciplina::find($request->input('disciplina_id'))->nome];
			$existe_no_curso = \SimuladoENADE\Disciplina::where($condicoes)->first() ? true : false;
			return view('/QuestaoView/importarQuestao', ['disciplinas' => $disciplinas, 'cursos' => $cursos, 'questaos' => $questaos, 'disc_existe' => $existe_no_curso]);
		} else {
			return redirect()->back()->with('fail', true)->with('message','Ocorreu um erro. Por favor, selecione uma disciplina.');
		}
	}

	public function importandoQuestoes(Request $request){
		// Pega a disciplina das questões
		$disciplina_qst = (\SimuladoENADE\Questao::find($request->qsts[0])->disciplina);

		// Procura no curso do importador uma disciplina com mesmo nome para receber as questões
		$condicoes = ['curso_id' => \Auth::user()->curso_id, 'nome' => $disciplina_qst->nome];
		$disciplina_dest = \SimuladoENADE\Disciplina::where($condicoes)->first();

		// Se tem uma disciplina com mesmo nome, as questoes sao salvas nela, se não existe, a disciplina é criada
		if(!$disciplina_dest){
			$disciplina_dest = new \SimuladoENADE\Disciplina();
			$disciplina_dest->nome = $disciplina_qst->nome;
			$disciplina_dest->curso_id = \Auth::user()->curso_id;
			$disciplina_dest->save();
		}

		// Por fim, as questões são replicadas e salvas na disciplina temporaria
		foreach ($request->qsts as $qst_id) {
			$questao = \SimuladoENADE\Questao::find($qst_id); // Encontra a qst a ser importada

			$nova_qst = $questao->replicate(); // Duplica criando um novo model
			$nova_qst->disciplina_id = $disciplina_dest->id; // Altera a disciplna

			$nova_qst->save(); // Salva a nova questão no bd
		}

		$mensagem = 'Importação efetuada com sucesso! ';
		$mensagem .= (count($request->qsts) == 1) ? count($request->qsts).' questão importada ' : 
			count($request->qsts).' questões importadas ';
		$mensagem .= 'para a disciplina "'.$disciplina_dest->nome.'"!';

		return redirect()->route('import_qst')->with('success', true)->with('message', $mensagem);

	}

}