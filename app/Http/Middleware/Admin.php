<?php

namespace App\Http\Middleware;
use Session;
use Closure;

class Admin
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
        if(!session()->has('name')){
        return redirect('login');
        }

       return $next($request);
    }
}
