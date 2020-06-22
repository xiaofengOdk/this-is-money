<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
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
     $adminuser=request()->session()->get('adminuser');
     // dd($adminuser);   
        if(!$adminuser){
            return redirect('/login/create');
        }
        return $next($request);
    }
}
