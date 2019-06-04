<?php

namespace SimuladoENADE\Http\Middleware;

use Closure;

class CoordenacaoGeralMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(\Auth::guest() || \Auth::user()->tipousuario_id != 5){
           
            return redirect("home");

        }
        return $next($request);
    }

}
