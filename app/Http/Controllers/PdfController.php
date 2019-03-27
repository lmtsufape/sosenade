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
		$pdf->loadHTML($view);

		$filename = 'QuestoesPorDisciplina_'.$date;

		return $pdf->stream($filename.'.pdf');
	}
	
}
