<?php

namespace Gas\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $role)
    {

        if (Auth::check()) {
            if (Auth::user()->situation == 'inativo') {
                return redirect('/auth/login');
            }
        } else {
            return redirect('/auth/login');
        }
        
        if (in_array(Auth::user()->role, $role) === FALSE) {
            return redirect('acesso-negado');
        }
        return $next($request);
    }
}
