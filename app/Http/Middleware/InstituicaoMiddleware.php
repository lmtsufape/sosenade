<?php

namespace SimuladoENADE\Http\Middleware;

use Closure;

class InstituicaoMiddleware
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
        $user = \Auth::guard('instituicao')->user();

        if($user == 'instituicao') {
            return redirect('/instituicaohome');
        }

        return $next($request);
    }
}
