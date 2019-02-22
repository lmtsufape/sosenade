<?php

namespace SimuladoENADE\Http\Middleware;

use Closure;

class CoordenadorMiddleware
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
       //echo("Chuchu" . \Auth::user()->tipousuario_id);
       //exit(0);


        if(\Auth::guest() || \Auth::user()->tipousuario_id != 2){
           
            return redirect("home");

        }
        

        return $next($request);


    }
}
