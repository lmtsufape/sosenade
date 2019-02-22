<?php

namespace SimuladoENADE\Http\Middleware;

use Closure;

class ProfessorMiddleware
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

        //echo("adm" . \Auth::user()->tipousuario_id);
        //exit(1);
        if(\Auth::guest() || \Auth::user()->tipousuario_id != 3){
            return redirect("home");
            }
            return $next($request);
        }


        
    }

