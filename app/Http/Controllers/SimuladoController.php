<?php

namespace SimuladoENADE\Http\Controllers;

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
			$simulado->save();
			return redirect("listar/simulado");
		
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
		$simulados = \SimuladoENADE\Simulado::where('curso_id', '=', $curso_id)->get();
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
			$simulado->update();
			return redirect("listar/simulado");

		} catch(ValidationException $ex){
			return redirect("editar/simulado")->withErrors($ex->getValidator())->withInput();
		}

	}

	//Quando e se cezar terminar o controle de acesso, nois iremos instanciar disciplinas pelo curso do usuario atual(coordenador)
	public function montar(Request $request){

		$curso = \Auth::user()->curso_id;
		$simulado = \SimuladoENADE\Simulado::all();
	 
		$disciplinas = \SimuladoENADE\Disciplina::where('curso_id', '=', $curso)->get();

		$questaos = \DB::table('questao_simulados')
			->join('questaos', 'questao_simulados.questao_id', '=', 'questaos.id')
			->select('questaos.*', 'questao_simulados.*')
			->where('simulado_id', '=', $request->id)
			->get();

		return view('/SimuladoView/montarSimulado',['disciplinas' => $disciplinas, 'questaos' => $questaos, 'simulado_id'=> $request->id]);     
	 
	}

	public function cadastrarQuestao(Request $request){

		try{
			
			$questaos = \SimuladoENADE\Questao::where([['dificuldade', '=', $request->dificuldade],
											 ['disciplina_id', '=', $request->disciplina_id]])
											->get()
											->toArray();
		   
			$num_questao = \SimuladoENADE\QuestaoSimulado::where('simulado_id', '=', $request->simulado_id)->get();

			$cont = count($num_questao);

			MontarSimuladoValidator::Validate(count($questaos), $request->numero);

			if(($cont + $request->numero) > 30)
				return redirect('/montar/simulado/'.$request->simulado_id);

			shuffle($questaos); 
			$row = [];

			for($i = 0; $i < $request->numero; $i++){
				$row = $questaos[$i];
				$questao = new \SimuladoENADE\QuestaoSimulado();
				$questao->questao_id = $row['id'];
				$questao->simulado_id = $request->simulado_id;
				$questao->save();
			}

			return redirect('/montar/simulado/'.$request->simulado_id);

		}catch(ValidationException $ex){
			return redirect("/montar/simulado/".$request->simulado_id)->withErrors($ex->getValidator())->withInput();
		}

	}

	public function listaSimuladoAluno(Request $request){
		
		$curso = \Auth::guard('aluno')->user()->curso_id;
		$simulados = \SimuladoENADE\Simulado::where('curso_id', '=', $curso)->get();
		return view('/SimuladoView/listaSimuladoAluno', ['simulados' => $simulados]);

	}

	public function startSimulado(Request $request)	{
		
		$simulado = \SimuladoENADE\Simulado::find($request->id);

		$questaos = self::getQuestoes($simulado);
		if (empty($questaos))
			return redirect('/resultado/simulado/'.$request->id);

	    return view('/SimuladoView/startSimulado', ['simulado'=>$simulado, 'questaos'=>$questaos]);
	}
   
   	// Salva a resposta da questão no BD
	public function responder(Request $request){

		try{

			$user_id = \Auth::guard('aluno')->user()->id;
	  
			$resposta = new \SimuladoENADE\Resposta();
			$resposta->questao_id = $request->questao_id;
			$resposta->alternativa_questao = $request->alternativa;
			$resposta->aluno_id = $user_id;
			$resposta->simulado_id = $request->simulado_id;
			$resposta->save();

			return redirect('/questao/simulado/'.$request->simulado_id);

		} catch(ValidationException $ex){
			
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

		$questaos = \DB::table('questao_simulados')
			->join('respostas', 'respostas.questao_id','=','questao_simulados.questao_id')
			->join('questaos', 'questaos.id','=','questao_simulados.questao_id')
			->where([['respostas.aluno_id', '=', $user_id], 
					 ['questao_simulados.simulado_id','=',$request->id],
					 ['respostas.simulado_id','=',$request->id]])
			->get()->toArray();
	  
		$certas = 0;
		$total = count($questaos);

		foreach ($questaos as $questao)			
			if($questao->alternativa_questao == $questao->alternativa_correta)
				$certas += 1;

		$resultado = ($certas*100)/$total;
		$resultado = round($resultado, 0);

		return view('/SimuladoView/resultadoSimulado',['resultado' => $resultado, 'total'=>$total, 'questaos' => $questaos]);

	}

	public function remover(Request $request){

		$simulado = \SimuladoENADE\Simulado::find($request->id);
		$simulado->delete();
		return redirect('listar/simulado');

	}
}
