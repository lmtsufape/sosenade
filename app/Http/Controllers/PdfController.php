<?php

namespace SimuladoENADE\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller {
	public function questoesPorDisciplina(){
		$view = 'RelatoriosView.QuestoesPorDisciplina';
		
		$disciplinas =\SimuladoENADE\Disciplina::join('questaos', 'disciplinas.id', '=','questaos.disciplina_id')
			->where('curso_id', '=', \Auth::user()->curso_id)
			->select('nome', 'questaos.dificuldade', DB::raw('count(*) as questaos_count'))
			->groupBy('nome', 'questaos.dificuldade')
			->orderBy('nome')
			->get();

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
					$resum_aluno[$i]['simulados'][$resultado_simulado->simulado->descricao_simulado]['disciplinas'][$nome_disc]['media'] = ($acertos/count($disciplina['qsts']))*100;
				}
			}
			$resum_aluno[$i]['md_geral'] = count($alunos[$i]->simulados_alunos) ? $soma/count($alunos[$i]->simulados_alunos) : 0;
		}

		$total_alunos = count($alunos);

		$date = date('d/m/Y');
		$view = \View::make($view, compact('resum_aluno','date', 'total_alunos'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view)->setPaper('a4', 'portrait');

		$filename = 'QuestoesPorDisciplina_'.$date;

		return $pdf->stream($filename.'.pdf');
	}
	
	public function relatorioGeralCursos(){
		
		$cursos = \SimuladoENADE\Curso::orderBy('curso_nome')->get();
		$unidades = \SimuladoENADE\UnidadeAcademica::all()->count();

		return view('/RelatoriosView/VisaoGeral',['cursos' => $cursos, 'n_unidades' => $unidades]);
	}
}
