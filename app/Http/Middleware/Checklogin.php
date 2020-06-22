<?php

namespace App\Http\Middleware;

use Closure;

class Checklogin
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
            $adminuser=request()->cookie('adminuser');
            session(['adminuser'=>$adminuser]);
            request()->session()->save();
            // return redirect('/login/create');
        }else{
            return redirect('/'); 
        }
        return $next($request);
    }
}
