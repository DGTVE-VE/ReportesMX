<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
class IsInstructor
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
        if (!empty(Auth::user()) && empty (Auth::user ()->institucion_id)){
            return response(view ('solicitaIngreso'));
        }
        return $next($request);
    }
}
