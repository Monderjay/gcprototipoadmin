<?php

namespace App\Http\Middleware;

use Closure;

class PorfileMiddleware
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
        if (auth()->user()->id == $request){
            $notificationUsername = "!Establesca un Nombre de Usuario para comenzar a Trabajar!";
            return redirect('/porfile/'.auth()->user()->id)->with(compact('notificationUsername'));
        }
        return $next($request);
    }
}
