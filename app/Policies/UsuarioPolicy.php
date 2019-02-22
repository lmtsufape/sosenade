<?php

namespace SimuladoENADE\Policies;

use \SimuladoENADE\Usuario;
use \SimuladoENADE\Aluno;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuarioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the usuario.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Usuario  $usuario
     * @return mixed
     */
    public function view(Usuario $user, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can create usuarios.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @return mixed
     */
    public function create(Usuario $user){
     //   $user->can('create', \SimuladoENADE\Usuario::class);
        if($user->tipousuario->id === 4){
            return true;
        }else{
            return false;
        }
    }

         
    public function view_coordenador(Usuario $user){
        if($user->tipousuario->id === 2){
            return true;
        }else{
            return false;
        }
    }

    public function view_professor(Usuario $user){
        if($user->tipousuario->id === 3){
            return true;
        }
        else{
            return false;
        }
    }


   public function view_aluno(Usuario $user){
        if($user->tipousuario->id === 1){
            return true;
        }
        else{
            return false;
        }
    }


    /*public function simuladoAuth(Usuario $user){
        if($user->tipousuario->id === 4){
            return true;
        }elseif($user->tipousuario->id === 1){
            return false;
        }
     }
    */

   
    
    
   /** public function disciplinaAuth(Usuario $user){
       
        if($user->tipousuario->id === 4){
            return true;
        }else{
            return false;
        }
    }
    **/
    

    /**
     * Determine whether the user can update the usuario.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Usuario  $usuario
     * @return mixed
     */
    public function update(Usuario $user, Usuario $usuario)
    {
         if($user->tipousuario->id === 1){
            return false;
        }elseif($user->tipousuario->id === 2){
            return false;
        }elseif($user->tipousuario->id === 3){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Determine whether the user can delete the usuario.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Usuario  $usuario
     * @return mixed
     */
    public function delete(Usuario $user, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can restore the usuario.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Usuario  $usuario
     * @return mixed
     */
    public function restore(Usuario $user, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the usuario.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Usuario  $usuario
     * @return mixed
     */
    public function forceDelete(Usuario $user, Usuario $usuario)
    {
        //
    }
}
