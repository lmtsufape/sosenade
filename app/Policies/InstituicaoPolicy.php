<?php

namespace SimuladoENADE\Policies;

use \SimuladoENADE\Usuario;
use \SimuladoENADE\Instituicao;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstituicaoPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the aluno.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Aluno  $aluno
     * @return mixed
     */
    public function view_instituicao(Instituicao $instituicao)
    {
        dd($instituicao);
    }

    /**
     * Determine whether the user can create alunos.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @return mixed
     */
    public function create(Instituicao $user) {
        if($user->tipousuario_id === 4){
            return true;
        }
        else{
            return false;
        }
       
    }

    /**
     * Determine whether the user can update the aluno.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Aluno  $aluno
     * @return mixed
     */
    public function update(Usuario $user, Aluno $aluno)
    {
        //
    }

    /**
     * Determine whether the user can delete the aluno.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Aluno  $aluno
     * @return mixed
     */
    public function delete(Usuario $user, Aluno $aluno)
    {
        //
    }

    /**
     * Determine whether the user can restore the aluno.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Aluno  $aluno
     * @return mixed
     */
    public function restore(Usuario $user, Aluno $aluno)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the aluno.
     *
     * @param  \SimuladoENADE\Usuario  $user
     * @param  \SimuladoENADE\Aluno  $aluno
     * @return mixed
     */
    public function forceDelete(Usuario $user, Aluno $aluno)
    {
        //
    }
}
