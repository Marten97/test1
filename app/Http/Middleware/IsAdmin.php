<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->isEmp == 0){
            return $next($request);
        }
   
        return redirect('/');
    }
}
