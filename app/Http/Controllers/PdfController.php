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
			->get();

		$date = date('d/m/Y');
		$view = \View::make($view, compact('disciplinas','date'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view)->setPaper('a4', 'landscape');

		$filename = 'QuestoesPorDisciplina_'.$date;

		return $pdf->stream($filename.'.pdf');
	}


	public function relatorioAluno(){
		$view = 'RelatoriosView.relatorioAluno';

		$alunos = \SimuladoENADE\Aluno::select('*', \DB::raw('alunos.curso_id as curso_aluno'))
			->join('simulado_alunos', 'alunos.id', '=', 'simulado_alunos.aluno_id')
			->where('curso_id','=',\Auth::user()->curso_id)
			->get();

		$disciplinas =\SimuladoENADE\Disciplina::join('questaos', 'disciplinas.id', '=','questaos.disciplina_id')
			->where('curso_id', '=', \Auth::user()->curso_id)
			->join('questao_simulados', 'questaos.id', '=', 'questao_simulados.questao_id')
			->join('respostas', 'respostas.questao_id', '=', 'questao_simulados.questao_id')
			
			->get();

		dd($disciplinas);

	
		$date = date('d/m/Y');
		$view = \View::make($view, compact('disciplinas','date'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view)->setPaper('a4', 'landscape');

		$filename = 'QuestoesPorDisciplina_'.$date;

		return $pdf->stream($filename.'.pdf');
	}
	
}
