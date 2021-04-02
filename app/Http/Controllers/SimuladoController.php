<?php

namespace SimuladoENADE\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SimuladoENADE\Validator\SimuladoValidator;
use SimuladoENADE\Validator\MontarSimuladoValidator;
use SimuladoENADE\Validator\ValidationException;
use Illuminate\Http\Resources\Json\Resource;
use SimuladoENADE\Http\Resources\User as UserResource;


class SimuladoController extends Controller{

	public function adicionar(Request $request){
		
		try{

			$curso_id = \Auth::user()->curso_id;
			$user_id = \Auth::user()->id;

			SimuladoValidator::Validate($request->all());
			
			//sql pegar qtd questaos da disciplinas
			$simulado = new \SimuladoENADE\Simulado();
			$simulado->fill($request->all());
			$simulado->curso_id = $curso_id;
			$simulado->usuario_id = $user_id;

			// caso o simulado seja agendado
			$horaAluno = $request->simulado_hora_aluno;
			//dd($horaAluno);
			if($request->periodo){
				// Divide e completa as datas seguindo o fomarto de data do BD
				$data_inicio_simulado = (explode(" - ",$request->periodo)[0] .= ':00');
				$data_fim_simulado = (explode(" - ",$request->periodo)[1] .= ':00');

				// converte para data
				$data_inicio_simulado = date('Y-m-d H:i:s',strtotime(str_replace("/","-",$data_inicio_simulado)));
				$data_fim_simulado = date('Y-m-d H:i:s',strtotime(str_replace("/","-",$data_fim_simulado)));

				// adiciona as caracteristicas no simulado
				$simulado->data_inicio_simulado = $data_inicio_simulado;
				$simulado->data_fim_simulado = $data_fim_simulado;


				if($horaAluno){

					$simulado->simulado_hora_aluno = TRUE;
				}
				else{

					$simulado->simulado_hora_aluno = FALSE;
				}

			} else {
				$simulado->data_inicio_simulado = null;
				$simulado->data_fim_simulado = null;
			}
			
			//dd($simulado);
			$simulado->save();

			return redirect()->route('set_simulado', ['id' => $simulado->id]);
		
		} catch(ValidationException $ex){
			return redirect("cadastrar/simulado")->withErrors($ex->getValidator())->withInput();
		}

	}

	public function cadastrar(){

		$cursos = \SimuladoENADE\Curso::all();
		$usuarios = \SimuladoENADE\Usuario::all();
		$disciplinas = \SimuladoENADE\Disciplina::all();
		return view('/SimuladoView/cadastrarSimulado', ['cursos' => $cursos, 'usuarios' => $usuarios, 'disciplinas' => $disciplinas]);

	}

	public function listar(){
		
		$curso_id = \Auth::user()->curso_id;

		$simulados = \SimuladoENADE\Simulado::join('usuarios', 'simulados.usuario_id', '=', 'usuarios.id')
			->where('simulados.curso_id', '=', $curso_id)
			->orderBy('descricao_simulado')
            ->select('simulados.id as sim_id', 'usuarios.nome as nome', 'simulados.*')
            ->withCount('questaos')
			->get();
		
		return view('/SimuladoView/listaSimulado', ['simulados' => $simulados]);

	}

	public function editar(Request $request){
		
		$simulado= \SimuladoENADE\Simulado::find($request->id);
		$cursos = \SimuladoENADE\Curso::all();
		$usuarios = \SimuladoENADE\Usuario::all();
		return view ('/SimuladoView/editarSimulado', ['simulado' => $simulado, 'cursos' => $cursos, 'usuarios' => $usuarios]);

	}

	public function atualizar(Request $request){
		
		try{
			
			SimuladoValidator::Validate($request->all());

			$simulado = \SimuladoENADE\Simulado::find($request->id);
			$simulado->fill($request->all());
			$horaAluno = $request->simulado_hora_aluno;
			
			// caso o simulado seja agendado
			if($request->periodo){
				// Divide e completa as datas seguindo o fomarto de data do BD
				$data_inicio_simulado = (explode(" - ",$request->periodo)[0] .= ':00');
				$data_fim_simulado = (explode(" - ",$request->periodo)[1] .= ':00');

				// converte para data
				$data_inicio_simulado = date('Y-m-d H:i:s',strtotime(str_replace("/","-",$data_inicio_simulado)));
				$data_fim_simulado = date('Y-m-d H:i:s',strtotime(str_replace("/","-",$data_fim_simulado)));

				// adiciona as caracteristicas no simulado
				$simulado->data_inicio_simulado = $data_inicio_simulado;
				$simulado->data_fim_simulado = $data_fim_simulado;

				if($horaAluno){

					$simulado->simulado_hora_aluno = TRUE;
				}
				else{

					$simulado->simulado_hora_aluno = FALSE;
				}
			} else {
				$simulado->data_inicio_simulado = null;
				$simulado->data_fim_simulado = null;
			}

			$simulado->update();
			
			return redirect("listar/simulado");

		} catch(ValidationException $ex){
			return redirect("editar/simulado")->withErrors($ex->getValidator())->withInput();
		}

	}

	public function listaSimuladoAluno(Request $request){
		
		$hoje = Carbon::now();
		$curso_id = \Auth::guard('aluno')->user()->curso_id;
		$simulados_curso = \SimuladoENADE\Simulado::where('curso_id', '=', $curso_id)
			->withCount('questaos')
			->get();

		$simulados_disp = [];
		$simulados_feitos = [];
		foreach ($simulados_curso as $simulado) {
			$questaos_nao_respondidas = self::getQuestoes($simulado);
			if ($simulado->questaos_count != 0 && $simulado->data_inicio_simulado != null && $hoje->between($simulado->data_inicio_simulado, $simulado->data_fim_simulado))
				if (!empty($questaos_nao_respondidas))
					$simulados_disp[] = $simulado;
				else if (empty($questaos_nao_respondidas))
					$simulados_feitos[] = $simulado;
		}
		
		return view('/SimuladoView/listaSimuladoAluno', ['simulados' => $simulados_disp, 'simulados_feitos' => $simulados_feitos]);

	}

	public function startSimulado(Request $request)	{
		
		$simulado = \SimuladoENADE\Simulado::find($request->id);
		$questaos_nao_respondidas = self::getQuestoes($simulado);

		$resposta = new \SimuladoENADE\Resposta();
		$user_id = \Auth::guard('aluno')->user()->id;
		
		//$teste = $request->simulado_id;
		//dd($simulado->id);
		$simuladoHora = \SimuladoENADE\SimuladoHora::where('simulado_horas.aluno_id', "=", $user_id)->where('simulado_horas.simulado_id', '=', $simulado->id)->get();
		//dd($simuladoHora[0]);
		if(empty($simuladoHora[0])){
			$simuladoHora = new \SimuladoENADE\SimuladoHora();
			$simuladoHora->fill($request->all());
			$simuladoHora->aluno_id = $user_id;	
			$dateTime = date_default_timezone_set('America/Sao_Paulo');
			$dataLocal = date('d/m/Y H:i:s', time());
			$dataFinal = date('d/m/Y H:i:s', time());
			$simuladoHora->simulado_id = $simulado->id;	
			$hora_inicio_simulado = date('Y-m-d H:i:s',strtotime(str_replace("/","-",$dataLocal)));
			$hora_fim_simulado = date('Y-m-d H:i:s',strtotime(str_replace("/","-",$dataFinal)));
			$hora_fim_simulado = date('Y-m-d H:i:s', strtotime('+ 240 minute', strtotime($hora_fim_simulado)));
			$simuladoHora->hora_inicio_simulado = $hora_inicio_simulado;
			$simuladoHora->hora_fim_simulado = $hora_fim_simulado;
			$simuladoHora->save();
		//dd($simuladoHora);
		}
		
		if (empty($questaos_nao_respondidas))
		return redirect('/resultado/simulado/'.$request->id);
		
	    return view('/SimuladoView/startSimulado', ['simulado'=>$simulado, 'questaos'=>$questaos_nao_respondidas]);
	}
   
   	// Salva a resposta da questão no BD
	public function responder(Request $request){

		$simulado = \SimuladoENADE\Simulado::find($request->simulado_id);
		$user_id = \Auth::guard('aluno')->user()->id;
		//$resposta = \SimuladoENADE\Resposta::all();


		//dd($questoes_respondidas_aluno);
		$simuladoHora = \SimuladoENADE\SimuladoHora::where('simulado_horas.aluno_id', "=", $user_id)->where('simulado_horas.simulado_id', '=', $request->simulado_id)->get();
		$simuladoHora = date('Y-m-d H:i:s',strtotime(str_replace("/","-",$simuladoHora[0]->hora_fim_simulado)));
		//	dd($simuladoHora);
		$dateTime = date_default_timezone_set('America/Sao_Paulo');
		$dataLocal = date('d/m/Y H:i:s', time());
		$hora_atual_simulado = date('Y-m-d H:i:s',strtotime(str_replace("/","-",$dataLocal)));
		
		
		if($hora_atual_simulado > $simuladoHora && $simulado->simulado_hora_aluno == true){

			//dd("aqui");
			
			$questoes_respondidas_aluno = \DB::table("respostas")->where(
				[['aluno_id', '=', $user_id], ['simulado_id', '=', $simulado->id]]
				)->pluck('questao_id');
				
				//$questaoSimulado = \SimuladoENADE\QuestaoSimulado::all();
				$questaoSimulado = \SimuladoENADE\QuestaoSimulado::where('simulado_id','=', $request->simulado_id)->get();
				//dd($questaoSimulado[0]->questao_id);
			//$i = 0;
			foreach($questaoSimulado as $questao){
				if(!$questoes_respondidas_aluno->contains($questao->questao_id)) {
					//dd($questao->questao_id);
					$resposta = new \SimuladoENADE\Resposta();
					//$resposta->fill($request->all());
					$resposta->questao_id = $questao->questao_id;
					$resposta->aluno_id = $user_id;
					$resposta->acertou = FALSE;
					$resposta->alternativa_questao = 6;
					$resposta->simulado_id = $request->simulado_id;
					//++$i;
					$resposta->save();
					//dd($resposta);
				}
			}

		return redirect('/resultado/simulado/'.$request->simulado_id);			
		}
		
		else{
			try{

				$user_id = \Auth::guard('aluno')->user()->id;
				$qst_alt_correta = \SimuladoENADE\Questao::find($request->questao_id)->alternativa_correta;
		
				$resposta = new \SimuladoENADE\Resposta();
				$resposta->questao_id = $request->questao_id;
				$resposta->alternativa_questao = $request->alternativa;
				$resposta->acertou = ($request->alternativa == $qst_alt_correta);
				$resposta->aluno_id = $user_id;
				$resposta->simulado_id = $request->simulado_id;
				$resposta->save();

				return redirect('/questao/simulado/'.$request->simulado_id);

			} catch(ValidationException $ex){
				
			}
		}
	
	}

	// Retorna questões não respondidas pelo usuário no simulado
	public function getQuestoes($simulado){
		
		//Id do usuário
		$user_id = \Auth::guard('aluno')->user()->id;
		
		$questaos = \DB::table('questao_simulados')
		   ->whereNotIn('questao_id', function($query) use ($user_id, $simulado){
			   $query->select('questao_id')->from('respostas')->where('respostas.aluno_id','=',$user_id)->where('simulado_id', '=', $simulado->id);//filtrar pelo id do simulado também
			})
			->where('simulado_id', '=', $simulado->id)
			->join('questaos', 'questao_simulados.questao_id', '=', 'questaos.id')
			->select('questaos.*', 'disciplinas.nome AS nome_disciplina')
			->join('disciplinas', 'questaos.disciplina_id', '=', 'disciplinas.id')
			->get()->toArray();

		return $questaos;
		
	}

	// Leva a página de solução da primeira questão achada não respondida no simulado
	public function questao(Request $request){

		$simulado = \SimuladoENADE\Simulado::find($request->id);

		$questaos = self::getQuestoes($simulado);

		if (empty($questaos))
			return redirect('/resultado/simulado/'.$request->id);

		$array = (array) $questaos[0];
		
		return view('/SimuladoView/questaoSimulado',['questao'=> $array, 'simulado_id'=>$simulado->id]);

	}

	public function resultado(Request $request){

		//Id do usuário
		$user_id = \Auth::guard('aluno')->user()->id;

		//dd($resquest->id);

		$questaos = \DB::table('questao_simulados')
			->join('respostas', 'respostas.questao_id','=','questao_simulados.questao_id')
			->join('questaos', 'questaos.id','=','questao_simulados.questao_id')
			->where([['respostas.aluno_id', '=', $user_id], 
					 ['questao_simulados.simulado_id','=',$request->id],
					 ['respostas.simulado_id','=',$request->id]])
			->get()->toArray();
		

		//dd($questaos);
	  
		$certas = 0;
		$total = count($questaos);
	
		foreach ($questaos as $questao){			
			if($questao->alternativa_questao == $questao->alternativa_correta){
				$certas += 1;
			}
			else{

			}
		}
			
		//dd($total);
		$resultado = ($certas*100)/$total;
		$resultado = round($resultado, 0);

		if (\SimuladoENADE\SimuladoAluno::where([
				['aluno_id', '=', $user_id],
    			['simulado_id', '=', $request->id]])
				->get()
				->isEmpty()) {
					// armazena o resultado do simulado
					$simuladoAluno = new \SimuladoENADE\SimuladoAluno();
					$simuladoAluno->aluno_id = $user_id;
					$simuladoAluno->simulado_id = $request->id;
					$simuladoAluno->curso_aluno = \Auth::guard('aluno')->user()->curso_id;
					$simuladoAluno->media = $resultado;
					$simuladoAluno->save();
		}

		return view('/SimuladoView/resultadoSimulado',['resultado' => $resultado, 'total'=>$total, 'questaos' => $questaos]);

	}

	public function remover(Request $request){

		$simulado = \SimuladoENADE\Simulado::find($request->id);
		$simulado->delete();
		return redirect('listar/simulado');

	}
}
