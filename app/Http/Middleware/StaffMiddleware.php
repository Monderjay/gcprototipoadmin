<?php

namespace App\Http\Middleware;

use Closure;

class StaffMiddleware
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
        if (auth()->user()->role->name == "Fundador" || auth()->user()->role->name == "Administrador"){
            return $next($request);
        }else{
            return back();
        }

    }
}
