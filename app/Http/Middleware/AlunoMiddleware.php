<?php

namespace SimuladoENADE\Http\Middleware;

use Closure;

class AlunoMiddleware
{   
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next) {

        // $user = \Auth::guard('aluno')->user();

        // if ($user == 'aluno' and $user->reconhecido){
        //     return redirect("/alunohome");
        // }

        // if ($user == 'aluno' and !$user->reconhecido){
        //     return redirect("/mudarSenhaAluno");
        // }

        return $next($request);

    }
}
