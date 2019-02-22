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

    public function handle($request, Closure $next){

        $user = \Auth::guard('aluno')->user();
       // echo($user);
        //exit(0);
        
        

        if ($user == 'aluno'){

            
        return redirect("home");
        }

        return $next($request);
      /*  if(\Auth::guest() || \Auth::user()->Usuario->tipousuario_id === 1){
               echo "Teste";
        exit(0);
            return redirect("home");
            }
        
        return $next($request);*/

    }
}
