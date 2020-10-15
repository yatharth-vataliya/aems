<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAdminAuthenticated
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
        if(!empty(session('admin_username')) && !empty(session('is_admin')) && (session('is_admin')== true) ){
            return redirect()->route('dashboard');    
        }
        return $next($request);
    }
}
