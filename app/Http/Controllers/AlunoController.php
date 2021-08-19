<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\AlunoValidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use SimuladoENADE\Validator\ValidationException;
use SimuladoENADE\Validator\CsvImportRequest;

use Illuminate\Support\Facades\Storage;

class AlunoController extends Controller{

	public function home(){

		if(!\Auth::guard('aluno')->user()->reconhecido) {
			return redirect("/mudarSenhaAluno");
		}

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
			$aluno->reconhecido = false;
			$aluno->save();
			return redirect("listar/aluno")->with('success', \SimuladoENADE\FlashMessage::cadastroSuccess());

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

		$dados_duplicados = '';
		$count_line = count($data);

		if(!$data || $count_line <= 1){
			return redirect('cadastrar/aluno')->with('fail', \SimuladoENADE\FlashMessage::importAlunoFail());
		} else {

			$csv_data = array_slice($data, 1, count($data)); // Lista da segunda linha do array adiante
			foreach ($csv_data as $input) {

				try {

					if($input[0] and $input[1] and $input[2]){

						$curso_id = \Auth::user()->curso_id;
						$aluno = new \SimuladoENADE\Aluno();
						$aluno->nome = $input[0];
						$aluno->cpf = $input[1];
						$aluno->email = $input[2];

						$aluno->curso_id = $curso_id;
						$aluno->reconhecido = false;
						$aluno->password = Hash::make($input[1]);
						$aluno->save();

					}
					else{
						##Relatar uma view de erro para algum campo vazio
					}

				} catch(QueryException $ex) {
					$dados_duplicados = 'Existe dados de alunos já cadastrados no seu arquivo de importação. Os dados já cadastrados não serão alterados!';
				}
			}

			return redirect('listar/aluno')->with('success', \SimuladoENADE\FlashMessage::importAlunoSuccess($dados_duplicados));
		}
	}

	public function listar (){

		$curso_user = \Auth::user()->curso_id; // curso_id do consultante
        $alunos = \SimuladoENADE\Aluno::where('curso_id', '=', $curso_user)->orderBy('nome')->get();

		return view('/AlunoView/listaAluno',['alunos'=> $alunos]);

	}

	public function editar(Request $request){
		$aluno = \SimuladoENADE\Aluno::find($request->id);
		$curso = \SimuladoENADE\Curso::all();
		return view('/AlunoView/editarAluno', ['aluno' => $aluno], ['cursos' => $curso]);
	}

	public function editarPerfil(){

		if(!\Auth::guard('aluno')->user()->reconhecido) {
			return redirect("/mudarSenhaAluno");
		}

		$aluno = \Auth::guard('aluno')->user();
		$curso = \SimuladoENADE\Curso::all();
		return view('/AlunoView/editarPerfil', ['aluno' => $aluno], ['cursos' => $curso]);
	}

	public function editarSenha(Request $request) {
		$usuario = \SimuladoENADE\Aluno::find($request->id);
		if (!(Hash::check($request->old_password, $usuario->password)))
			return redirect()->back()->with('fail', true)->with('message','Senha incorreta! Alterações não efetuadas.')->with('senha', true);

		$validator = Validator::make($request->all(), [
			'password' => 'min:8|max:16|required_with:password_confirmation',
			'password_confirmation' => 'required_with:password|same:password'
			], [
            'min' => 'A senha deve conter no mínimo 8 caracteres',
            'same' => 'A nova senha e a confirmação da senha devem ser iguais'
        ]);

		if($validator->fails())
			return redirect()->back()->withErrors($validator->errors())->withInput()->with('senha', true);;

		$usuario->password = Hash::make($request->password);
		$usuario->save();

		return redirect()->back()->with('success', true)->with('message', \SimuladoENADE\FlashMessage::senhaAlteradaSuccess());
	}

	public function atualizar(Request $request){
		try {
			AlunoValidator::Validate($request->all());
			$aluno = \SimuladoENADE\Aluno::find($request->id);
			$aluno->fill($request->all());
			$aluno->update();
			return redirect()->back()->with('success', true)->with('message', \SimuladoENADE\FlashMessage::alteracoesSuccess());
		} catch(ValidationException $ex){
			return redirect("editar/aluno/".$request->id)->withErrors($ex->getValidator())->withInput();
		}
	}

	public function remover(Request $request){
		$aluno = \SimuladoENADE\Aluno::find($request->id);
		$aluno_nome = $aluno->nome;

		try {
			$aluno->delete();
			return redirect('\listar\aluno')->with('success', \SimuladoENADE\FlashMessage::removeAlunoSuccess());
		} catch(QueryException $ex) {
			return redirect("\listar\aluno")->with('fail', \SimuladoENADE\FlashMessage::removeAlunoFail($aluno_nome));
		}
	}

	public function downloadModeloCSV(Request $request) {
		return Storage::download('public/import_alunos.csv');
	}

	public function mudarSenhaView(Request $request) {

		if(\Auth::guard('aluno')->user()->reconhecido) {
			return redirect("/alunoCadastrado");
		}
		
		return view('AlunoView/mudarSenha', ['aluno' => \Auth::guard('aluno')->user()]);
	}

	public function mudarSenha(Request $request) {
		$aluno = \SimuladoENADE\Aluno::find($request->id);

		if (!(Hash::check($request->old_password, $aluno->password)))
			return redirect()->back()->with('fail', true)->with('message','Senha incorreta! Alterações não efetuadas.')->with('senha', true);

		$validator = Validator::make($request->all(), [
			'password' => 'required|min:8|required_with:password_confirmation',
			'password_confirmation' => 'required_with:password|same:password'
		], \SimuladoENADE\Aluno::$messages);

		if($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors())->withInput()->with('senha', true);
		}

		$aluno->password = Hash::make($request->password);
		$aluno->reconhecido = true;
		$aluno->save();

		return redirect()->back()->with('success', true);
	}

	public function alunoCadastrado(Request $request) {

		if(!\Auth::guard('aluno')->user()->reconhecido) {
			return redirect("/mudarSenhaAluno");
		}

		$user =  \Auth::guard('aluno')->user();
		$curso = \SimuladoENADE\Curso::find($user->curso_id);
		$unidade = \SimuladoENADE\UnidadeAcademica::find($curso->unidade_id)->nome;

		return view('AlunoView/alunoVerificado', ['nome' => $user->nome, 'curso' => $curso->curso_nome, 'unidade' => $unidade, 'tipo' => 'Aluno']);
	}

}
