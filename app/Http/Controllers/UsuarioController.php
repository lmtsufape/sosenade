<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \SimuladoENADE\Notifications\usuarioNotificacao;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use \SimuladoENADE\Mail\emailConfirmacao;
use SimuladoENADE\Validator\UsuarioValidator;
use SimuladoENADE\Validator\ValidationException;


class Usuariocontroller extends Controller
{
	public function adicionar(Request $request){

		try{
			

			$user =  \Auth::user()->tipousuario_id;

			if($user == 4){ // adm

				$inf_array = $request->all();

				UsuarioValidator::Validate($inf_array);

				$new_user = new \SimuladoENADE\Usuario();
				$new_user->fill($inf_array);
				$new_user->password = Hash::make($request->password);
				$new_user->save();
		  
				if(false){ // email de confirmação não funcionando ainda
					Mail::to($request->email)->send(new emailConfirmacao());
				}

				return redirect("/listar/usuario");
			
			} elseif($user == 2){ // coord

				$inf_array = $request->all();
				$inf_array["curso_id"] = \Auth::user()->curso_id; // Pega o curso do usuario que está cadastrando.
				$inf_array["tipousuario_id"] = 3; // Coordenador só pode cadastrar professor aqui!

				UsuarioValidator::Validate($inf_array);

				$new_user = new \SimuladoENADE\Usuario();
				$new_user->fill($inf_array);
				$new_user->password = Hash::make($request->password);
				$new_user->save();
		  
				if(false){
					Mail::to($request->email)->send(new emailConfirmacao());
				}

				return redirect("/listar/professor");
			}

		} catch(ValidationException $ex){
			
			$user =  \Auth::user()->tipousuario_id;
			if($user == 4)
				return redirect("/cadastrar/usuario")->withErrors($ex->getValidator())->withInput();
			elseif($user == 2)
				return redirect("/cadastrar/professor")->withErrors($ex->getValidator())->withInput();

		}
	}

	public function cadastrar(){
		// $this->authorize('adcionar', \SimuladoENADE\Usuario::class); 
		$user = \Auth::user()->tipousuario_id;      
		$cursos = \SimuladoENADE\Curso::all();
		$tipos_usuario = \SimuladoENADE\Tipousuario::all(); // Tem q retirar aluno, pois está em outra tabela

		if($user == 4)
			return view('/UsuarioView/cadastrarUsuario',['cursos' => $cursos, 'tipos_usuario' => $tipos_usuario]);
		elseif($user == 2){
			
			$curso_id = \Auth::user()->curso_id;
        	$nome_curso = \SimuladoENADE\Curso::find($curso_id)->curso_nome;

			return view('/UsuarioView/cadastrarProfessor',['cursos' => $cursos, 'tipos_usuario' => $tipos_usuario, 'nome_curso' => $nome_curso]);
		
		}
		
	}

	public function listar (Request $request) {
		/**
		Lista de forma distintas de acordo com seu usuario
		criar uma lista diferente para professor
		**/

		$curso_id = \Auth::user()->curso_id;
		$tipo_usuario = \Auth::user()->tipousuario_id;

		if($tipo_usuario == 4){

			// Para exibir o tipo de usuário na lista do Adm
			$usuarios =\SimuladoENADE\Usuario::select('*', \DB::raw('usuarios.id as userid'))
				->join('tipousuarios', 'usuarios.tipousuario_id', '=', 'tipousuarios.id')
				->join('cursos', 'usuarios.curso_id', '=', 'cursos.id') // para exibir o nome do curso
				->orderBy('nome')
				->get();

			return view('/UsuarioView/ListaUsuario',['usuarios' => $usuarios]); 

		} elseif($tipo_usuario == 2){

			// Apenas usuarios do tipo 3 (professores) e do mesmo curso do coord
        	$usuarios = \SimuladoENADE\Usuario::where('curso_id', '=', $curso_id)
        		->where('tipousuario_id','=',3) // apenas professores
        		->orderBy('nome')
        		->get();
        		
			$nome_curso = \SimuladoENADE\Curso::find($curso_id)->curso_nome;

			return view('/UsuarioView/ListaProfessor',['usuarios' => $usuarios, 'nome_curso' => $nome_curso]); 
			
		}

	}

	public function editar(Request $request) {
		$cursos = \SimuladoENADE\Curso::all();
		$tipos_usuario = \SimuladoENADE\Tipousuario::all();
		$usuario = \SimuladoENADE\Usuario::find($request->id);
		$user = \Auth::user()->tipousuario_id;

		if($user == 4){
			return view('/UsuarioView/editarUsuario', ['usuario'=> $usuario, 'cursos' => $cursos, 'tipos_usuario' => $tipos_usuario]);
		} elseif($user == 2){
			return view('/UsuarioView/editarProfessor', ['usuario'=> $usuario, 'cursos' => $cursos, 'tipos_usuario' => $tipos_usuario]);
		}    
	}
	
	public function atualizar(Request $request){
		try{
			$user =  \Auth::user()->tipousuario_id;
			
			if($user == 4){

				$inf_array = $request->all();

				$usuario = \SimuladoENADE\Usuario::find($request->id);
				$inf_array["password"] = $usuario->password;
				$inf_array["password_confirmation"] = $usuario->password;
				
				UsuarioValidator::Validate($inf_array);

				$usuario->fill($inf_array);
				$usuario->update();
				return redirect("/listar/usuario");

			} elseif($user == 2){

				$inf_array = $request->all();
				$inf_array["curso_id"] = \Auth::user()->curso_id;

				$usuario = \SimuladoENADE\Usuario::find($request->id);
				$inf_array["password"] = $usuario->password;
				$inf_array["password_confirmation"] = $usuario->password;
				$inf_array["tipousuario_id"] = $usuario->tipousuario_id;  
				
				UsuarioValidator::Validate($inf_array);

				$usuario->fill($inf_array);
				$usuario->update();
				return redirect("/listar/professor");

			}
		}
		catch(ValidationException $ex){
			dd($ex->getValidator());
			$usuario = \SimuladoENADE\Usuario::find($request->id); 
			return redirect("editar/usuario/".$usuario->id)->withErrors($ex->getValidator())->withInput();
		}
	}
	
	public function remover (Request $request) {
		$usuario = \SimuladoENADE\Usuario::find($request->id);
		$usuario->delete();
		
		$user = \Auth::user()->tipousuario_id;      
		if($user == 4){
			return redirect("/listar/usuario");
		}elseif($user == 2){
			return redirect("/listar/professor");
		}
	}
}