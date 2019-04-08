<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\AlunoValidator;
use Illuminate\Support\Facades\Hash;
use SimuladoENADE\Validator\ValidationException;
use SimuladoENADE\Validator\CsvImportRequest;

class AlunoController extends Controller{

	public function home(){
		
		$user =  \Auth::guard('aluno')->user();
		$curso = \SimuladoENADE\Curso::find($user->curso_id);
		$unidade = \SimuladoENADE\UnidadeAcademica::find($curso->unidade_id)->nome;

		return view('home', ['nome' => $user->nome, 'curso' => $curso->curso_nome, 'unidade' => $unidade, 'tipo' => 'Aluno']);

	}

	public function adicionar(Request $request){
		try {

			$curso_id = \Auth::user()->curso_id;
			AlunoValidator::Validate($request->all());

			$aluno = new \SimuladoENADE\Aluno();
			$aluno->fill($request->all());
			$aluno->curso_id = $curso_id;
			$aluno->password = Hash::make($request->password);
			$aluno->save();
			return redirect("listar/aluno");

		} catch(ValidationException $ex) {
			return redirect("cadastrar/aluno")->withErrors($ex->getValidator())->withInput();
		}
	}

	public function cadastrar(){

		$cursos = \SimuladoENADE\Curso::all();
		$alunos = \SimuladoENADE\Aluno::all();
		return view('/AlunoView/cadastrarAluno',['cursos' => $cursos, 'alunos' => $alunos]);

	}

	public function importaArquivo(CsvImportRequest $request) {
		$path = $request->file('csv_file')->getRealPath();
		$data = array_map('str_getcsv', file($path));

		if(!$data){ 
			dd("Arquivo vazio");  
		} else {

			$csv_data = array_slice($data, 0, count($data));
			foreach ($csv_data as $input) {

				if($input[0] and $input[1] and $input[2] and $input[3]){

					$curso_id = \Auth::user()->curso_id;
					$aluno = new \SimuladoENADE\Aluno();
					$aluno->nome = $input[0];
					$aluno->cpf = $input[1];
					$aluno->email = $input[2];

					$aluno->curso_id = $curso_id;
					$aluno->password = Hash::make($input[3]);
					$aluno->save();
	
				}
				else{
					##Relatar uma view de erro para algum campo vazio
				}
			}
			return redirect('listar/aluno');
		}
	}

	public function listar (){

		$curso_user = \Auth::user()->curso_id; // curso_id do consultante
        $alunos = \SimuladoENADE\Aluno::where('curso_id', '=', $curso_user)->orderBy('nome')->paginate(20);

		return view('/AlunoView/listaAluno',['alunos'=> $alunos]);

	}

	public function editar(Request $request){
		$aluno = \SimuladoENADE\Aluno::find($request->id);
		$curso = \SimuladoENADE\Curso::all();
		return view('/AlunoView/editarAluno', ['aluno' => $aluno], ['cursos' => $curso]);
	}

	public function atualizar(Request $request){
		try {
			AlunoValidator::Validate($request->all());
			$aluno = \SimuladoENADE\Aluno::find($request->id);    
			$aluno->fill($request->all());
			$aluno->update();
			return redirect("listar/aluno");
		} catch(ValidationException $ex){
			return redirect("editar/aluno/".$request->id)->withErrors($ex->getValidator())->withInput();
		}
	}

	public function remover(Request $request){
		$aluno = \SimuladoENADE\Aluno::find($request->id);
		$aluno->delete();
		return redirect('\listar\aluno');
	}
}
