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
            $curso_id = \Auth::user()->curso_id;

            UsuarioValidator::Validate($request->all());

            $usuario = new \SimuladoENADE\Usuario();
            $usuario->fill($request->all());
            $usuario->password = Hash::make($request->password);
            $usuario->curso_id = $curso_id;
            $usuario->save();
            $user =  \Auth::user()->tipousuario_id;
          
            if(true){
                $usuario = $request->email;
                Mail::to($usuario)->send(new emailConfirmacao());

        
            }
            if($user == 4){
                return redirect("/listar/usuario");
            }
            elseif($user == 2){
                return redirect("/listar/professor");
            }
        }
        catch(ValidationException $ex){
            $user =  \Auth::user()->tipousuario_id;
            if($user == 4){
                return redirect("/cadastrar/usuario")->withErrors($ex->getValidator())->withInput();
            }
            elseif($user == 2){
                return redirect("/cadastrar/professor")->withErrors($ex->getValidator())->withInput();
            }
            
        }
    }

    public function cadastrar(){

//        $this->authorize('adcionar', \SimuladoENADE\Usuario::class); 
        $user = \Auth::user()->tipousuario_id;       
        $cursos = \SimuladoENADE\Curso::all();
        $tipos_usuario = \SimuladoENADE\Tipousuario::all();

        if($user == 4){
		  return view('/UsuarioView/cadastrarUsuario',['cursos' => $cursos, 'tipos_usuario' => $tipos_usuario]);
          }
        elseif($user == 2){
            return view('/UsuarioView/cadastrarProfessor',['cursos' => $cursos, 'tipos_usuario' => $tipos_usuario]);
          }
        }

    
    









    public function listar (Request $request) {
        /**
        Lista de forma distintas de acordo com seu usuario
        criar uma lista diferente para professor
        **/

        $tipo = \Auth::user()->curso_id;
        $tipos_usuario = \Auth::user()->tipousuario_id;
        #dd($tipos_usuario);
		$usuarios = \SimuladoENADE\Usuario::where('curso_id', '=', $tipo)->get();#->join('tipousuario_id', '=', $tipos_usuario)->get();
        if($tipos_usuario == 4){
		  return view('/UsuarioView/ListaUsuario',['usuarios' => $usuarios]); 
        }
        elseif($tipos_usuario == 2){
            return view('/UsuarioView/ListaProfessor',['usuarios' => $usuarios]); 
        }
    }
    








    public function editar(Request $request) {
        $cursos = \SimuladoENADE\Curso::all();
        $tipos_usuario = \SimuladoENADE\Tipousuario::all();
		$usuario = \SimuladoENADE\Usuario::find($request->id);
        $user = \Auth::user()->tipousuario_id;

        if($user == 4){
		  return view('/UsuarioView/editarUsuario', ['usuario'=> $usuario, 'cursos' => $cursos, 'tipos_usuario' => $tipos_usuario]);
          }

        elseif($user == 2){
            return view('/UsuarioView/editarProfessor', ['usuario'=> $usuario, 'cursos' => $cursos, 'tipos_usuario' => $tipos_usuario]);
        }    
    }
    
    public function atualizar(Request $request){
        try{
            UsuarioValidator::Validate($request->all());

            $usuario = \SimuladoENADE\Usuario::find($request->id);    
            $usuario->fill($request->all());
            $usuario->update();
            return redirect("listar/usuario");
        }
        catch(ValidationException $ex){
            #$usuario = \SimuladoENADE\Usuario::find($request->id); 
            return redirect("editar/usuario".$usuario->id)->withErrors($ex->getValidator())->withInput();
        }
    }
    
    public function remover (Request $request) {
    	$usuario = \SimuladoENADE\Usuario::find($request->id);
    	$usuario->delete();
    	return redirect("/listar/usuario");
    }

}




