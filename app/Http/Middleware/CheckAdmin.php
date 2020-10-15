<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if(!empty(session('admin_username')) && !empty(session('is_admin')) && (session('is_admin')==true) ){
            return $next($request);    
        }else{
            return redirect()->route('admin');
        }
        
    }
}
