<?php

namespace SimuladoENADE\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller {
	public function questoesPorDisciplina(){
		$view = 'RelatoriosView.QuestoesPorDisciplina';
		
		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', \Auth::user()->curso_id)
			->orderBy('nome')
			->get();

		// dd($disciplinas[0]->id, $disciplinas[0]->questaos[0]->respostas->where("acertou")->count());

		$date = date('d/m/Y');
		$view = \View::make($view, compact('disciplinas','date'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view)->setPaper('a4', 'landscape');

		$filename = 'QuestoesPorDisciplina_'.$date;

		return $pdf->stream($filename.'.pdf');
	}

	public function desempenhoAlunos(){
		$view = 'RelatoriosView.DesempenhoPorAluno';

		$alunos = \SimuladoENADE\Aluno::where('alunos.curso_id', '=', \Auth::user()->curso_id)
			->get();

		$resum_aluno = array();
		for ($i=0; $i < count($alunos); $i++) {
			$resum_aluno[$i]['nome'] = $alunos[$i]->nome;
			$soma = 0;
			$resum_aluno[$i]['simulados'] = array();
			foreach ($alunos[$i]->simulados_alunos as $resultado_simulado) {
				$soma += $resultado_simulado->media;
				$resum_aluno[$i]['simulados'][$resultado_simulado->simulado->descricao_simulado]['titulo_simu'] = $resultado_simulado->simulado->descricao_simulado;
				$resum_aluno[$i]['simulados'][$resultado_simulado->simulado->descricao_simulado]['media'] = $resultado_simulado->media;
				
				foreach ($resultado_simulado->simulado->questaos as $qst_simulado) {
					$resposta = \SimuladoENADE\Resposta::where([
						['aluno_id', '=', $alunos[$i]->id],
		    			['questao_id', '=', $qst_simulado->questao->id]])
						->first();

					$resum_aluno[$i]['simulados'][$resultado_simulado->simulado->descricao_simulado]['disciplinas'][$qst_simulado->questao->disciplina->nome]['nome'] = $qst_simulado->questao->disciplina->nome;
					$resum_aluno[$i]['simulados'][$resultado_simulado->simulado->descricao_simulado]['disciplinas'][$qst_simulado->questao->disciplina->nome]['media'] = 0;
					$resum_aluno[$i]['simulados'][$resultado_simulado->simulado->descricao_simulado]['disciplinas'][$qst_simulado->questao->disciplina->nome]['qsts'][] = $resposta->acertou;
				}

				foreach ($resum_aluno[$i]['simulados'][$resultado_simulado->simulado->descricao_simulado]['disciplinas'] as $disciplina) {
					$nome_disc = ($disciplina['nome']);
					$acertos = 0;
					foreach ($disciplina['qsts'] as $questao) {
						$acertos += $questao ? 1 : 0;
					}
					$resum_aluno[$i]['simulados'][$resultado_simulado->simulado->descricao_simulado]['disciplinas'][$nome_disc]['media'] = round(($acertos/count($disciplina['qsts']))*100, 2);
				}
			}
			$resum_aluno[$i]['md_geral'] = count($alunos[$i]->simulados_alunos) ? round($soma/count($alunos[$i]->simulados_alunos, 2)) : 0;
		}

		$total_alunos = count($alunos);

		$date = date('d/m/Y');
		$view = \View::make($view, compact('resum_aluno','date', 'total_alunos'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view)->setPaper('a4', 'landscape');

		$filename = 'DesempenhoPorAluno_'.$date;

		return $pdf->stream($filename.'.pdf');
	}
	
	public function relatorioGeralCursos(){ // Corrigido

		if(\Auth::guard('instituicao')->check()) {
			$auth = \Auth::guard('instituicao')->user();
			$user = $auth->tipousuario_id;
		} else {
			$user = \Auth::user()->tipousuario_id;
		}

		if($user == 4){ // Instituicao / Administrador

			$unidades = \SimuladoENADE\UnidadeAcademica::where('instituicao_id', $auth->id)->get();
			$unidades_id = \SimuladoENADE\UnidadeAcademica::queryToArrayIds($unidades);
			$cursos = \SimuladoENADE\Curso::whereIn('unidade_id', $unidades_id)->orderBy('curso_nome')->get();

			return view('/RelatoriosView/VisaoGeral', ['cursos' => $cursos, 'unidades' => $unidades]);

		} elseif($user == 5){ // Coordenador de Curso

			$unidade = \Auth::user()->curso->unidade;
			$cursos = $unidade->cursos;

			return view('/RelatoriosView/visaoCoordenacaoGeral',['cursos' => $cursos, 'unidade' => $unidade]);
		}

	}

	public function relatorioSimulados(){
		$view = 'RelatoriosView.DesempenhoPorSimulado';
		
		$simulados = \SimuladoENADE\SimuladoAluno::where('simulado_alunos.curso_aluno', '=', \Auth::user()->curso_id)
			->join('simulados', 'simulado_alunos.simulado_id', 'simulados.id')
			->orderBy('simulados.descricao_simulado')
			->selectRaw('avg(media) as media_alunos, simulados.id, simulado_alunos.simulado_id, count(simulado_alunos.id) as numero_respostas')
			->groupBy('simulados.id', 'simulado_alunos.simulado_id')
			->get();

		$date = date('d/m/Y');
		$view = \View::make($view, compact('simulados', 'date'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view)->setPaper('a4', 'landscape');

		$filename = 'DesempenhoPorSimulado_'.$date;

		return $pdf->stream($filename.'.pdf');

	}

	public function relatorioDisciplina(){
		$view = 'RelatoriosView.DesempenhoPorDisciplina';

		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', \Auth::user()->curso_id)
			->orderBy('nome')
			->get();

		$respostas = \SimuladoENADE\Resposta::join('simulados', 'simulados.id', '=', 'respostas.simulado_id')
			->where('simulados.curso_id', '=', \Auth::user()->curso_id)
			->get();

		$cont_respostas = array();
		$acertos = array();
		foreach ($respostas as $resposta) {
			if(!array_key_exists($resposta->questao->disciplina->nome, $acertos)){
				$acertos[$resposta->questao->disciplina->nome] = 0;
				$cont_respostas[$resposta->questao->disciplina->nome] = 0;
			}
			$acertos[$resposta->questao->disciplina->nome] += $resposta->acertou ? 1 : 0;
			$cont_respostas[$resposta->questao->disciplina->nome] += 1;
		}

		$medias = array();
		foreach ($respostas as $resposta) {
			$medias[$resposta->questao->disciplina->nome] = round($acertos[$resposta->questao->disciplina->nome]/$cont_respostas[$resposta->questao->disciplina->nome]*100, 2);
		}

		$date = date('d/m/Y');
		$view = \View::make($view, compact('cont_respostas', 'medias', 'disciplinas', 'date'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view)->setPaper('a4', 'landscape');

		$filename = 'DesempenhoPorDisciplina_'.$date;

		return $pdf->stream($filename.'.pdf');
	}
}
