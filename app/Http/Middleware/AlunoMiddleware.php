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

        $user = \Auth::guard('aluno')->user();

        if ($user == 'aluno'){

            return redirect("/alunohome");

        }

        return $next($request);

    }
}
