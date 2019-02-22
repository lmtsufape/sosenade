<?php

namespace SimuladoENADE\Http\Middleware\MiddlewareModels;

use Closure;

class AutorizacaoMiddleware
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
        if($request->is("/cadastrar/ciclo")) {
            if(!\Auth::guest() || !\Auth::user()->Usuario->tipousuario_id != 4)
                return redirect("login");
        }

        return $next($request);
    }
}
